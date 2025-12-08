<?php
include('includes/config.php');

$id = $_GET['id'] ?? 0;

if($id){
    $query = "DELETE FROM students WHERE id = $id";
    mysqli_query($cn, $query);
}

header("Location: index.php");
exit;
