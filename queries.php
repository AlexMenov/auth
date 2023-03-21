<?php

// запрос, который выведет список email'лов встречающихся более чем у одного пользователя

$emails = R::getAll("
    SELECT email
    FROM users
    WHERE id IN (
        SELECT user_id
        FROM orders
        GROUP BY user_id
        HAVING COUNT(DISTINCT user_id) > 1
    )
");

foreach ($emails as $email) {
    echo $email['email'] . '<br>';
}


// список логинов пользователей, которые не сделали ни одного заказа

$users = R::find('users', 'NOT EXISTS (SELECT * FROM orders WHERE user_id = users.id)');

foreach ($users as $user) {
    echo $user->login . '<br>';
}


// список логинов пользователей, которые сделали более двух заказов

$users = R::getAll("
    SELECT u.login
    FROM users u
    INNER JOIN orders o ON u.id = o.user_id
    GROUP BY u.id
    HAVING COUNT(o.id) > 2
");

foreach ($users as $user) {
    echo $user['login'] . '<br>';
}


?>

