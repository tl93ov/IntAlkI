<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();

//var_dump($_POST);

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == 'aaa' && $password == 'aaa') {
        $_SESSION['user'] = $username;
        header("Location: content.php");
        exit();
    } else {
        $error = "Hibás felhasználónév vagy jelszó!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
<h2>Belépés</h2>
<?php if(isset($error) && !empty($error)): ?>
    <p style='color:red;'><?php echo $error; ?></p>
<?php endif; ?>
<form method="post" action="">
    Felhasználó: <input type="text" name="username" required><br>
    Jelszó: <input type="password" name="password" required><br>
    <input type="submit" name="login" value="Belépés">
</form>
</body>
</html>
