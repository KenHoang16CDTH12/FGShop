<?php
/**
*
*/
class Users_Model
{

  public $id;
  public $name;
  public $username;
  public $password;
  public $birthdate;
  public $phone;
  public $gender;
  public $identify_number;
  public $wallet;
  public $is_social;
  public $status;
  public $token;
  public $id_user_type;

  function __construct()
  {
    # code...
  }

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from users';
    $result = mysqli_query($conn, $sql);
    $list_users = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $users = new Users_Model();
      $users->id = $row['id'];
      $users->name = $row['name'];
      $users->username = $row['username'];
      $users->password = $row['password'];
      $users->birthdate = $row['birthdate'];
      $users->phone = $row['phone'];
      $users->gender = $row['gender'];
      $users->identify_number = $row['identify_number'];
      $users->wallet = $row['wallet'];
      $users->is_social = $row['is_social'];
      $users->status = $row['status'];
      $users->token = $row['token'];
      $users->id_user_type = $row['id_user_type'];
      $list_users[] = $users;
    }
    return $list_users;
  }

  public function getNumRow($search_type = "", $search_text = "", $filter = 0) {
    $conn = FT_Database::instance()->getConnection();

    if ($filter != 0) {

    } else {
      if ($search_type == "") {
        $sql ="SELECT id FROM users";
      } else {
        if ($search_type == "name_user_type") {
          $sql = "SELECT id FROM users
          WHERE id_user_type IN (
            SELECT id FROM user_type
            WHERE $search_type
            LIKE '%$search_text%'
          );";
        } else {
          $sql = "SELECT id FROM users
          WHERE $search_type
          LIKE '%$search_text%'";
        }
      }
    }

    $stmt = $conn->prepare($sql);
    if ($stmt) {
      $stmt->execute();
      $stmt->bind_result($id);
      $stmt->store_result();
      /*Fetch the value*/
      $stmt->fetch();
      return $stmt->num_rows;
    } else {
      return 0;
    }
  }

  public function getTable($pages, $token, $search_type = "", $search_text = "", $filter = 0){

    //set the number of items to display per page
    $items_per_page = 10;
    $controller = "user";

    $conn = FT_Database::instance()->getConnection();

    if ($filter != 0) {

    } else {
        if ($search_type == "") {
        $sql ="SELECT * FROM users
              ORDER BY id_user_type, name
              LIMIT $items_per_page OFFSET $pages";
      } else {
        if ($search_type == "name_user_type") {
          $sql = "SELECT * FROM users
          WHERE id_user_type IN (
            SELECT id FROM user_type
            WHERE $search_type
            LIKE '%$search_text%'
          )
          ORDER BY id_user_type, name
          LIMIT $items_per_page OFFSET $pages";
        } else {
          $sql = "SELECT * FROM users
          WHERE $search_type
          LIKE '%$search_text%'
          ORDER BY id_user_type, name
          LIMIT $items_per_page OFFSET $pages";
        }
      }
    }

    //$sql = 'select * from users';
    $result = mysqli_query($conn, $sql);
    $lists = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      require_once(PATH_ROOT . '/model/' . 'UserType_Model.php');
      $user_type = new UserType_Model();
      $object = $user_type->findById($row['id_user_type']);
      $role = $object->name_user_type;

      require_once(PATH_ROOT . '/model/' . 'ImageUser_Model.php');
      $image_user = new ImageUser_Model();
      $image_user = $image_user->image_primary($row['id']);
      $image_user = $image_user->path;

      $image_user = $image_user != null ? '<div class="text-center"><img src="'.$image_user.'" alt="" border=1 height=50 width=50></div>' : '<div class="text-center"><img src="assets/image/users/face-0.jpg" alt="" border=1 height=50 width=50></div>';

      $id = $row['id'];
      $href =  "admin.php?controller=$controller&action=delete&id=$id&token=$token";
      $confirm = "swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this imaginary file!',
            icon: 'warning',
            buttons: [
              'No, cancel it!',
              'Yes, I am sure!'
            ],
            dangerMode: true,
          }).then(function(isConfirm) {
            if (isConfirm) {
              swal({
                title: 'Shortlisted!',
                text: 'Candidates are successfully shortlisted!',
                icon: 'success',
              }).then(function() {
                form.submit(); // <--- submit form programmatically
              });
              window.location.href = '".$href."';
            } else {
              swal('Cancelled', 'Your imaginary file is safe :)', 'error');
            }
      })";
      $lists[] = [
        '#' => $id,
        'Username' => $row['username'],
        'Name' => $row['name'],
        'Gender' => $row['gender'],
        'Birthdate' => $row['birthdate'],
        'Identify' => $row['identify_number'],
        'Role' => $role,

        '<div class="text-center"><i class="ti-image"></i></div>' => $image_user,

        '<div class="text-center"><i class="ti-pencil-alt"></i></div>' =>
        '<div class="text-center"><a href="admin.php?controller='.$controller.'&action=edit&id=' . $id . '&token='.$token.'"><i class="ti-pencil-alt"></i></a></div>',

        '<div class="text-center"><i class="ti-close"></i></div>' =>
        '<div class="text-center"><a href="#"><i class="ti-close"  onclick="'.$confirm.'"></i></a></div>',
      ];
    }
    return $lists;
  }

 public function getNumRowReport() {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT `order`.id_user
            FROM `order`, order_detail, users, product
            WHERE `order`.id = order_detail.id_order
            AND `order`.id_user = users.id
            AND order_detail.id_product = product.id
            AND `order`.status = 'PLACED'
            GROUP BY `order`.id_user");
      if ($stmt) {
        $stmt->execute();
        $stmt->store_result();
        /*Fetch the value*/
        $stmt->fetch();
        return $stmt->num_rows;
      } else {
        return 0;
      }
  }

  public function getTableReport($pages, $token) {
     //set the number of items to display per page
    $items_per_page = 10;
    $controller = "Report";

    $conn = FT_Database::instance()->getConnection();
    $sql = "SELECT `order`.id_user, users.username, SUM(product.price * order_detail.quanity) as total, `order`.status
            FROM `order`, order_detail, users, product
            WHERE `order`.id = order_detail.id_order
            AND `order`.id_user = users.id
            AND order_detail.id_product = product.id
            AND `order`.status = 'PLACED'
            GROUP BY `order`.id_user, users.username
            LIMIT $items_per_page OFFSET $pages;";
    //$sql = 'select * from users';
    $result = mysqli_query($conn, $sql);
    $lists = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){

      require_once(PATH_ROOT . '/model/' . 'ImageUser_Model.php');
      $image_user = new ImageUser_Model();
      $image_user = $image_user->image_primary($row['id_user']);
      $image_user = $image_user->path;

      $image_user = $image_user != null ? '<div class="text-center"><img src="'.$image_user.'" alt="" border=1 height=50 width=50></div>' : '<div class="text-center"><img src="assets/image/users/face-0.jpg" alt="" border=1 height=50 width=50></div>';
      $price = "<font color='blue'><b>".number_format($row['total'])."</b></font>";

      $lists[] = [
        '#' => $row['id_user'],
        '<div class="text-center"><i class="ti-image"></i></div>' => $image_user,
        'Username' => $row['username'],
        'total' => $price,
      ];
    }
    return $lists;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    if ($this->check_user_exists($this->username) == 0) {
      $stmt = $conn->prepare("INSERT INTO users (name, username, password, birthdate, phone, gender, identify_number, wallet, is_social, status, token, id_user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $this->password = $this->encrypt_password($this->password);
      $stmt->bind_param("sssssssisssi", $this->name, $this->username, $this->password, $this->birthdate, $this->phone, $this->gender, $this->identify_number, $this->wallet, $this->is_social, $this->status, $this->token, $this->id_user_type);
      $rs = $stmt->execute();
      $this->id = $stmt->insert_id;
      $stmt->close();
      return $this->id;
    } else {
      return null;
    }

  }

  public function findById($id){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'select * from users where id='.$id;
		$result = mysqli_query($conn, $sql);
		if(!$result)
			die('Error: ');
		$row = mysqli_fetch_assoc($result);
        $users = new Users_Model();
        $users->id = $row['id'];
        $users->name = $row['name'];
        $users->username = $row['username'];
        $users->password = $row['password'];
        $users->birthdate = $row['birthdate'];
        $users->phone = $row['phone'];
        $users->gender = $row['gender'];
        $users->identify_number = $row['identify_number'];
        $users->wallet = $row['wallet'];
        $users->is_social = $row['is_social'];
        $users->status = $row['status'];
        $users->token = $row['token'];
        $users->id_user_type = $row['id_user_type'];
        return $users;
	}

	public function delete(){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'delete from users where id='.$this->id;
		$result = mysqli_query($conn, $sql);
		return $result;
	}
	public function update(){
		$conn = FT_Database::instance()->getConnection();
		$stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, password = ?, birthdate = ?, phone = ?, gender = ?, identify_number = ?, wallet = ?, is_social = ?, status = ?, token = ?, id_user_type = ? WHERE id=?");
    $this->password = $this->encrypt_password($this->password);
		$stmt->bind_param("sssssssisssii", $this->name, $this->username, $this->password, $this->birthdate, $this->phone, $this->gender, $this->identify_number, $this->wallet, $this->is_social, $this->status, $this->token, $this->id_user_type, $_GET['id']);
		$stmt->execute();
		$stmt->close();
	}

  public function check_token_exists($token) {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM users WHERE token = ?");

    $stmt->bind_param("s", $token);

    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->store_result();
    /*Fetch the value*/
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        return $stmt->num_rows;
     } else {
        return 0;
     }
  }

  public function check_user_exists($username) {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");

    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->store_result();
    /*Fetch the value*/
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        return $stmt->num_rows;
     } else {
        return 0;
     }
  }

  public function validate_login($username, $password) {

    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");

    $password = $this->encrypt_password($password);
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->store_result();
    /*Fetch the value*/
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        /*Close statement*/
        $stmt->close();
        return $id;
     } else {
        /*Close statement*/
        $stmt->close();
        return 0;
     }
  }

  public function validate_logout($token) {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM users WHERE token = ?");

    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->store_result();
    /*Fetch the value*/
    $stmt->fetch();
    if ($stmt->num_rows > 0) {
        /*Close statement*/
        $stmt->close();
        return $id;
     } else {
        /*Close statement*/
        $stmt->close();
        return 0;
     }
  }

  public function generate_token($id) {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE users SET token = ? WHERE id = ?");
    $token = csrf_token();
    $stmt->bind_param("si", $token, $id);
    $stmt->execute();
    $stmt->close();
    return $token;
  }

  public function remove_token($id) {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE users SET token = ? WHERE id = ?");
    $token = "";
    $stmt->bind_param("si", $token, $id);
    $stmt->execute();
    $stmt->close();
  }

  public function encrypt_password($str) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $strEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $str, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
    return $strEncoded ;
  }

  public function decrypt_password($str = "") {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $strDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($str), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
    return $strDecoded;
  }
}
