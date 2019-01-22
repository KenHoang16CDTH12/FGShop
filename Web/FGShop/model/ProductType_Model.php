<?php
/**
*
*/
class ProductType_Model
{

  public $id;
  public $name_type;
  public $image;
  public $id_group;

  public function __construct() {
    //code
  }

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from product_type';
    $result = mysqli_query($conn, $sql);
    $list_product_type = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $product_type = new ProductType_Model();
      $product_type->id = $row['id'];
      $product_type->name_type = $row['name_type'];
      $product_type->image = $row['image'];
      $product_type->id_group = $row['id_group'];
      $list_product_type[] = $product_type;
    }
    return $list_product_type;
  }

  public function getNumRow($search_type = "", $search_text = "", $filter = 0) {
    $conn = FT_Database::instance()->getConnection();


    if ($filter != 0) {

    } else {
        if ($search_type == "") {
        $sql ="SELECT id FROM product_type";
      } else {
        if ($search_type == "name_group") {
          $sql = "SELECT id FROM product_type
          WHERE id_group IN (
            SELECT id FROM group_product_type
            WHERE $search_type
            LIKE '%$search_text%'
          )";
        } else {
          $sql = "SELECT id FROM product_type
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
    $controller = 'ProductType';

    $conn = FT_Database::instance()->getConnection();

    if ($filter != 0) {

    } else {
        if ($search_type == "") {
        $sql ="SELECT * FROM product_type
              ORDER BY id_group
              LIMIT $items_per_page OFFSET $pages";
      } else {
        if ($search_type == "name_group") {
          $sql = "SELECT * FROM product_type
          WHERE id_group IN (
            SELECT id FROM group_product_type
            WHERE $search_type
            LIKE '%$search_text%'
          )
          ORDER BY id_group
          LIMIT $items_per_page OFFSET $pages";
        } else {
          $sql = "SELECT * FROM product_type
          WHERE $search_type
          LIKE '%$search_text%'
          ORDER BY id_group
          LIMIT $items_per_page OFFSET $pages";
        }
      }
    }

    $result = mysqli_query($conn, $sql);
    $lists = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){

      $image = $row['image'] != null ? '<div class="text-center"><img src="'.$row['image'].'" alt="" border=1 height=50 width=50></div>' : '<div class="text-center"><i class="ti-image"></i></div>';

      $id = $row['id'];
      require_once(PATH_ROOT . '/model/' . 'GroupProductType_Model.php');
      $group_product_type = new GroupProductType_Model();
      $object = $group_product_type->findById($row['id_group']);
      $name_group = $object->name_group;


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
        'Name' => $row['name_type'],
        'Group' => $name_group,

        '<div class="text-center"><i class="ti-image"></i></div>' => $image,

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
    $stmt = $conn->prepare("INSERT INTO product_type (name_type, image, id_group) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $this->name_type, $this->image, $this->id_group);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from product_type where id='.$id;
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $product_type = new ProductType_Model();
        $product_type->id = $row['id'];
        $product_type->name_type = $row['name_type'];
        $product_type->image = $row['image'];
        $product_type->id_group = $row['id_group'];
        return $product_type;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from product_type where id='.$this->id;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE product_type SET name_type = ?, image = ?, id_group = ? WHERE id=?");
    $stmt->bind_param("ssii", $this->name_type, $this->image, $this->id_group, $_GET['id']);
    $stmt->execute();
    $stmt->close();
  }

  public function group_with_id($id_group){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from product_type where id_group = ' . $id_group;
    $result = mysqli_query($conn, $sql);
    $list_product_type = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_array($result)){
      $product_type = new ProductType_Model();
      $product_type->id = $row['id'];
      $product_type->name_type = $row['name_type'];
      $product_type->image = $row['image'];
      $product_type->id_group = $row['id_group'];
      $list_product_type[] = $product_type;
    }
    return $list_product_type;
  }
}
