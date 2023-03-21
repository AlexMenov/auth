<?php
require_once 'includes/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user = R::load('users', $_SESSION['user_id']);

if (isset($_POST['update'])) {
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];

    $user->password = password_hash($password, PASSWORD_DEFAULT);
    $user->full_name = $full_name;

    R::store($user);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Личная страница <?php echo $user->login ?></title>
</head>
<body>
    <h1>Личная страница <?php echo $user->login ?></h1>
    <p>Добро пожаловать, <?php echo $user->full_name; ?></p>
    <p>Email: <?php echo $user->email; ?></p>
    <form method="post">
        <label>Пароль:</label>
        <input type="password" name="password"><br>
        <label>ФИО:</label>
        <input type="text" name="full_name"><br>
        <input type="submit" value="Обновить" name="update">
    </form>
    <p><a href="logout.php">Выход</a></p>
</body>
</html>