<?php
/**
*
*/
class OrderDetail_Model
{

  public $id_order;
  public $id_product;
  public $quanity;

  function __construct()
  {
    # code...
  }
   public function all(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from order_detail';
    $result = mysqli_query($conn, $sql);
    $list_order_detail = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $order_detail = new OrderDetail_Model();
      $order_detail->id_order = $row['id_order'];
      $order_detail->id_product = $row['id_product'];
      $order_detail->quanity = $row['quanity'];
      $list_order_detail[] = $order_detail;
    }
    return $list_order_detail;
  }

  public function getNumRow($id_order) {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id_order FROM order_detail WHERE id_order = $id_order");
    if ($stmt) {
      $stmt->execute();
      $stmt->bind_result($id_order);
      $stmt->store_result();
      /*Fetch the value*/
      $stmt->fetch();
      return $stmt->num_rows;
    } else {
      return 0;
    }
  }

  public function getTable($pages, $token, $id_order){

    //set the number of items to display per page
    $items_per_page = 10;

    $conn = FT_Database::instance()->getConnection();

    $sql = 'select * from order_detail WHERE id_order = '. $id_order .' LIMIT ' . $items_per_page . ' OFFSET ' . $pages;

    $result = mysqli_query($conn, $sql);
    $lists = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){

      require_once(PATH_ROOT . '/model/' . 'Product_Model.php');
      $product = new Product_Model();
      $product = $product->findById($row['id_product']);
      $name_product = $product->name_product;
      $name_product = strlen($name_product) > 100 ? substr($name_product,0,100)."..." : $name_product;

      require_once(PATH_ROOT . '/model/' . 'ImageProduct_Model.php');
      $image_product = new ImageProduct_Model();
      $image_product = $image_product->image_primary($row['id_product']);
      $image_product = $image_product->path;
      $image_product = $image_product != null ? '<div class="text-center"><img src="'.$image_product.'" alt="" border=1 height=50 width=50></div>' : '<div class="text-center"><i class="ti-image"></i></div>';

      $price = $product->price;
      $total = $price * $row['quanity'];
      $lists[] = [
        '<div class="text-center"><i class="ti-image"></i></div>' => $image_product,
        'Product' => $name_product,
        'Quanity' => $row['quanity'],
        'Price' => number_format($price) . '$',
        'Total' => number_format($total) . '$',
      ];
    }
    return $lists;
  }


  public function getTotal($id_order){

    $conn = FT_Database::instance()->getConnection();

    $sql = 'select * from order_detail WHERE id_order = '. $id_order;

    $result = mysqli_query($conn, $sql);

    $total = 0;

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){

      require_once(PATH_ROOT . '/model/' . 'Product_Model.php');
      $product = new Product_Model();
      $product = $product->findById($row['id_product']);
      $price = $product->price;
      $total += $price * $row['quanity'];

    }
    return number_format($total);
  }

  public function save(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("INSERT INTO order_detail (id_order, id_product, quanity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $this->id_order, $this->id_product, $this->quanity);
    $rs = $stmt->execute();
    $stmt->close();
    return $rs;
  }

  public function findById($id_order){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from order_detail where id_order='.$id_order;
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
        $order_detail = new OrderDetail_Model();
        $order_detail->id_order = $row['id_order'];
        $order_detail->id_product = $row['id_product'];
        $order_detail->quanity = $row['quanity'];
        return $order_detail;
  }

  public function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'delete from order_detail where id_order='.$this->id_order;
    $result = mysqli_query($conn, $sql);
    return $result;
  }
  public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE order_detail SET id_product = ?, quanity = ? WHERE id_order = ? ");
    $stmt->bind_param("iii", $this->id_order, $this->quanity, $this->id_product);
    $stmt->execute();
    $stmt->close();
  }

  public function group_with_id($id_order){
    $conn = FT_Database::instance()->getConnection();
    $sql = 'select * from order_detail where id_order = ' . $id_order;
    $result = mysqli_query($conn, $sql);
    $list_order_detail = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_array($result)){
      $order_detail = new OrderDetail_Model();
      $order_detail->id_order = $row['id_order'];
      $order_detail->id_product = $row['id_product'];
      $order_detail->quanity = $row['quanity'];
      $list_order_detail[] = $order_detail;
    }
    return $list_order_detail;
  }
}
