<?php
session_start();

/** @var mysqli $db */
require_once 'includes/database.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

/* als de ingevoerde velden zijn verstuurd */
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($db, $_POST["name"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $subject = mysqli_real_escape_string($db, $_POST["subject"]);
    $message = mysqli_real_escape_string($db, $_POST["message"]);

    /* kijken of de ingevoerde informatie correct is */
    $errors = [];

    if (empty($name)) {
        $errors['name'] = "Voer je naam in";
    } elseif (strlen($name) > 50) {
        $errors['name'] = "Je naam is te lang!";
    }

    if (empty($email)) {
        $errors['email'] = "Voer je email in";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Voer een geldig emailadres in";
    } elseif (strlen($email) > 100) {
        $errors['email'] = "Je email is te lang!";
    }

    if (empty($subject)) {
        $errors['subject'] = "Voer je onderwerp in";
    } elseif (strlen($subject) > 100) {
        $errors['subject'] = "Je onderwerp is te lang!";
    }

    if (empty($message)) {
        $errors['message'] = "Voer je bericht in";
    } elseif (strlen($message) > 500) {
        $errors['message'] = "Je bericht is te lang!";
    }

    /* als de ingevoerde informatie correct is */
    if (empty($errors)) {
        $stmt = $db->prepare("INSERT INTO fq (name, email, subject, text) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        $stmt->execute();

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'htmlcsscmgt@gmail.com';
        $mail->Password = 'vnukwngxckxqhsec';
        $mail->Password = 'vnukwngxckxqhsec';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('htmlcsscmgt@gmail.com');
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body = $_POST['message'];
        $mail->send();

        $name = $email = $subject = $message = "";

    }
}

mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/f&q.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/main.js"></script>
    <title>Document</title>
</head>
<body>
<div id="header"></div>
<form action="" method="post">
    <h1>Contact</h1>
<div class="formParent">
    <div class="formChild">
    <label class="label" for="name">Naam</label>
    <input class="input" id="name" type="text" name="name" placeholder="<?= $errors['name'] ?? '' ?>" required>
    </div>
</div>
    <div class="formParent">
        <div class="formChild">
            <label class="label" for="mail">Mail</label>
            <input class="input" id="email" type="text" name="email" placeholder="<?= $errors['email'] ?? '' ?>" required>
        </div>
    </div>
    <div class="formParent">
        <div class="formChild">
            <label class="label" for="subject">Onderwerp</label>
            <input class="input" id="subject" type="text" name="subject" placeholder="<?= $errors['subject'] ?? '' ?>" required>
        </div>
    </div>
    <div class="formParent">
        <div class="formChild">
            <label class="label" for="message">Bericht</label>
            <textarea class="input" id="message" type="text" name="message" placeholder="<?= $errors['message'] ?? '' ?>" required></textarea>
        </div>
    </div>
    <div class="formChild">
        <button type="submit" id="submit" name="submit">Submit</button>
    </div>
</form>
<div id="footer"></div>
</body>
</html>
