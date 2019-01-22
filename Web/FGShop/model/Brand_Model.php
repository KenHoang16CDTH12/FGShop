<?php
/**
*
*/
class Brand_Model
{

  public $id;
  public $name_brand;

  function __construct()
  {
    # code...
  }

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from brand';
    $result = mysqli_query($conn, $sql);
    $list_brand = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $brand = new Brand_Model();
      $brand->id = $row['id'];
      $brand->name_brand = $row['name_brand'];
      $list_brand[] = $brand;
    }
    return $list_brand;
  }

  public function getNumRow($search_type = "", $search_text = "", $filter = 0 ) {
    $conn = FT_Database::instance()->getConnection();
    if ($filter != 0) {

    } else {
      if ($search_type == "") {
        $sql ="SELECT id FROM brand";
      } else {
        $sql = "SELECT id FROM brand
        WHERE $search_type
        LIKE '%$search_text%'";
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
    $controller = 'brand';

    $conn = FT_Database::instance()->getConnection();


    if ($filter != 0) {

    } else {
        if ($search_type == "") {
        $sql ="SELECT * FROM brand
              ORDER BY name_brand
              LIMIT $items_per_page OFFSET $pages";
      } else {
          $sql = "SELECT * FROM brand
          WHERE $search_type
          LIKE '%$search_text%'
          ORDER BY name_brand
          LIMIT $items_per_page OFFSET $pages";
      }
    }

    $result = mysqli_query($conn, $sql);
    $lists = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){

      require_once(PATH_ROOT . '/model/' . 'ImageBrand_Model.php');
      $image_brand = new ImageBrand_Model();
      $image_brand = $image_brand->image_logo($row['id']);
      $image_brand = $image_brand->path;

      $image_brand = $image_brand != null ? '<div class="text-center"><img src="'.$image_brand.'" alt="" border=1 height=50 width=50></div>' : '<div class="text-center"><i class="ti-image"></i></div>';


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
        'Name' => $row['name_brand'],

         '<div class="text-center"><i class="ti-image"></i></div>' => $image_brand,

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
    $stmt = $conn->prepare("INSERT INTO brand (name_brand) VALUES (?)");
    $stmt->bind_param("s", $this->name_brand);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from brand where id='.$id;
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $brand = new Brand_Model();
        $brand->id = $row['id'];
        $brand->name_brand = $row['name_brand'];
        return $brand;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from brand where id='.$this->id;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE brand SET name_brand = ? WHERE id=?");
    $stmt->bind_param("si", $this->name_brand, $_GET['id']);
    $stmt->execute();
    $stmt->close();
  }
}
