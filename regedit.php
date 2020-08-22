<?php

include_once 'connect.php';

$id = ($_POST['userid']);

$sql = "select * from tbl_user where userid = '$id'";
$select = $pdo->prepare($sql);
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
echo json_encode($row);
