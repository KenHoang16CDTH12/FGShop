<?php
/**
*
*/
class Rating_Model
{

  public $id;
  public $id_product;
  public $id_user;
  public $content;
  public $stars;
  public $time_rate;

  function __construct()
  {
    # code...
  }

  function rate($id_product) {
    $conn = FT_Database::instance()->getConnection();
    $sql = "SELECT SUM(stars) as num_rates, COUNT(stars) as num_people FROM rating WHERE id_product = $id_product";
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
    $num_rates = $row['num_rates'];
    $num_people = $row['num_people'];
    if ($num_rates == 0 || $num_people == 0)
      return 0;
    else
      return round($num_rates / $num_people);
  }

  function num_people_rates($id_product) {
    $conn = FT_Database::instance()->getConnection();
    $sql = "SELECT COUNT(stars) as num_people FROM rating WHERE id_product = $id_product";
    $result = mysqli_query($conn, $sql);
    if(!$result)
      die('Error: ');
    $row = mysqli_fetch_assoc($result);
    $num_people = $row['num_people'];

    return $num_people;
  }

  function group_products($id_product, $limit) {
    $default_load = 20;

    $conn = FT_Database::instance()->getConnection();
    $sql = "SELECT * FROM rating WHERE id_product = $id_product ORDER BY time_rate DESC LIMIT $limit, $default_load";

    $result = mysqli_query($conn, $sql);
    $list = [];

    if(!$result)
         die('Error: '.mysqli_query_error());

    while ($row = mysqli_fetch_assoc($result)){
      $rating = new Rating_Model();
      $rating->id = $row['id'];
      $rating->id_product = $row['id_product'];
      $rating->id_user = $row['id_user'];
      $rating->content = $row['content'];
      $rating->stars = $row['stars'];
      $rating->time_rate = $row['time_rate'];
      $list[] = $rating;
    }
    return $list;
  }

  function save(){
    $conn = FT_Database::instance()->getConnection();
    if ($this->check_rating_exists($this->id_product, $this->id_user) == 0) {
      $stmt = $conn->prepare("INSERT INTO rating (id_product, id_user, content, stars, time_rate) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("iisis", $this->id_product, $this->id_user, $this->content, $this->stars, $this->time_rate);
      $rs = $stmt->execute();
      $this->id = $stmt->insert_id;
      $stmt->close();
      return $this->id;
    } else {
      $this->update();
    }
  }

   public function update(){
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("UPDATE rating SET content = ?, stars = ?, time_rate = ? WHERE id_product = ? AND id_user = ?");
    $stmt->bind_param("sisii",  $this->content, $this->stars, $this->time_rate, $this->id_product, $this->id_user);
    $stmt->execute();
    $stmt->close();
  }


  function check_rating_exists($id_product, $id_user) {
    $conn = FT_Database::instance()->getConnection();
    $stmt = $conn->prepare("SELECT id FROM rating WHERE id_product = ? AND id_user = ?");

    $stmt->bind_param("ii", $id_product, $id_user);

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
}
