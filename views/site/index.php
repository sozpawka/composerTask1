<h1>Главная страница</h1>
<?php $user = $_SESSION['user'] ?? null; ?>
<?php if (!$user): ?>
    <p>Вы гость</p>
    <a href="/pop-it-mvc/login">Войти</a>
<?php else: ?>
    <p>Вы вошли как: <?= $user['login'] ?></p>
    <p>Роль: <?= $user['role'] ?></p>
    <a href="/pop-it-mvc/logout">Выйти</a>
    <br><br>
    <?php if ($user['role'] === 'admin'): ?>
        <h3>Админ</h3>
        <a href="/pop-it-mvc/admin">Админ панель</a>
    <?php elseif ($user['role'] === 'receptionist'): ?>
        <h3>Регистратура</h3>
        <a href="/pop-it-mvc/patients">Пациенты</a><br>
        <a href="/pop-it-mvc/patients/create">Добавить пациента</a><br>
        <a href="/pop-it-mvc/doctors">Врачи</a><br>
        <a href="/pop-it-mvc/doctors/create">Добавить врача</a><br>
        <a href="/pop-it-mvc/visits">Записать пациента к врачу</a>
    <?php endif; ?>
<?php endif; ?>