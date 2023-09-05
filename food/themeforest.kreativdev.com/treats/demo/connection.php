<?php
error_reporting(0);
$servername="localhost";
$username="root";
$password="";
$dbname="registration";
$check=mysqli_connect($servername,$username,$password,$dbname);
if($check){
    echo "Connection successful!";

}
else{
    echo "Connection Fail";
}
$full_name=$_POST['full_name'];
$Email=$_POST['Email'];
$select_person=$_POST['select_person'];
$select_phone_number=$_POST['select_phone_number'];
$select_date=$_POST['select_date'];
$select_time=$_POST['select_time'];
$write_message=$_POST['write_message'];
$send="INSERT INTO registration_page VALUES('','$full_name','$Email','$select_person','$select_phone_number','$select_date','$select_time','$write_message')";
$data=mysqli_query($check,$send);

if($data){
    echo "data stored";
}

else{
    echo "data not stored";
}


?>