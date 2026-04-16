<h1>Главная страница</h1>

<?php if (!isset($_SESSION['user'])): ?>
    <a href="/pop-it-mvc/login">Войти</a>
<?php else: ?>

    <p>Вы вошли как: <?= $_SESSION['user']['login'] ?></p>

    <a href="/pop-it-mvc/logout">Выйти</a>

    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <br><br>
        <a href="/pop-it-mvc/admin">Админ панель</a>
    <?php endif; ?>

<?php endif; ?>