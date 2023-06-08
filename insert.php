<?php

session_start(); //to dispaly message
$server ="localhost";
$username ="root";
$password ="";
$dbname ="dbs";

$conn = new mysqli($server,$username,$password,$dbname);

 if($conn->connect_error){
   die("Connection failed" .$conn ->connect_error);
 }
 if(isset($_POST['text'])){
   $voice = new com("SAPI.SpVoice");
   $text =$_POST['text'];
   $date =date('Y-m-d');
   $time =date('H:i:s');

   $sql = "SELECT * FROM studattendance WHERE STUDENTID='$text' AND LOGDATE='$date' AND STATUS='0'"; //0 means wala silang time out pero may in
   $query=$conn->query($sql);
   if($query->num_rows>0){
     $sql ="UPDATE studattendance SET TIMEOUT=NOW(), STATUS='1' WHERE STUDENTID='$text' AND LOGDATE='$date'";//time in and out
      $query=$conn->query($sql);
       $_SESSION['success'] ='Successfully time out';

     }else{
         $message="Hi" .$text. "Your attendance has been successfully added!. Thank you";
         $sql ="INSERT INTO studattendance(STUDENTID,TIMEIN,LOGDATE,STATUS) VALUES('$text','$time','$date','0')";
         if ($conn->query($sql) ===TRUE){
           $_SESSION['success'] ='Attendance Successfully Time In'; //show successful
           $voice->speak($message);

         }else{
           $_SESSION ['error'] = $conn->error;
         }
       }
   }else{
      $_SESSION ['error'] = 'Please scan your QR Code';
   }

   // header("location:admin/dashboard.php");
   header("location:admin.php");


 $conn->close();

 ?>
