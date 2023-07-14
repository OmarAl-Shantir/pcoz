<?php
class User extends Dbh {
  // ------------View------------
    protected function userLogIn($username, $pass) {
      $sql = "SELECT id_user, pass FROM  ".$this->dbPrefix."users WHERE username = ?";
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
      $sql = "SELECT username, fullname, email, type, directory FROM  ".$this->dbPrefix."users WHERE id_user = ?";
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
      $sql = "SELECT id_user, fullname, type, directory, hodnotenie FROM  ".$this->dbPrefix."users WHERE 1";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      $results = $stmt->fetchAll();
      $res = array();
      foreach ($results as $row) {
        $res[$row['id_user']] = array("fullname" => $row['fullname'], "type" => $row['type'], "directory" => $row['directory'], "hodnotenie" => $row['hodnotenie']);
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

    protected function getUserHodnotenie($id_user, $id_task, $id_admin, $check = false){
      if ($check){
        $sql = "SELECT COUNT(*) FROM ".$this->dbPrefix."hodnotenie WHERE id_user = ? AND task = ? AND id_admin = ?";
      } else {
        $sql = "SELECT * FROM ".$this->dbPrefix."hodnotenie WHERE id_user = ? AND task = ? AND id_admin = ?";
      }
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$id_user, $id_task, $id_admin]);
      $results = $stmt->fetchAll();
      if ($check){
        $res = $results[0]['COUNT(*)'];
      } else {
        $res = $results[0]['value'];
      }
      return $res;
    }

    protected function getHodnotenie($id_user, $id_admin){
      $sql = "SELECT SUM(value) FROM  ".$this->dbPrefix."hodnotenie WHERE id_admin = ? AND id_user = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$id_admin, $id_user]);
      $results = $stmt->fetchAll();
      return $results[0]['SUM(value)'];
    }

  // ------------Controller------------
    protected function uploadSubmissionFiles($id_user, $filename, $task){
      $sql = "INSERT INTO `".$this->dbPrefix."users_submission`(`id_user`, `filename`, `task`) VALUES (?, ?, ?)";
      $con = $this->connect();
      $stmt = $con->prepare($sql);
      $stmt->execute([$id_user, $filename, $task]);
    }

    protected function updateUserData($id_user, $fullname, $username, $email, $directory, $active){
      $sql = "UPDATE `".$this->dbPrefix."users` SET `fullname` = ?, `username` = ?, `email` = ?, `directory` = ?,`active` = ? WHERE `id_user` = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$fullname, $username, $email, $directory, $active, $id_user]);
    }

    protected function changePassword($id_user, $hash){
      $sql = "UPDATE `".$this->dbPrefix."users` SET `pass` = ? WHERE `id_user` = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$hash, $id_user]);
    }

    protected function updateHodnotenie($id_admin, $id_user, $id_task, $value){
      $sql = "UPDATE `".$this->dbPrefix."hodnotenie` SET `value` = ? WHERE `id_user` = ? AND `task` = ? AND id_admin = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$value, $id_user, $id_task, $id_admin]);
    }

    protected function insertHodnotenie($id_admin, $id_user, $id_task, $value, ){
      $sql = "INSERT INTO `".$this->dbPrefix."hodnotenie`(`id_admin`, `id_user`, `task`, `value`) VALUES (?, ?, ?, ?)";
      $con = $this->connect();
      $stmt = $con->prepare($sql);
      $stmt->execute([$id_admin, $id_user, $id_task, $value]);
    }
}
?>
