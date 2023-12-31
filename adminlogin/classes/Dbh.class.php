<?php
session_start();

class Dbh {

  private $host = DB_HOST;
  private $port = DB_HOST_PORT;
  private $user = DB_USER;
  private $pwd = DB_PASSWORD;
  private $dbName = DB_NAME;
  protected $dbPrefix = DB_PREFIX;

  public function __construct() {
    /*$this->id_admin = $_SESSION['admin_logged'];
    $this->admin_name = $_SESSION['admin_name'];
    $this->admin_role = $_SESSION['admin_role'];*/
    require_once __DIR__."/../class-autoloader-admin.php";

    //print_r(get_defined_functions());
  }

  protected function connect() {
    try {
      $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbName;
      $pdo = new PDO($dsn, $this->user, $this->pwd);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $pdo;
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  /*protected function encrypt($text){
    $iv = 3003202020151234;
    $ciphering = "BF-CBC";
    $key = "PČOZ_SSOŠ_ANIMUS_2022";
    $options = 0;
    $encryption = openssl_encrypt($text, $ciphering, $key, $options, $iv);
    return $encryption;
  }

  protected function decrypt($text){
    $iv = 3003202020151234;
    $ciphering = "BF-CBC";
    $key = "PČOZ_SSOŠ_ANIMUS_2022";
    $options = 0;
    $decryption = openssl_decrypt ($text, $ciphering, $key, $options, $iv);
    return $decryption;
  }*/
}
?>
