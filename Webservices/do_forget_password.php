<!DOCTYPE html>
<?php
include './dbconn.php';
$email = $_POST["email"];
$username = $_POST["username"];
$query = "select * from `user` where `email` = '$email' and `username` = '$username'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+{}|:<>?-=[]\;';
    $string = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < 20; $i++) {
        $string .= $characters[mt_rand(8, $max)];
    }
    $query2 = "UPDATE `user` SET `password` = sha1('$string') WHERE `username` = '$username' AND `email` = '$email'";
    $result = mysqli_query($link, $query2) or die(mysqli_error($link));
//    Email init
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: Your name <noreply@lucxury.com>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $subject = "Lucxury - Password reset";
    $msgForWebsite = "Password has been reset. Please check your email and spam/junk folder.";

    $msgForEmail = "<div>Dear $username,</div><br/>"
            . "<div>Your password has been reset. Please login <a href='https://www.lucxury.com/Website2/login.php'>here</a> with your login name & the new password:</div><br/>"
            . "<div>$string</div><br/><div>You can change the password on the 'Edit Profile' page afterwards.<br/><div>Best Regards,</div><br/><div>LUCXURY</div><br/>";

    mail("$email", "LUCXURY - Forget password", $msgForEmail, $headers);
} else {
    $msgForWebsite = "Sorry, invalid credentials";
} 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="1;url=../login.php" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title></title>
        <script>
            alert("Password has been reset. Please check your email & spam/junk folder.");
        </script>
    </head>
    <body>
    </body>
</html>
