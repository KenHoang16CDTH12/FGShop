
<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');
class FT_Database{

  private $conn;
  //create the private instance variable
  private static $myInstance=null;
  public static function instance(){
    if(self::$myInstance == null){
            self::$myInstance = new FT_Database();
        }
        return self::$myInstance;
  }
  private function __construct(){
    $this->db_connect();
  }
  public function db_connect(){
    $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    mysqli_set_charset($this->conn, 'utf8');
    if(!$this->conn){
      die('Fail connect to database'.mysqli_connect_error());
    }
  }
  public function getConnection(){
    return $this->conn;
  }
  public function db_close(){
    mysqli_close($this->conn);
  }
}
