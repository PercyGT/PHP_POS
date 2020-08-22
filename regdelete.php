<?php
include_once '_include/connect.php';

$id = $_POST['userid'];


$sql = "delete from tbl_user where userid = $id";
$delete = $pdo->prepare($sql);
$delete->execute();
