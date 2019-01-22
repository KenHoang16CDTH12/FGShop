<?php
/**
*
*/
class Favorite_Model
{

  public $id_product;
  public $id_user;

  function __construct()
  {
    # code...
  }

  function num_likes($id_product) {
    $conn = FT_Database::instance()->getConnection();
    $sql = "SELECT COUNT($id_product) as num_likes FROM favorite WHERE id_product = $id_product";
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
    $num_likes = $row['num_likes'];

    return $num_likes;
  }


  function check_favorite_exists($id_product, $id_user) {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT * FROM favorite WHERE id_product = ? AND id_user = ?");

    $stmt->bind_param("ii", $id_product, $id_user);

    $stmt->execute();
    $stmt->store_result();
    /*Fetch the value*/
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        return $stmt->num_rows;
     } else {
        return 0;
     }
  }

  function save(){
    $conn = FT_Database::instance()->getConnection();
    if ($this->check_favorite_exists($this->id_product, $this->id_user) == 0) {
      $stmt = $conn->prepare("INSERT INTO favorite (id_product, id_user) VALUES (?, ?)");
      $stmt->bind_param("ii", $this->id_product, $this->id_user);
      $rs = $stmt->execute();
      $stmt->close();
      return true;
    } else {
      $this->delete();
      return false;
    }
  }

  function delete(){
    $conn = FT_Database::instance()->getConnection();
    $sql = "DELETE FROM favorite WHERE id_product = $this->id_product AND id_user = $this->id_user";
    $result = mysqli_query($conn, $sql);
    return $result;
  }

}
