<?php
/**
*
*/
class Image_Model
{

  public $id;
  public $name_img;
  public $big_img;
  public $small_img;
  public $details_img;

  function __construct()
  {
    # code...
  }

  public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from image';
    $result = mysqli_query($conn, $sql);
    $list_image = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $image = new Image_Model();
      $image->id = $row['id'];
      $image->name_img = $row['name_img'];
      $image->big_img = $row['big_img'];
      $image->small_img = $row['small_img'];
      $image->details_img = $row['details_img'];
      $list_image[] = $image;
    }
    return $list_image;
  }

  public function getNumRow() {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM image");

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

  public function getTable($pages, $token){

    //set the number of items to display per page
    $items_per_page = 10;
    $controller = 'image';

    $conn = FT_Database::instance()->getConnection();

    $sql = 'select * from image LIMIT ' . $items_per_page . ' OFFSET ' . $pages;

    $result = mysqli_query($conn, $sql);
    $lists = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){

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
        'Name' => $row['name_img'],
        'Big' => $row['big_img'],
        'Small' => $row['small_img'],
        'Details' => $row['details_img'],

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
    $stmt = $conn->prepare("INSERT INTO image (name, big_img, small_img, details_img) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sss", $this->name_img, $this->big_img, $this->small_img, $this->details_img);
    $rs = $stmt->execute();
    $this->id = $stmt->insert_id;
    $stmt->close();
    return $rs;
  }

  public function findById($id){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from image where id='.$id;
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $image = new Image_Model();
        $image->id = $row['id'];
        $image->name_img = $row['name_img'];
        $image->big_img = $row['big_img'];
        $image->small_img = $row['small_img'];
        $image->details_img = $row['details_img'];
        return $image;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from image where id='.$this->id;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE image SET name_img = ?, big_img = ?, small_img = ?, details_img = ? WHERE id=?");
    $stmt->bind_param("ssssi", $this->name_img, $this->big_img, $this->small_img, $this->details_img, $_GET['id']);
    $stmt->execute();
    $stmt->close();
  }

}
