<?php
/**
*
*/
class Order_Model
{

  public $id;
  public $id_user;
  public $status;
  public $phone;
  public $delivery_address;
  public $delivery_date;
  public $order_date;
  public $desc;

  function __construct()
  {
    # code...
  }

   public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from `order`';
    $result = mysqli_query($conn, $sql);
    $list_order = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $order = new Order_Model();
      $order->id = $row['id'];
      $order->id_user = $row['id_user'];
      $order->phone = $row['phone'];
      $order->status = $row['status'];
      $order->delivery_address = $row['delivery_address'];
      $order->delivery_date = $row['delivery_date'];
      $order->order_date = $row['order_date'];
      $order->desc = $row['desc'];
      $list_order[] = $order;
    }
    return $list_order;
  }

  public function getNumRow($search_type = "", $search_text = "", $filter = 0) {
    $conn = FT_Database::instance()->getConnection();

    if ($filter != 0) {

    } else {
        if ($search_type == "") {
        $sql ="SELECT id FROM `order`";
      } else {
        if ($search_type == "username") {
          $sql = "SELECT id FROM `order`
          WHERE id_user IN (
            SELECT id FROM users
            WHERE $search_type
            LIKE '%$search_text%'
          )";
        } else {
          $sql = "SELECT id FROM `order`
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
    $controller = 'order';

    $conn = FT_Database::instance()->getConnection();


    if ($filter != 0) {

    } else {
        if ($search_type == "") {
        $sql ="SELECT * FROM `order`
              ORDER BY status, id_user
              LIMIT $items_per_page OFFSET $pages";
      } else {
        if ($search_type == "username") {
          $sql = "SELECT * FROM `order`
          WHERE id_user IN (
            SELECT id FROM users
            WHERE $search_type
            LIKE '%$search_text%'
          )
          ORDER BY status, id_user
          LIMIT $items_per_page OFFSET $pages";
        } else {
          $sql = "SELECT * FROM `order`
          WHERE $search_type
          LIKE '%$search_text%'
          ORDER BY status, id_user
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
      $username = new Users_Model();
      $username = $username->findById($row['id_user']);
      $username = $username->username;

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
        'Order' => $username,
        'Phone' => $row['phone'],
        'Status' => $row['status'],
        'Date order' => $row['order_date'],
        'Delivery Add' => $row['delivery_address'],
        'Delivery Date' => $row['delivery_date'],

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
    $stmt = $conn->prepare("INSERT INTO `order` (id_user, status, phone, delivery_address, delivery_date, order_date, `desc`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $this->id_user, $this->status, $this->phone, $this->delivery_address, $this->delivery_date, $this->order_date, $this->desc);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from `order` where id='.$id;
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $order = new Order_Model();
        $order->id = $row['id'];
        $order->id_user = $row['id_user'];
        $order->status = $row['status'];
        $order->phone = $row['phone'];
        $order->delivery_address = $row['delivery_address'];
        $order->delivery_date = $row['delivery_date'];
        $order->order_date = $row['order_date'];
        $order->desc = $row['desc'];
        return $order;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from `order` where id='.$this->id;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE `order` SET id_user = ?, phone = ?, status = ?, delivery_address = ?, delivery_date = ?, order_date = ?, `desc` = ? WHERE id = ? ");
     $stmt->bind_param("issssssi", $this->id_user, $this->phone, $this->status, $this->delivery_address, $this->delivery_date, $this->order_date, $this->desc, $_GET['id']);
    $stmt->execute();
    $stmt->close();
  }


  public function group_with_id($id_user){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from `order` where id_user = ' . $id_user;
    $result = mysqli_query($conn, $sql);
    $list_order = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_array($result)){
      $order = new Order_Model();
      $order->id = $row['id'];
      $order->id_user = $row['id_user'];
      $order->phone = $row['phone'];
      $order->status = $row['status'];
      $order->delivery_address = $row['delivery_address'];
      $order->delivery_date = $row['delivery_date'];
      $order->order_date = $row['order_date'];
      $order->desc = $row['desc'];
      $list_order[] = $order;
    }
    return $list_order;
  }
}
