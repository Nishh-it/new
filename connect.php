<?php

$con = new mysqli('localhost','root','','erhub');

if($con){
    
    die(mysqli_error($con));
}
