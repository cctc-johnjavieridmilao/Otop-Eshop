<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductsModel;
use App\Models\ProductImage;

class Home extends BaseController
{
	public function index() {
		if($this->session->has('u_id')) {
			return view('home');
		}
		return view('index');
	}

	public function loginpage() {
		if($this->session->has('u_id')) {
			return view('home');
		}
		return view('login');
	}

	public function register() {
		if($this->session->has('u_id')) {
			return view('home');
		}
		return view('register');
	}

	public function Pending() {
		if($this->session->has('u_id')) {
			return view('Purchases/pending');
		}
		return view('login');
	}

	public function ToReceive() {
		if($this->session->has('u_id')) {
			return view('Purchases/ToReceive');
		}
		return view('login');
	}

	public function Completed() {
		if($this->session->has('u_id')) {
			return view('Purchases/Completed');
		}
		return view('login');
	}

	public function Profile() {
		if($this->session->has('u_id')) {
			return view('AccountSettings/profile');
		}
		return view('login');
	}

	public function Addresses() {
		if($this->session->has('u_id')) {
			return view('AccountSettings/addresses');
		}
		return view('login');
	}

	public function Canceled() {
		if($this->session->has('u_id')) {
			return view('Purchases/CanceledOrders');
		}
		return view('login');
	}

	public function ChangePassword() {
		if($this->session->has('u_id')) {
			return view('AccountSettings/changepass');
		}
		return view('login');
	}

	public function ChatSupport() {
		if($this->session->has('u_id')) {
			return view('ChatSupport');
		}
		return view('login');
	}

	public function AboutUs() {
		return view('AboutUs');
	}

	public function ContactUs() {
		return view('ContactUs');
	}

	public function UploadMessageFile() {
		$file = $this->request->getFile('file');

		if (!empty($file)) {

			$file_name = $file->getRandomName();
 
			$file->move('./public/message_uploads/', $file_name);

			return $file_name;
		}
	}

	public function GetProfile() {
		$user = $this->session->get('u_id');
		$user_model = new UserModel();

		return $this->response->setJSON($user_model->where('RecID', $user)->findAll());
	}

	public function OrderReceived() {
		$res = $this->db->table('tbl_purchased_orders')->where(['OrderID' => $this->request->getVar('order_id')])->update([
			'Status' => 'Completed',
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);
	}

	public function CacelOrder() {
		$res = $this->db->table('tbl_purchased_orders')->where(['OrderID' => $this->request->getVar('order_id')])->update([
			'Status' => 'Canceled',
			'CancelRemarks' => $this->request->getVar('reason'),
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);
	}

	public function AddNewAddress() {
		$user = $this->session->get('u_id');

		$res = $this->db->table('tbl_user_address')->insert([
			'CustomerID' => $user,
			'PhoneNumber' => $this->request->getVar('phone_number'),
			'Full_Address' => $this->request->getVar('address'),
			'PostalCode' => $this->request->getVar('postal_code'),
			'Created_at' => date('Y-m-d H:i:s'),
			'IsDefault' => 0,
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);
	}

	public function UpdateAddress() {

		$res = $this->db->table('tbl_user_address')->where(['AddresID' => $this->request->getVar('address_id')])->update([
			'PhoneNumber' => $this->request->getVar('phone_number'),
			'Full_Address' => $this->request->getVar('address'),
			'PostalCode' => $this->request->getVar('postal_code'),
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);
	}

	public function SetDefaultAddress() {

		$id = $this->request->getVar('addres_id');

		$this->db->table('tbl_user_address')->where(['IsDefault' => 1])->update([
			'IsDefault' => 0,
		]);

		$res = $this->db->table('tbl_user_address')->where(['AddresID' => $id])->update([
			'IsDefault' => 1,
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);
	}

	public function DeleteAddress() {

		$res = $this->db->table('tbl_user_address')->delete([
			'AddresID' => $this->request->getVar('addres_id'),
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);
	}

	public function UpdateProfile() {
		$user = $this->session->get('u_id');
		$user_model = new UserModel();

		$file = $this->request->getFile('file');

		if (!empty($file)) {

			$file_name = $file->getRandomName();
 
			$file->move('./public/profiles/', $file_name);

			$data = [
				'firtname' => $this->request->getVar('firstname'),
				'lastname' => $this->request->getVar('lastname'),
				'middlename' => $this->request->getVar('middlename'),
				'email' => $this->request->getVar('email'),
				'username' => $this->request->getVar('username'),
				'logo' => $file_name
			];

			$this->session->set('logo', $file_name);

		} else {

			$data = [
				'firtname' => $this->request->getVar('firstname'),
				'lastname' => $this->request->getVar('lastname'),
				'middlename' => $this->request->getVar('middlename'),
				'email' => $this->request->getVar('email'),
				'username' => $this->request->getVar('username')
			];

		}

		$user_model->update($user, $data);

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function UpdatePassword() {
		$user = $this->session->get('u_id');
		$user_model = new UserModel();
		$current_pass = hashPassword($this->request->getVar('current_pass'));

		$user = $user_model->find($user);

		if($user['password'] != $current_pass) {
			return $this->response->setJSON(['msg' => 'Current password not found!']);
		}

		$res = $user_model->update($user, [
			'password' => hashPassword($this->request->getVar('new_pass'))
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);
		
	}

	public function GetVendors() {
		$user = (empty($this->session->get('u_id')) ? 0 : $this->session->get('u_id'));

		$str = "SELECT X.RecID,X.company_name,X.logo,
			(SELECT COUNT(1) FROM tbl_products WHERE Created_by = X.RecID) products_count,
			(SELECT COUNT(1) FROM tbl_followers WHERE VendorID = X.RecID) followers_count,
			(CASE WHEN (SELECT COUNT(1) FROM tbl_followers WHERE FollowedBy = $user AND VendorID = X.RecID) > 0 THEN 1 ELSE 0 END) isfollowed
			FROM user_access X 
			WHERE X.user_type = 'vendor' 
	   AND X.company_name IS NOT NULL;";
	
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function GetVendorsById() {

		$id = $this->request->getVar('id');

		$str = "SELECT X.RecID,X.company_name,X.logo,X.company_address,
			CONCAT(X.firtname, ' ',X.middlename, ' ',X.lastname) owner_name
			FROM user_access X 
			WHERE X.user_type = 'vendor' 
	   AND X.company_name IS NOT NULL AND X.RecID = $id;";
	
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function GetOrders() {

		$user = $this->session->get('u_id');
		$status = $this->request->getVar('status');

		$str = "SELECT X.OrderID,X.OrderCode,X.PaymentMethod,X.Created_at,D.Full_Address,
		C.Quantity,C.Prize,C.Total_price,P.Name,P.Description,X.Status,P.ProducID,X.CancelRemarks
		  FROM tbl_purchased_orders X 
				LEFT JOIN tbl_user_address D ON D.AddresID = X.AddressID
				LEFT JOIN tbl_cart C ON C.CartID = X.CartID
				LEFT JOIN user_access U ON U.RecID = X.CustomerID
				LEFT JOIN tbl_products P ON C.ProductID = P.ProducID
	   WHERE X.Status = :Status: AND X.CustomerID = :CustomerID:";
	
		$query = $this->db->query($str, ['CustomerID' => $user,'Status' => $status]);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function GetProducts() {

		$key = $this->request->getVar('key');

		if(empty($key)) {

			$str = "SELECT X.ProducID,X.ProducCode,X.Name,X.Prize,X.Description,X.Created_at,
			C.Name Catname,M.FileName,X.stocks,(CASE WHEN R.Rate IS NULL THEN 0 ELSE AVG(R.Rate) END) avg_rates FROM tbl_products X
				LEFT JOIN tbl_category C ON X.CategoryID = C.CategoryID
				LEFT JOIN (SELECT * FROM tbl_product_image GROUP BY ProductID) M on M.ProductID = X.ProducID
				LEFT JOIN tbl_rates R ON R.ProductID = X.ProducID
			WHERE X.IsActive = 1 AND X.stocks > 0 GROUP BY X.ProducID";

		} else {
			$str = "SELECT X.ProducID,X.ProducCode,X.Name,X.Prize,X.Description,X.Created_at,
			C.Name Catname,M.FileName,X.stocks,
			(CASE WHEN R.Rate IS NULL THEN 0 ELSE AVG(R.Rate) END) avg_rates
			 FROM tbl_products X
				LEFT JOIN tbl_category C ON X.CategoryID = C.CategoryID
				LEFT JOIN (SELECT * FROM tbl_product_image GROUP BY ProductID) M on M.ProductID = X.ProducID
				LEFT JOIN tbl_rates R ON R.ProductID = X.ProducID
			WHERE X.IsActive = 1 AND X.stocks > 0 AND (X.Name LIKE '%".$key."%' OR C.Name LIKE '%".$key."%') GROUP BY X.ProducID";
		}
	
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function GetProductsByVendor() {

		$vendor = $this->request->getVar('vendor');

		$str = "SELECT X.ProducID,X.ProducCode,X.Name,X.Prize,X.Description,X.Created_at,
		C.Name Catname,M.FileName,X.stocks,(CASE WHEN R.Rate IS NULL THEN 0 ELSE AVG(R.Rate) END) avg_rates FROM tbl_products X
			LEFT JOIN tbl_category C ON X.CategoryID = C.CategoryID
			LEFT JOIN (SELECT * FROM tbl_product_image GROUP BY ProductID) M on M.ProductID = X.ProducID
			LEFT JOIN tbl_rates R ON R.ProductID = X.ProducID
		WHERE X.IsActive = 1 AND X.Created_by = $vendor AND X.stocks > 0 GROUP BY X.ProducID";
	
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());

	}

	public function AddCart() {
		$user = $this->session->get('u_id');
		$prize = $this->request->getVar('prize');
		$quantity = $this->request->getVar('quantity');
		$total = ($prize * $quantity);

		$check_product = $this->db->query('SELECT COUNT(1) count FROM tbl_cart WHERE CustomerID = :CustomerID: AND Ispurchased = 0 AND ProductID = :ProductID:',[
			'CustomerID' => $user,
			'ProductID'  => $this->request->getVar('product_id')
		]);

		if($check_product->getRow()->count > 0) {

			$getOrders = $this->db->query('SELECT X.Quantity,X.Prize FROM tbl_cart X WHERE X.CustomerID = :CustomerID: AND X.Ispurchased = 0 AND X.ProductID = :ProductID:',[
				'CustomerID' => $user,
				'ProductID' => $this->request->getVar('product_id')
			]);

			$db_quantity = intval($getOrders->getRow()->Quantity);
			$up_quantity = ($quantity + $db_quantity);
			$total_up_prize = ($up_quantity * $prize);


			$res = $this->db->table('tbl_cart')->where(['ProductID' => $this->request->getVar('product_id'),'CustomerID' => $user])->update([
				'Quantity' => $up_quantity,
				'Prize' => $prize,
				'Total_price' => $total_up_prize,
			]);
			
			
		} else {

			$res = $this->db->table('tbl_cart')->insert([
				'CustomerID' => $user,
				'ProductID' => $this->request->getVar('product_id'),
				'Quantity' => $quantity,
				'Prize' => $prize,
				'Total_price' => $total,
				'Created_at' => date('Y-m-d H:i:s'),
			]);

		}



		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function GetCart() {

		$user = $this->session->get('u_id');

		$res = $this->db->query('SELECT COUNT(*) countcart,
		 (CASE WHEN SUM(Total_price) IS NULL THEN 0.00 ELSE SUM(Total_price) END) total,(CASE WHEN SUM(Quantity) IS NULL THEN 0 ELSE SUM(Quantity) END) totalQuantity 
		 FROM tbl_cart WHERE CustomerID = :CustomerID: AND Ispurchased = 0',[
			'CustomerID' => $user,
		]);

		$total_cart = $res->getRow()->countcart;
		$total_prize = $res->getRow()->total;
		$totalQuantity = $res->getRow()->totalQuantity;

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success','total_cart' => $total_cart,'total_prize' => $total_prize, 'totalQuantity' => $totalQuantity]);

	}

	public function GetCartData() {

		$user = $this->session->get('u_id');

		$res = $this->db->query('SELECT X.*,P.Name FROM tbl_cart X
		          LEFT JOIN tbl_products P ON X.ProductID = P.ProducID
	             WHERE X.CustomerID = :CustomerID: AND X.Ispurchased = 0',[
			'CustomerID' => $user
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($res->getResultArray());

	}

	public function GetOrderCompletedById() {

		$id = $this->request->getVar('order_id');

		$str = "SELECT X.*,D.PhoneNumber,D.Full_Address,D.PostalCode,CONCAT(U.firtname, ' ', U.middlename, ' ',U.lastname) CustomerName,
		X.PaymentMethod,P.Name,C.Prize,C.Total_price,C.Quantity
		 FROM tbl_purchased_orders X
		  INNER JOIN tbl_user_address D ON D.AddresID = X.AddressID
		  INNER JOIN user_access U ON U.RecID = X.CustomerID
		  INNER JOIN tbl_cart C ON C.CartID = X.CartID
		  INNER JOIN tbl_products P ON P.ProducID = C.ProductID
		WHERE X.OrderID = :OrderID:";

		$res = $this->db->query($str,['OrderID' => $id]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($res->getResultArray());
	}

	public function DeleteCartItem() {
		$user = $this->session->get('u_id');

		$res = $this->db->query('DELETE FROM tbl_cart WHERE CartID = :CartID:',[
			'CartID' => $this->request->getVar('cart_id')
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function UpdateQuantity() {

		$product_id = $this->request->getVar('product_id');

		$str = "SELECT stocks FROM tbl_products WHERE ProducID = $product_id";

		$current_stocks = $this->db->query($str)->getRow()->stocks;

		if($this->request->getVar('quantity') > $current_stocks) {
			return $this->response->setJSON(['msg' => 'No Available Stocks!']);
		}

		$res = $this->db->query('UPDATE tbl_cart SET Quantity = :Quantity:,Total_price = :Total_price: WHERE CartID = :CartID:',[
			'Quantity' => $this->request->getVar('quantity'),
			'CartID'  => $this->request->getVar('cartid'),
			'Total_price'  => $this->request->getVar('total_price')
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function LesQuantity() {

		$res = $this->db->query('UPDATE tbl_cart SET Quantity = :Quantity:,Total_price = :Total_price: WHERE CartID = :CartID:',[
			'Quantity' => $this->request->getVar('quantity'),
			'CartID'  => $this->request->getVar('cartid'),
			'Total_price'  => $this->request->getVar('total_price')
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);

	}

	public function GetUserAddress() {

		$user = $this->session->get('u_id');

		$str = "SELECT X.*,CONCAT(U.firtname, ' ', U.middlename, ' ',U.lastname) CustomerName FROM tbl_user_address X
		LEFT JOIN user_access U ON U.RecID = X.CustomerID
	   WHERE X.CustomerID = :CustomerID:";

		$res = $this->db->query($str,[
			'CustomerID' => $user
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($res->getResultArray());

	}

	public function GetUserFullName() {

		$user = $this->session->get('u_id');

		$str = "SELECT CONCAT(firtname, ' ',middlename,' ',lastname) fullname FROM user_access WHERE RecID = $user";

		$res = $this->db->query($str);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['fullname' => $res->getRow()->fullname]);

	}

	public function CheckOut() {
		$user = $this->session->get('u_id');

		$getOrders = $this->db->query('SELECT X.CartID,X.CustomerID FROM tbl_cart X
	             WHERE X.CustomerID = :CustomerID: AND X.Ispurchased = 0',[
			'CustomerID' => $user
		]);

		foreach($getOrders->getResultArray() as $getOrder) {

			$res = $this->db->table('tbl_purchased_orders')->insert([
				'CustomerID' => $user,
				'AddressID' => $this->request->getVar('addressID'),
				'PaymentMethod' => $this->request->getVar('paymentMethod'),
				'CartID' => $getOrder['CartID'],
				'Status' => 'Pending',
				'Created_at' => date('Y-m-d H:i:s'),
			]);

			$inserted_id = $this->db->insertID();

			$this->db->table('tbl_purchased_orders')->where(['OrderID' => $inserted_id])->update([
				'OrderCode' => $inserted_id
			]);

			$this->db->table('tbl_cart')->where(['CartID' => $getOrder['CartID']])->update([
				'Ispurchased' => 1
			]);

		}

		return $this->response->setJSON(['msg' => 'success']);
		
	}

	public function SaveRating() {
		$user = $this->session->get('u_id');

		$this->db->table('tbl_rates')->insert([
			'ProductID' => $this->request->getVar('product_id'),
			'RatedBy' => $user,
			'Rate' => $this->request->getVar('rate'),
			'date' => date('Y-m-d H:i:s')
		]);

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function FollowVendor() {

		$user = $this->session->get('u_id');
		$VendorID = $this->request->getVar('vendor');

		$str = "SELECT COUNT(1) follow_count FROM tbl_followers WHERE VendorID = $VendorID AND FollowedBy = $user";

		$follow_count = $this->db->query($str)->getRow()->follow_count;

		if($follow_count > 0) {

			$this->db->query('DELETE FROM tbl_followers WHERE VendorID = :VendorID: AND FollowedBy = :FollowedBy:',[
				'VendorID' => $VendorID,
				'FollowedBy' => $user
			]);
			
		} else {

			$this->db->table('tbl_followers')->insert([
				'VendorID' => $VendorID,
				'FollowedBy' => $user,
				'DateFollowed' => date('Y-m-d H:i:s')
			]);

		}

		return $this->response->setJSON(['msg' => 'success']);

	}

	public function RegisterAccount() {
		$user_model = new UserModel();

		$data = [
			'firtname'   => $this->request->getVar('fname'),
			'lastname'   => $this->request->getVar('lname'),
			'username'   => $this->request->getVar('username'),
			'email'      => $this->request->getVar('email'),
			'middlename' => $this->request->getVar('mname'),
			'password'   => hashPassword($this->request->getVar('password')),
			'user_type'  => 'user',
			'lat'        => $this->request->getVar('lat'),
			'lang'       => $this->request->getVar('lang'),
			'created_at' => date('Y-m-d H:i:s')
		];

		$res = $user_model->insert($data);

		$name = $this->request->getVar('fname') . ' ' . $this->request->getVar('mname') . ' ' . $this->request->getVar('lname');
		$user_id = $user_model->getInsertID();

		if($res) {
			return $this->response->setJSON([
				'msg' => 'success',
				'user_type' => 'user',
				'email' => $this->request->getVar('email'),
				'username' => $this->request->getVar('username'),
				'name' => $name,
				'user_id' => $user_id
			]);
		}

		return $this->response->setJSON(['msg' => $res]);
	}
 
	public function Login() {
		$u_email = $this->request->getVar('u_email');
		$u_pass = hashPassword($this->request->getVar('u_pass'));
		$str = "SELECT * FROM user_access WHERE (email = BINARY '$u_email' OR username = BINARY '$u_email') AND password = :password: LIMIT 1";
		$cart_items = json_decode($this->request->getVar('cart'), true);

		$query = $this->db->query($str, [
			'password' => $u_pass
		]);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		if($query->getNumRows() == 0) {
			return $this->response->setJSON(['msg' => 'Incorrect Username or Password!']);
		} 

		$row = $query->getRow();

		$this->session->set('u_id', $row->RecID);
		$this->session->set('username', $row->username);
		$this->session->set('logo', $row->logo);
		$this->session->set('user_type', $row->user_type);
		$this->session->set('fname', strtoupper($row->firtname));
		$this->session->set('lastname', strtoupper($row->lastname));
		$this->session->set('middlename', strtoupper($row->middlename));

		if(!empty($cart_items)) {

			foreach($cart_items as $cart_item) {
				$this->db->table('tbl_cart')->insert([
					'CustomerID' => $row->RecID,
					'ProductID' => $cart_item['product_id'],
					'Quantity' => $cart_item['quantity'],
					'Prize' => $cart_item['prize'],
					'Total_price' => $cart_item['total_prize'],
					'Created_at' => date('Y-m-d H:i:s'),
				]);
			}

		}


		$this->db->table('user_access')->where(['RecID' => $row->RecID])->update([
			'lat' => $this->request->getVar('lat'),
			'lang' => $this->request->getVar('lang')
		]);

		return $this->response->setJSON(['msg' => 'success','fname' => $row->firtname, 'user_type' => $row->user_type, 'user_id' => $row->RecID]);
	}

	public function Logout() {
		$this->session->remove('u_id');
		$this->session->remove('user_type');
		$this->session->remove('fname');
		$this->session->remove('lastname');
		$this->session->remove('middlename');
		$this->session->destroy();

		return view('login');
	}

}
