<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='';
$DATABASE='diplom_schema';

$con=mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if(!$con){
    die(mysqli_error($con));
}

?>