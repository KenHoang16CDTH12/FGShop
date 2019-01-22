<?php
/**
*
*/
class ImageUser_Model
{

  public $id;
  public $id_user;
  public $path;
  public $type;

  function __construct()
  {
    # code...
  }

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from image_user';
    $result = mysqli_query($conn, $sql);
    $list_image_user = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $image_user = new ImageUser_Model();
      $image_user->id = $row['id'];
      $image_user->id_user = $row['id_user'];
      $image_user->path = $row['path'];
      $image_user->type = $row['type'];
      $list_image_user[] = $image_user;
    }
    return $list_image_user;
  }

  public function getNumRow($search_type = "", $search_text = "", $filter = 0) {
    $conn = FT_Database::instance()->getConnection();

     if ($filter != 0) {

    } else {
        if ($search_type == "") {
        $sql ="SELECT id FROM image_user";
      } else {
        if ($search_type == "username") {
          $sql = "SELECT id FROM image_user
          WHERE id_user IN (
            SELECT id FROM users
            WHERE $search_type
            LIKE '%$search_text%'
          )";
        } else {
          $sql = "SELECT id FROM image_user
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
    $controller = 'ImageUser';

    $conn = FT_Database::instance()->getConnection();

     if ($filter != 0) {

    } else {
        if ($search_type == "") {
        $sql ="SELECT * FROM image_user
              ORDER BY id_user
              LIMIT $items_per_page OFFSET $pages";
      } else {
        if ($search_type == "username") {
          $sql = "SELECT * FROM image_user
          WHERE id_user IN (
            SELECT id FROM users
            WHERE $search_type
            LIKE '%$search_text%'
          )
          ORDER BY id_user
          LIMIT $items_per_page OFFSET $pages";
        } else {
          $sql = "SELECT * FROM image_user
          WHERE $search_type
          LIKE '%$search_text%'
          ORDER BY id_user
          LIMIT $items_per_page OFFSET $pages";
        }
      }
    }

    $result = mysqli_query($conn, $sql);
    $lists = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){

      require_once(PATH_ROOT . '/model/' . 'Users_Model.php');
      $user = new Users_Model();
      $user = $user->findById($row['id_user']);
      $username = $user->username;

      $path = $row['path'] != null ? '<div class="text-center"><img src="'.$row['path'].'" alt="" border=1 height=50 width=50></div>' : '<div class="text-center"><i class="ti-image"></i></div>';

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
        'User' => $row['id_user'] . ' - ' . $username,
        'Type' => $row['type'],

        '<div class="text-center"><i class="ti-image"></i></div>' => $path,

        '<div class="text-center"><i class="ti-pencil-alt"></i></div>' =>
        '<div class="text-center"><a href="admin.php?controller='. $controller . '&action=edit&id=' . $id . '&token='.$token.'"><i class="ti-pencil-alt"></i></a></div>',

        '<div class="text-center"><i class="ti-close"></i></div>' =>
        '<div class="text-center"><a href="#"><i class="ti-close"  onclick="'.$confirm.'"></i></a></div>',
      ];
    }
    return $lists;
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO image_user (id_user, `path`, type) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $this->id_user, $this->path, $this->type);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from image_user where id='.$id;
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $image_user = new ImageUser_Model();
        $image_user->id = $row['id'];
        $image_user->id_user = $row['id_user'];
        $image_user->path = $row['path'];
        $image_user->type = $row['type'];
        return $image_user;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from image_user where id='.$this->id;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE image_user SET id_user = ?, `path` = ?, type = ? WHERE id=?");
    $stmt->bind_param("issi", $this->id_user, $this->path, $this->type, $_GET['id']);
    $stmt->execute();
    $stmt->close();
  }


  public function image_primary($id_user) {
    $conn = FT_Database::instance()->getConnection();
    $sql = "select * from image_user where id_user = $id_user and type = 'PRIMARY'";
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $image_user = new ImageUser_Model();
        $image_user->id = $row['id'];
        $image_user->id_user = $row['id_user'];
        $image_user->path = $row['path'];
        $image_user->type = $row['type'];
        return $image_user;
  }

  public function image_banner($id_user) {
    $conn = FT_Database::instance()->getConnection();
    $sql = "select * from image_user where id_user = $id_user and type = 'BANNER'";
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $image_user = new ImageUser_Model();
        $image_user->id = $row['id'];
        $image_user->id_user = $row['id_user'];
        $image_user->path = $row['path'];
        $image_user->type = $row['type'];
        return $image_user;
  }

  public function image_detail($id_user) {
    $conn = FT_Database::instance()->getConnection();
    $sql = "select * from image_user where id_user = $id_user and type = 'DETAIL'";
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $image_user = new ImageUser_Model();
        $image_user->id = $row['id'];
        $image_user->id_user = $row['id_user'];
        $image_user->path = $row['path'];
        $image_user->type = $row['type'];
        return $image_user;
  }

  public function image_logo($id_user) {
    $conn = FT_Database::instance()->getConnection();
    $sql = "select * from image_user where id_user = $id_user and type = 'LOGO'";
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $image_user = new ImageUser_Model();
        $image_user->id = $row['id'];
        $image_user->id_user = $row['id_user'];
        $image_user->path = $row['path'];
        $image_user->type = $row['type'];
        return $image_user;
  }
}
