<?php
session_start();
require __DIR__ . '/../../../adminlogin/init.php';
$user = new UserView();
$data = $user->getData($_GET['id_user']);
$zipFile = __DIR__."/../../zip/".$data['username'].'.zip';

if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged']==0){
  $redirect = "Location: " . HOMEPAGE . "login.php";
  header($redirect);
  die();
}
  $name = $data['fullname'];
  $task = $_GET['task'];
  $type = $data['type'];
  $path = __DIR__."/../../../users_submissions/".$data['directory']."/";
  $rootPath = realpath($path);

  $zip = new ZipArchive();

  $zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

  $files = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($rootPath),
      RecursiveIteratorIterator::LEAVES_ONLY
  );
  foreach ($files as $name => $file)
  {
      // Skip directories (they would be added automatically)
      if (!$file->isDir())
      {
          // Get real and relative path for current file
          $filePath = $file->getRealPath();
          $relativePath = substr($filePath, strlen($rootPath) + 1);

          // Add current file to archive
          $zip->addFile($filePath, $relativePath);
      }
  }

  // Zip archive will be created only after closing object
  $zip->close();
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="'.basename($zipFile).'"');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($zipFile));
  readfile($zipFile);
  unlink($zipFile);
?>
