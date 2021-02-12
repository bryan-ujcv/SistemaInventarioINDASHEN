<?php
//$con=new mysqli('localhost','root','','indashen')
$con = mysqli_connect('localhost','root','','indashen');

if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>