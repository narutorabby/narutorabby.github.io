<?php

    use PHPMailer\PHPMailer\PHPMailer;

    // check if fields passed are empty
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "No arguments Provided!";
        return false;
    }

    $name = $_POST['name'];
    $email_address = $_POST['email'];
    $message = $_POST['message'];

    try {
        require_once "./PHPMailer/PHPMailer.php";
        require_once "./PHPMailer/SMTP.php";
        require_once "./PHPMailer/Exception.php";

        $mail = new PHPMailer();

        // Settings
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';

        $mail->Host       = "mail.mhrabby.xyz";
        $mail->SMTPAuth   = true;
        $mail->Username   = "contact@mhrabby.xyz";
        $mail->Password   = "vm=i!u-BeiUw";
        $mail->SMTPSecure = "ssl";
        $mail->Port       = 465;
        
        // Content
        $mail->isHTML(true);
        $mail->setFrom($email_address, $name);
        $mail->addAddress("contact@mhrabby.xyz");
        $mail->Subject = "Contact form submitted by:  $name";
        $mail->Body = $message;

        if($mail->send()){
            return true;
        }
        else{
            return false;
        }
    } catch (\Throwable $th) {
        return false;
    }
