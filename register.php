<?php
require_once 'includes/db.php';

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];

    $existing_user = R::findOne('users', 'email = ? OR login = ?', [$email, $login]);

    if ($existing_user) {
        $error = 'Пользователь с таким логином (паролем) уже зарегистрирован';
    } else {
        $user = R::dispense('users');
        $user->email = $email;
        $user->login = $login;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->full_name = $full_name;

        $id = R::store($user);

        $_SESSION['user_id'] = $id;
        header('Location: account.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация</h1>
    <?php if (isset($error)) { echo '<p>' . $error . '</p>'; } ?>
    <form method="post">
        <label>Email:</label>
        <input type="email" name="email"><br>
        <label>Логин:</label>
        <input type="text" name="login"><br>
        <label>Пароль:</label>
        <input type="password" name="password"><br>
        <label>ФИО:</label>
        <input type="text" name="full_name"><br>
        <input type="submit" value="Register" name="register">
    </form>
    <p><a href="register.php">Регистрация</a></p>
</body>
</html>