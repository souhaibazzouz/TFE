<?php
    try{
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "sou_sou_azzouz@hotmail.com";
        $to = "answer@2par.be";
        $user_name = $_POST['name'];
        $user_mail = $_POST['email'];
        $user_message = $_POST['message'];
        $subject = "Nouvelle réponse au formulaire";
        $message = "Vous avez reçu une réponse de: ".$user_name."\r\n".
        "Email: ".$user_mail."\r\n\n"
        ."Message:\r\n ".$user_message;
        $headers = "De : ". $from;
        mail($to,$subject,$message, $headers);
        echo "<h2>L'email a été envoyé.</h2>";
        header("refresh:2;url=../index.php?mailsend");
    } catch(Exception $e){
        echo "<h2>L'email a été envoyé.</h2>";
        header("refresh:2;url=../index.php?mailunsend");
        print_r($e);
    }
?>