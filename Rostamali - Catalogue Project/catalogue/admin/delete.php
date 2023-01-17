<?php

include("../includes/mysql_connect.php");

$id = $_GET['id'];

$sql = "DELETE FROM top_100_universities where university_id = '$id' ";

$result = mysqli_query($con, $sql) or die (mysqli_error($con));

header("Location: edit.php");

?>

