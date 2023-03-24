<?php

$con = mysqli_connect("localhost","root","","mydb");

if(!$con)
{
    die('Connection Failed'. mysqli_connect_error());
}

?>