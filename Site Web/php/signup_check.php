<?php
session_start();
include 'db_conn.php';
include 'database.php';

if (isset($_POST['username']) && isset($_POST['full_name']) && isset($_POST['email'])
    && isset($_POST['password']) && isset($_POST['confirm'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['confirm'];
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];

    $user_data = 'username='. $username.'&full_name='. $full_name.'&email='. $email;

    if (empty($full_name)){
        header("Location: signup.php?error=Full Name is required&$user_data");
    } else if (empty($username)) {
        header("Location: signup.php?error=Username is required&$user_data");
    }else if (empty($email)) {
        header("Location: signup.php?error=Email is required&$user_data");
    }else if (empty($password)) {
        header("Location: signup.php?error=Password is required&$user_data");
    }else if (empty($re_password)) {
        header("Location: signup.php?error=Confirm your Password please&$user_data");
    }else if ($password !== $re_password) {
        header("Location: signup.php?error=The confirmation password does not match&$user_data");
    }else{
        $password = password_hash($password, PASSWORD_BCRYPT);

        $conn = OpenCon();
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email=?");
        $stmt->execute([$email]);
        $stmt1 = $conn->prepare("SELECT * FROM admin WHERE username=?");
        $stmt1->execute([$username]);

        if ($stmt->rowCount() > 0){
            header("Location: signup.php?error=The email is taken try another please&$user_data");
        }else if($stmt1->rowCount() > 0){
            header("Location: signup.php?error=The username is taken try another please&$user_data");
        } else{
            try{
                $sql2 = "INSERT INTO admin (full_name, username, email, password) VALUES ('$full_name', '$username', '$email', '$password')";
                $conn->exec($sql2);
                header("Location: signup.php?success=Your account has been created successfully");
            }catch(PDOException $e) {
                header("Location: signup.php?error=Unknown error occurred&$user_data");
            }
        }
    }
}

