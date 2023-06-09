<?php
session_start(); //to display message
$server = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed" . $conn->connect_error);
}
if (isset($_POST['text'])) {
  $voice = new COM("SAPI.SpVoice");
  $text = $_POST['text'];
  $date = date('Y-m-d');
  $time = date_create('now', timezone_open('Asia/Manila'))->format('Y-m-d h:i:s A');

  $sql = "SELECT * FROM studattendance WHERE STUDENTID='$text' AND LOGDATE='$date' AND STATUS='0'"; //0 means they don't have a time out but they have a time in
  $query = $conn->query($sql);
  if ($query->num_rows > 0) {
    $sql = "UPDATE studattendance SET TIMEOUT=NOW(), STATUS='1' WHERE STUDENTID='$text' AND LOGDATE='$date'"; //time in and out
    $query = $conn->query($sql);
    $_SESSION['success'] = 'Successfully timed out';
  } else {
    $message = "Hi " . $text . ", your attendance has been successfully added! Thank you";
    $sql = "INSERT INTO studattendance(STUDENTID, TIMEIN, LOGDATE, STATUS) VALUES('$text', '$time', '$date', '0')";
    if ($conn->query($sql) === TRUE) {
      $_SESSION['success'] = 'Attendance successfully timed in'; //show successful
      $voice->Speak($message);
    } else {
      $_SESSION['error'] = $conn->error;
    }
  }
} else {
  $_SESSION['error'] = 'Please scan your QR Code';
}

header("location: admin/dashboard.php");

$conn->close();
?>
