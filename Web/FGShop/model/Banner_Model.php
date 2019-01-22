<?php
/**
*
*/
class Banner_Model
{

  public $id;
  public $id_product;

  function __construct()
  {
    # code...
  }

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from banner';
    $result = mysqli_query($conn, $sql);
    $list_brand = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $banner = new Banner_Model();
      $banner->id = $row['id'];
      $banner->id_product = $row['id_product'];
      $list_brand[] = $banner;
    }
    return $list_brand;
  }

  public function getNumRow($search_type = "", $search_text = "", $filter = 0) {
    $conn = FT_Database::instance()->getConnection();

     if ($filter != 0) {

    } else {
        if ($search_type == "") {
        $sql ="SELECT id FROM banner";
      } else {
        if ($search_type == "name_product") {
          $sql = "SELECT id FROM banner
          WHERE id_product IN (
            SELECT id FROM product
            WHERE $search_type
            LIKE '%$search_text%'
          )";
        } else {
          $sql = "SELECT id FROM banner
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
    $controller = 'banner';

    $conn = FT_Database::instance()->getConnection();

    if ($filter != 0) {

    } else {
        if ($search_type == "") {
        $sql ="SELECT * FROM banner
              ORDER BY id_product
              LIMIT $items_per_page OFFSET $pages";
      } else {
        if ($search_type == "name_product") {
          $sql = "SELECT * FROM banner
          WHERE id_product IN (
            SELECT id FROM product
            WHERE $search_type
            LIKE '%$search_text%'
          )
          ORDER BY id_product
          LIMIT $items_per_page OFFSET $pages";
        } else {
          $sql = "SELECT * FROM banner
          WHERE $search_type
          LIKE '%$search_text%'
          ORDER BY id_product
          LIMIT $items_per_page OFFSET $pages";
        }
      }
    }

    $result = mysqli_query($conn, $sql);
    $lists = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){

      require_once(PATH_ROOT . '/model/' . 'Product_Model.php');
      $product = new Product_Model();
      $product = $product->findById($row['id_product']);
      $name_product = $product->name_product;

      require_once(PATH_ROOT . '/model/' . 'ImageProduct_Model.php');
      $image_product = new ImageProduct_Model();
      $image_product = $image_product->image_banner($row['id_product']);
      $image_product = $image_product->path;

      $image_product = $image_product != null ? '<div class="text-center"><img src="'.$image_product.'" alt="" border=1 height=50 width=50></div>' : '<div class="text-center"><i class="ti-image"></i></div>';

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
        'Product' => $row['id_product'] . ' - ' . $name_product,
        '<div class="text-center"><i class="ti-image"></i></div>' => $image_product,
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
    $stmt = $conn->prepare("INSERT INTO banner (id_product) VALUES (?)");
    $stmt->bind_param("i", $this->id_product);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from banner where id='.$id;
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $banner = new Banner_Model();
        $banner->id = $row['id'];
        $banner->id_product = $row['id_product'];
        return $banner;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from banner where id='.$this->id;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE banner SET id_product = ? WHERE id=?");
    $stmt->bind_param("ii", $this->id_product, $_GET['id']);
    $stmt->execute();
    $stmt->close();
  }
}
