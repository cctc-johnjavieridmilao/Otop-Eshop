<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ProductsModel;
use App\Models\ProductImage;
use App\Models\Notifiers;

class Admin extends BaseController
{
	public function index() {
		if($this->session->has('u_id')) {
			return view('home');
		}
		return view('index');
	}

    public function CountOrders() {

		$str = "SELECT * FROM (
            (SELECT COUNT(1) Pending FROM tbl_purchased_orders WHERE Status = 'Pending') AS Pending,
            (SELECT COUNT(1) Canceled FROM tbl_purchased_orders WHERE Status = 'Canceled') AS Canceled,
            (SELECT COUNT(1) Completed FROM tbl_purchased_orders WHERE Status = 'Completed') AS Completed,
            (SELECT COUNT(1) ForDelivery FROM tbl_purchased_orders WHERE Status = 'Approved') AS ForDelivery,
            (SELECT COUNT(1) Vendors FROM user_access WHERE user_type = 'vendor') AS Vendors,
            (SELECT COUNT(1) Clients FROM user_access WHERE user_type = 'user') AS Clients,
            (SELECT COUNT(1) Products FROM tbl_products) AS Products,
            (SELECT COUNT(1) Category FROM tbl_category) AS Category
          );";
	
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
    }

    public function GetUserOrders() {

        $status = $this->request->getVar('status');

        if($status == 'All') {
            $str = "SELECT X.OrderID,X.OrderCode,X.PaymentMethod,X.Created_at,D.Full_Address,
            C.Quantity,C.Prize,C.Total_price,P.Name,P.Description,X.Status,P.ProducID,
             X.CancelRemarks,CONCAT(U.firtname, ' ', U.lastname) Customer,UU.company_name
              FROM tbl_purchased_orders X 
                    LEFT JOIN tbl_user_address D ON D.AddresID = X.AddressID
                    LEFT JOIN tbl_cart C ON C.CartID = X.CartID
                    LEFT JOIN user_access U ON U.RecID = X.CustomerID
                    LEFT JOIN tbl_products P ON C.ProductID = P.ProducID
                    LEFT JOIN user_access UU ON UU.RecID = P.Created_by";
        } else {
            $str = "SELECT X.OrderID,X.OrderCode,X.PaymentMethod,X.Created_at,D.Full_Address,
            C.Quantity,C.Prize,C.Total_price,P.Name,P.Description,X.Status,P.ProducID,
             X.CancelRemarks,CONCAT(U.firtname, ' ', U.lastname) Customer,UU.company_name
              FROM tbl_purchased_orders X 
                    LEFT JOIN tbl_user_address D ON D.AddresID = X.AddressID
                    LEFT JOIN tbl_cart C ON C.CartID = X.CartID
                    LEFT JOIN user_access U ON U.RecID = X.CustomerID
                    LEFT JOIN tbl_products P ON C.ProductID = P.ProducID
                    LEFT JOIN user_access UU ON UU.RecID = P.Created_by
                    WHERE X.Status = '$status' ";
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

        $res = $Category->insert(['Name' => $this->request->getVar('cat_name')]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}

        $inserted_id = $Category->getInsertID();

        $Category->update($inserted_id, ['CategoryCode' => $inserted_id]);

		return $this->response->setJSON(['msg' => 'success']);
    }

    public function GetProductsCategory() {
        $Category = new CategoryModel();

        $str = "SELECT X.*,U.company_name FROM tbl_category X
        LEFT JOIN user_access U ON U.RecID = X.Created_by";
	
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());


        //return $this->response->setJSON($Category->where('IsActive',1)->findAll());
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

        $imagefile = $this->request->getFiles();
        $path = './public/uploads/';

        $res = $Products->insert([
            'CategoryID' => $this->request->getVar('p_cat'),
            'Name' => $this->request->getVar('p_name'),
            'Prize' => $this->request->getVar('p_prize'),
            'Description' => $this->request->getVar('p_description'),
            'stocks' => $this->request->getVar('p_stocks')
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
                        'FileName' => $newName
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

        $str = "SELECT X.ProducID,X.ProducCode,X.Name,X.Prize,X.Description,X.Created_at,C.Name Catname,X.stocks,U.company_name FROM tbl_products X
            LEFT JOIN tbl_category C ON X.CategoryID = C.CategoryID
            LEFT JOIN user_access U ON U.RecID = X.Created_by
            WHERE X.IsActive = 1";
		
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

    public function CreateUser() {
        $user_model = new UserModel();
        $notify = new Notifiers();

        $password = GeneratePassword();

        $data = [
			'firtname'   => $this->request->getVar('fname'),
			'lastname'   => $this->request->getVar('lname'),
			'username'   => $this->request->getVar('username'),
			'email'      => $this->request->getVar('email'),
			'middlename' => $this->request->getVar('mname'),
			'password'   => hashPassword($password),
			'user_type'  => $this->request->getVar('role'),
            'company_name'  => $this->request->getVar('cname'),
            'company_address'  => $this->request->getVar('caddress'),
			'created_at' => date('Y-m-d H:i:s')
		];

		$res = $user_model->insert($data);

		$name = $this->request->getVar('fname') . ' ' . $this->request->getVar('mname') . ' ' . $this->request->getVar('lname');
		$user_id = $user_model->getInsertID();

        $body = 'Hi '. $name;
        $body .= 'This is your account details: ';
        $body .= 'Username: ' . $this->request->getVar('username');
        $body .= 'Password: ' . $this->request->getVar('password');

        $notify->SendEmailNotification($this->request->getVar('email'),'OTOP ACCOUNT', $body);

		if($res) {
			return $this->response->setJSON([
				'msg' => 'success',
				'user_type' => $this->request->getVar('role'),
				'email' => $this->request->getVar('email'),
				'username' => $this->request->getVar('username'),
				'name' => $name,
				'user_id' => $user_id,
                'password' => $password
			]);
		}

		return $this->response->setJSON(['msg' => $res]);
    }

    public function userManagement() {
        if($this->session->has('u_id')) {
			return view('admin/user_management');
		}
		return view('index');
    }

    public function Dashboard() {
        if($this->session->has('u_id')) {
			return view('admin/home.php');
		}
		return view('index');
    }

    public function Orders() {
        if($this->session->has('u_id')) {
			return view('admin/orders');
		}
		return view('index');
    }

    public function Products() {
        if($this->session->has('u_id')) {
			return view('admin/products');
		}
		return view('index');
    }

    public function ProductCategory() {
        if($this->session->has('u_id')) {
			return view('admin/produc_cat');
		}
		return view('index');
    }

    public function Settings() {
        if($this->session->has('u_id')) {
			return view('admin/Settings');
		}
		return view('index');
    }

    public function ChangePassword() {
        if($this->session->has('u_id')) {
			return view('admin/ChangePassword');
		}
		return view('index');
    }

    public function Chat() {
        if($this->session->has('u_id')) {
			return view('Chat/AdminChat');
		}
		return view('index');
    }

}
