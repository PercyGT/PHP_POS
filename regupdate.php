<?php
$user_name = $_POST['username'];
$user_email = $_POST['useremail'];
$user_pass = $_POST['password'];
$user_role = $_POST['role'];
$user_id = $_POST['userid'];

$sql = ("update tbl_user set username=:name, useremail=:email, password=:pass, role=:role where userid='$user_id'");
$update = $pdo->prepare($sql);
$update->bindParam(':name', $user_name);
$update->bindParam(':email', $user_email);
$update->bindParam(':pass', $user_pass);
$update->bindParam(':role', $user_role);
$update->execute();
