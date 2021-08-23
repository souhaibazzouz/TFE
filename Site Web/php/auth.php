<?php
session_start();
include 'db_conn.php';
include 'database.php';

if (isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)){
        header("Location: login.php?error=Email is required");
    } else if (empty($password)) {
        header("Location: login.php?error=Password is required&email=$email");
    }else{
        $conn = OpenCon();
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email=?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() === 1){
            $user = $stmt->fetch();
            $user_id = $user['idAdmin'];
            $user_email = $user['email'];
            $user_password = $user['password'];
            $user_full_name = $user['full_name'];

            if ($email === $user_email){
                if (password_verify($password, $user_password)){
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['user_full_name'] = $user_full_name;

                    header("Location: admin.php");

                }else{
                    header("Location: login.php?error=Incorrect Email or Password&email=$email");
                }
            }else{
                header("Location: login.php?error=Incorrect Email or Password&email=$email");
            }
        }else{
            header("Location: login.php?error=Incorrect Email or Password&email=$email");
        }
    }
}

