<?php

class Mail extends Dbh{

// ------------View------------

  protected function getAllRecords($limit){
    $sql = "SELECT * FROM ".$this->dbPrefix."mail WHERE 1";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);
    $results = $stmt->fetchAll();
    return $results;
  }

  protected function getData($id_mail){
    $sql = "SELECT * FROM ".$this->dbPrefix."mail WHERE `id_mail` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id_mail]);
    $results = $stmt->fetchAll();
    return $results;
  }

  
// ------------Controller------------

  protected function addTemplate($subject, $filename){
    $sql = "INSERT INTO `".$this->dbPrefix."mail`(`subject`, `filename`) VALUES (?, ?)";
    $con = $this->connect();
    $stmt = $con->prepare($sql);
    $stmt->execute([$subject, $filename]);
    $id = $con->lastInsertId();
    return $id;
  }

  protected function updateTemplate($id_mail, $subject, $filename){
    $sql = "UPDATE `".$this->dbPrefix."mail` SET `subject` = ? , `filename` = ? WHERE `id_mail` = ?";
    $con = $this->connect();
    $stmt = $con->prepare($sql);
    $stmt->execute([$subject, $filename, $id_mail]);
    return 1;
  }
}
 ?>
