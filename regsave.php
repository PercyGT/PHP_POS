<?php
include_once '_include/connect.php';
if (isset($_POST['save'])) {
    $username = $_POST["username"];
    $useremail = $_POST["useremail"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $sql = ("insert into tbl_user(username,useremail,password,role) values(:name,:email,:pass,:role)");
    $insert = $pdo->prepare($sql);
    $insert->bindParam(':name', $user_name);
    $insert->bindParam(':email', $user_email);
    $insert->bindParam(':pass', $user_pass);
    $insert->bindParam(':role', $user_role);
    $insert->execute();
}
