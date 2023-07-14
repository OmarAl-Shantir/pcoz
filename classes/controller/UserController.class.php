<?php
class UserController extends User{
  public function uploadSubmission($id_user, $filename, $task){
    $this->uploadSubmissionFiles($id_user, $filename, $task);
  }
}
?>