<?php
session_start();

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';

$error = false;

if ( isset($_POST['who']) && isset($_POST['pass']) ) {

    if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) {
        $error = "User name and password are required";
    } else {
        $check = hash('md5', $salt.$_POST['pass']);

        if ( $check == $stored_hash ) {
            $_SESSION['name'] = $_POST['who'];
            header("Location: game.php");
            return;
        } else {
            $error = "Incorrect password";
        }
    }
}
?>

<html>
<head>
<title>Login</title>
</head>
<body>

<h1>Please Log In</h1>

<?php
if ( $error !== false ) {
    echo('<p style="color:red;">'.htmlentities($error)."</p>\n");
}
?>

<form method="post">
Name: <input type="text" name="who"><br>
Password: <input type="password" name="pass"><br>
<input type="submit" value="Log In">
</form>

</body>
</html>