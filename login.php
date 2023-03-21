<?php
require_once 'includes/db.php';

session_start();

if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $user = R::findOne('users', 'login = ?', [$login]);

    if ($user && password_verify($password, $user->password)) {
        $_SESSION['user_id'] = $user->id;
        header('Location: account.php');
        exit;
    } else {
        $error = 'Неверный логин или пароль';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
</head>
<body>
    <h1>Авторизация</h1>
    <?php if (isset($error)) { echo '<p>' . $error . '</p>'; } ?>
    <form method="post">
        <label>Логин:</label>
        <input type="text" name="login"><br>
        <label>Пароль:</label>
        <input type="password" name="password"><br>
        <input type="submit" value="Войти">
    </form>
    <p><a href="register.php">Регистрация</a></p>
</body>
</html>