<?php
class User extends Dbh {
  // ------------View------------
    protected function userLogIn($username) {
      $sql = "SELECT id_user, pass, active FROM  ".$this->dbPrefix."users WHERE username = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$username]);
      $results = $stmt->fetchAll();
      $res = array();
      foreach ($results as $row) {
        foreach ($row as $key=>$value){
          $res[$key] = $value;
        }
      }
      return $res;
    }

    protected function getDataById($id) {
      $sql = "SELECT fullname, email, type, directory FROM  ".$this->dbPrefix."users WHERE id_user = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$id]);
      $results = $stmt->fetchAll();
      $res = array();
      foreach ($results as $row) {
        foreach ($row as $key=>$value){
          $res[$key] = $value;
        }
      }
      return $res;
    }

    protected function getAllUsers(){
      $sql = "SELECT id_user, fullname, type, directory FROM  ".$this->dbPrefix."users WHERE 1";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      $results = $stmt->fetchAll();
      $res = array();
      foreach ($results as $row) {
        $res[$row['id_user']] = array("fullname" => $row['fullname'], "type" => $row['type'], "directory" => $row['directory']);
      }
      return $res;
    }

    protected function getSubmissionByTask($id_user, $task){
      $sql = "SELECT filename FROM `".$this->dbPrefix."users_submission` WHERE `id_user` = ? AND `task` = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$id_user, $task]);
      $results = $stmt->fetchAll();
      return $results;
    }

  // ------------Controller------------
    protected function uploadSubmissionFiles($id_user, $filename, $task){
      $sql = "INSERT INTO `".$this->dbPrefix."users_submission`(`id_user`, `filename`, `task`) VALUES (?, ?, ?)";
      $con = $this->connect();
      $stmt = $con->prepare($sql);
      $stmt->execute([$id_user, $filename, $task]);
    }

    protected function changePassword($id_user, $hash){
      $sql = "UPDATE `".$this->dbPrefix."users` SET `pass` = ? WHERE `id_user` = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$hash, $id_user]);
    }
}
?>
