<?php
session_start();
$confirm_message = isset($_SESSION["confirm_message"]) ? $_SESSION["confirm_message"] : "";
unset($_SESSION["confirm_message"]);
$incorrect_message = isset($_SESSION["incorrect_message"]) ? $_SESSION["incorrect_message"] : "";
unset($_SESSION["incorrect_message"]);

?>
<?php if(!empty($confirm_message)||!empty($incorrect_message)): ?>
<div id="confirm">
    <p><?= $confirm_message ?></p>
    <p><?= $incorrect_message ?></p>
</div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Login and Registration</title>
</head>
<body>
    <div id="forms">
        <h1>Login</h1>
        <form action="login-submit.php" method="post" class="form-inline">
            <label for="uname">Username:</label>
            <input type="text" placeholder="username" name="uname">
            <br>
            <label for="password">Password:</label>
            <input type="password" placeholder="password" name="password">
            <button type="submit">Submit</button>
        </form>
        <hr>
        <h1>No Account? Register here!</h1>
        <form action="registration-submit.php" method="post" class="form-inline">
            <label for="uname">Username:</label>
            <input type="text" placeholder="username" name="uname">
            <br>
            <label for="password">Password:</label>
            <input type="password" placeholder="password" name="password">
            <label for="retry">Retype Password:</label>
            <input type="password" placeholder="retype password" name="retry">
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>