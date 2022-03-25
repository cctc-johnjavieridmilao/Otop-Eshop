<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ProductsModel;
use App\Models\ProductImage;

class Vendor extends BaseController
{
	public function index() {
		if($this->session->has('u_id')) {
			return view('home');
		}
		return view('index');
	}

    public function CountOrders() {

        $u_id = $this->session->get('u_id');

		$str = "SELECT * FROM (
            (
              SELECT COUNT(1) Pending FROM tbl_purchased_orders PO 
                LEFT JOIN (SELECT * FROM tbl_cart WHERE Ispurchased = 1) XX ON XX.CartID = PO.CartID
                INNER JOIN tbl_products P ON XX.ProductID = P.ProducID
              WHERE PO.Status = 'Pending' AND P.Created_by = $u_id
            ) AS Pending,
            (
            SELECT COUNT(1) Canceled FROM tbl_purchased_orders PO 
                LEFT JOIN (SELECT * FROM tbl_cart WHERE Ispurchased = 1) XX ON XX.CartID = PO.CartID
                INNER JOIN tbl_products P ON XX.ProductID = P.ProducID
              WHERE PO.Status = 'Canceled' AND P.Created_by = $u_id
            ) AS Canceled,
            (
                SELECT COUNT(1) Completed FROM tbl_purchased_orders PO 
                LEFT JOIN (SELECT * FROM tbl_cart WHERE Ispurchased = 1) XX ON XX.CartID = PO.CartID
                INNER JOIN tbl_products P ON XX.ProductID = P.ProducID
              WHERE PO.Status = 'Completed' AND P.Created_by = $u_id
            ) AS Completed,
            (
                SELECT COUNT(1) Approved FROM tbl_purchased_orders PO 
                LEFT JOIN (SELECT * FROM tbl_cart WHERE Ispurchased = 1) XX ON XX.CartID = PO.CartID
                INNER JOIN tbl_products P ON XX.ProductID = P.ProducID
              WHERE PO.Status = 'Approved' AND P.Created_by = $u_id
            ) AS ForDelivery,
            (
                SELECT SUM(XX.Total_price) total_sales FROM tbl_purchased_orders PO 
                    LEFT JOIN (SELECT * FROM tbl_cart WHERE Ispurchased = 1) XX ON XX.CartID = PO.CartID
                    INNER JOIN tbl_products P ON XX.ProductID = P.ProducID
                WHERE PO.Status = 'Completed' AND P.Created_by = $u_id
            ) AS total_sales,
            (
                SELECT SUM(XX.Total_price) daily_sales FROM tbl_purchased_orders PO 
                    LEFT JOIN (SELECT * FROM tbl_cart WHERE Ispurchased = 1) XX ON XX.CartID = PO.CartID
                    INNER JOIN tbl_products P ON XX.ProductID = P.ProducID
                WHERE PO.Status = 'Completed' AND P.Created_by = $u_id 
                AND CAST(NOW() AS DATE) = CAST(PO.Created_at AS DATE)
            ) AS daily_sales,
            (
              SELECT COUNT(1) count_followers FROM tbl_followers WHERE VendorID = $u_id
            ) AS count_followers,
            (
                SELECT AVG(X.Rate) rate_average FROM tbl_rates X
                    INNER JOIN tbl_products P ON X.ProductID = P.ProducID
                WHERE P.Created_by = $u_id
            ) AS rate_average
          );";
	
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
    }

    public function GetUserOrders() {

        $status = $this->request->getVar('status');

        $u_id = $this->session->get('u_id');

        if($status == 'All') {
            $str = "SELECT X.OrderID,X.OrderCode,X.PaymentMethod,X.Created_at,D.Full_Address,
            C.Quantity,C.Prize,C.Total_price,P.Name,P.Description,X.Status,P.ProducID,
             X.CancelRemarks,CONCAT(U.firtname, ' ', U.lastname) Customer
              FROM tbl_purchased_orders X 
                    LEFT JOIN tbl_user_address D ON D.AddresID = X.AddressID
                    LEFT JOIN tbl_cart C ON C.CartID = X.CartID
                    LEFT JOIN user_access U ON U.RecID = X.CustomerID
                    LEFT JOIN tbl_products P ON C.ProductID = P.ProducID
                    WHERE P.Created_by = $u_id";
        } else {
            $str = "SELECT X.OrderID,X.OrderCode,X.PaymentMethod,X.Created_at,D.Full_Address,
            C.Quantity,C.Prize,C.Total_price,P.Name,P.Description,X.Status,P.ProducID,
             X.CancelRemarks,CONCAT(U.firtname, ' ', U.lastname) Customer
              FROM tbl_purchased_orders X 
                    LEFT JOIN tbl_user_address D ON D.AddresID = X.AddressID
                    LEFT JOIN tbl_cart C ON C.CartID = X.CartID
                    LEFT JOIN user_access U ON U.RecID = X.CustomerID
                    LEFT JOIN tbl_products P ON C.ProductID = P.ProducID
                    WHERE X.Status = '$status' AND P.Created_by = $u_id";
        }
	
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
    }

    public function GetUserOrdersById() {

        $id = $this->request->getVar('order_id');

		$str = "SELECT X.OrderID,X.OrderCode,X.PaymentMethod,X.Created_at,D.Full_Address,
		C.Quantity,C.Prize,C.Total_price,P.Name,P.Description,X.Status,P.ProducID,
         X.CancelRemarks,CONCAT(U.firtname, ' ', U.lastname) Customer,U.lat,U.lang
		  FROM tbl_purchased_orders X 
				LEFT JOIN tbl_user_address D ON D.AddresID = X.AddressID
				LEFT JOIN tbl_cart C ON C.CartID = X.CartID
				LEFT JOIN user_access U ON U.RecID = X.CustomerID
				LEFT JOIN tbl_products P ON C.ProductID = P.ProducID
            WHERE X.OrderID = $id";
	
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
    }

    public function ApprovedOrder() {
        $id = $this->request->getVar('order_id');

        $str = "SELECT (P.stocks - C.Quantity) total_stocks,C.ProductID
            FROM tbl_purchased_orders X 
            INNER JOIN tbl_cart C ON C.CartID = X.CartID
            INNER JOIN tbl_products P ON C.ProductID = P.ProducID
        WHERE X.OrderID = $id";

        $query = $this->db->query($str);
		$stocks = $query->getRow()->total_stocks;
        $product_id = $query->getRow()->ProductID;

        $res = $this->db->table('tbl_purchased_orders')->where(['OrderID' => $id])->update([
			'Status' => 'Approved'
		]);

        $this->db->table('tbl_products')->where(['ProducID' => $product_id])->update([
			'stocks' => $stocks
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);
    }

    public function GetUsers() {
        $user_model = new UserModel();

        return $this->response->setJSON($user_model->findAll());
    }

    public function DeleteUser() {
        $user_model = new UserModel();

		$res = $user_model->delete($this->request->getVar('id'));

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);
    }

    public function AddCategory() {
        $Category = new CategoryModel();
        $u_id = $this->session->get('u_id');

        $res = $Category->insert(['Name' => $this->request->getVar('cat_name'),'Created_by' => $u_id]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}

        $inserted_id = $Category->getInsertID();

        $Category->update($inserted_id, ['CategoryCode' => $inserted_id]);

		return $this->response->setJSON(['msg' => 'success']);
    }

    public function GetProductsCategory() {
        $Category = new CategoryModel();
        $u_id = $this->session->get('u_id');

        return $this->response->setJSON($Category->where(['IsActive' => 1,'Created_by' => $u_id])->findAll());
    }

    public function DeleteCategory() {
        $Category = new CategoryModel();
        $id = $this->request->getVar('CategoryID');

        $res =  $Category->update($id, ['IsActive' => 0]);

        if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}

        return $this->response->setJSON(['msg' => 'success']);
    }

    public function UpdateCategory() {
        $Category = new CategoryModel();
        $id = $this->request->getVar('cat_id');

        $res =  $Category->update($id, ['Name' => $this->request->getVar('cat_name')]);

        if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}

        return $this->response->setJSON(['msg' => 'success']);
    }
    

    public function AddProducts() {

        $Products = new ProductsModel();
        $ProductImage = new ProductImage();
        $u_id = $this->session->get('u_id');

        $imagefile = $this->request->getFiles();
        $path = './public/uploads/';
        

        $res = $Products->insert([
            'CategoryID' => $this->request->getVar('p_cat'),
            'Name' => $this->request->getVar('p_name'),
            'Prize' => $this->request->getVar('p_prize'),
            'Description' => $this->request->getVar('p_description'),
            'stocks' => $this->request->getVar('p_stocks'),
            'Created_by' => $u_id
        ]);

        if(!$res) {
            return $this->response->setJSON(['msg' => $res]);
        }

        $inserted_id = $Products->getInsertID();

        $Products->update($inserted_id, ['ProducCode' => $inserted_id]);

        if(count($imagefile['images']) > 0) {
            foreach($imagefile['images'] as $img) {
                if ($img->isValid()) {
                    $newName = $img->getRandomName();
                    $img->move($path, $newName);
                    $ProductImage->insert([
                        'ProductID' => $inserted_id,
                        'FileName' => $newName,
                        'Created_by' => $u_id
                    ]);
                }
            }
        }

        return $this->response->setJSON(['msg' => 'success']);

    }

    public function UpdateProductsData() {
        $Products = new ProductsModel();

        $Product_id = $this->request->getVar('product_id');

        $res = $Products->update($Product_id, [
            'CategoryID' => $this->request->getVar('p_cat'),
            'Name' => $this->request->getVar('p_name'),
            'Prize' => $this->request->getVar('p_prize'),
            'Description' => $this->request->getVar('p_description'),
            'stocks' => $this->request->getVar('p_stocks')
        ]);

        if(!$res) {
            return $this->response->setJSON(['msg' => $res]);
        }

        return $this->response->setJSON(['msg' => 'success']);

    }

    public function DeleteProduct() {

        $Products = new ProductsModel();

        $Product_id = $this->request->getVar('product_id');

        $res = $Products->update($Product_id, [
            'IsActive' => 0
        ]);

        if(!$res) {
            return $this->response->setJSON(['msg' => $res]);
        }

        return $this->response->setJSON(['msg' => 'success']);

    }

    public function UpdateProducts() {

        $Products = new ProductsModel();
        $ProductImage = new ProductImage();
        $Product_id = $this->request->getVar('product_id');

        $imagefile = $this->request->getFiles();
        $path = './public/uploads/';

        $res = $Products->update($Product_id, [
            'CategoryID' => $this->request->getVar('p_cat'),
            'Name' => $this->request->getVar('p_name'),
            'Prize' => $this->request->getVar('p_prize'),
            'Description' => $this->request->getVar('p_description'),
            'stocks' => $this->request->getVar('p_stocks')
        ]);

        if(!$res) {
            return $this->response->setJSON(['msg' => $res]);
        }

        if(count($imagefile['images']) > 0) {
            foreach($imagefile['images'] as $img) {
                if ($img->isValid()) {
                    $newName = $img->getRandomName();
                    $img->move($path, $newName);
                    $ProductImage->insert([
                        'ProductID' => $Product_id,
                        'FileName' => $newName
                    ]);
                }
            }
        }

        return $this->response->setJSON(['msg' => 'success']);
    }

    public function GetProductImage() {
        $ProductImage = new ProductImage();

        return $this->response->setJSON($ProductImage->where('ProductID', $this->request->getVar('product_id'))->findAll());
    }

    public function GetProductAll() {

        $u_id = $this->session->get('u_id');

        $str = "SELECT X.ProducID,X.ProducCode,X.Name,X.Prize,X.Description,X.Created_at,C.Name Catname,X.stocks  FROM tbl_products X
            LEFT JOIN tbl_category C ON X.CategoryID = C.CategoryID
            WHERE X.IsActive = 1 AND X.Created_by = $u_id";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
    }

    public function GetProductById() {
        $str = "SELECT X.ProducID,X.ProducCode,X.Name,X.Prize,X.Description,X.Created_at,C.CategoryID,X.stocks,C.Name Catname FROM tbl_products X
            LEFT JOIN tbl_category C ON X.CategoryID = C.CategoryID
            WHERE X.IsActive = 1 AND X.ProducID = :productid:";
		
		$query = $this->db->query($str,['productid' => $this->request->getVar('product_id')]);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
    }

    public function userManagement() {
        if($this->session->has('u_id')) {
			return view('vendors/user_management');
		}
		return view('index');
    }

    public function Dashboard() {
        if($this->session->has('u_id')) {
			return view('vendors/home.php');
		}
		return view('index');
    }

    public function Orders() {
        if($this->session->has('u_id')) {
			return view('vendors/orders');
		}
		return view('index');
    }

    public function Products() {
        if($this->session->has('u_id')) {
			return view('vendors/products');
		}
		return view('index');
    }

    public function ProductCategory() {
        if($this->session->has('u_id')) {
			return view('vendors/produc_cat');
		}
		return view('index');
    }

    public function Settings() {
        if($this->session->has('u_id')) {
			return view('vendors/Settings');
		}
		return view('index');
    }

    public function ChangePassword() {
        if($this->session->has('u_id')) {
			return view('vendors/ChangePassword');
		}
		return view('index');
    }

    public function Chat() {
        if($this->session->has('u_id')) {
			return view('Chat/chat');
		}
		return view('index');
    }

}
