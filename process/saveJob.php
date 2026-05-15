<?php include "../includes/session.php";

if (!isset($_GET['id'])) {
  header("location: ../findJobs.php");
  exit();
}

if (!isset($_SESSION['email'])) {
  $_SESSION['email'] = "Please log in to save job";
  header("location: ../login.php");
  exit();
}

$id_jobpost = (int) $_GET['id'];
$id_user = (int) $_SESSION['id_user'];
$createdat = date("Y-m-d");

// prevent duplicate saved entries
$sql_check = "SELECT * FROM saved_jobposts WHERE id_jobpost = '$id_jobpost' AND id_user = '$id_user'";
$result_check = $conn->query($sql_check);
if ($result_check->num_rows === 0) {
  $sql = "INSERT INTO saved_jobposts (id_jobpost,id_user,createdat) VALUES('$id_jobpost','$id_user','$createdat')";
  $conn->query($sql);
}

header('location: ../jobDetails.php?key=' . md5($id_jobpost) . '&id=' . $id_jobpost);
exit();
