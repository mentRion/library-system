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
$filename ='AttendanceRecord-'.date('Y-m-d').'.csv';

$query ="SELECT * FROM studattendance";
$result = mysqli_query($conn,$query);

$array =array();

$file = fopen($filename,"w");
$array =array("STUDENT ID","TIME IN","TIME OUT","LOG DATE","STATUS");
fputcsv($file,$array);

while($row = mysqli_fetch_array($result)){
   $STUDENTID =$row['STUDENTID'];
   $TIMEIN =$row['TIMEIN'];
   $TIMEOUT=$row['TIMEOUT'];
   $LOGDATE =$row['LOGDATE'];
   $STATUS =$row['STATUS'];

   $array = array($STUDENTID,$TIMEIN,$TIMEOUT,$LOGDATE,$STATUS);
   fputcsv($file,$array);


}
fclose($file);

header("Content-Description: File Transfer");
header("Content-Disposition: Attachment; filename=$filename");
header("Content-type: application/csv;");
readfile($filename);
unlink($filename);
exit();


 ?>
