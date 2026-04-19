<h2>Авторизация</h2>
<h3><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>

<?php if (!app()->auth::check()): ?>
<form method="post">
    <input name="login" placeholder="Логин">
    <input type="password" name="password" placeholder="Пароль">
    <button>Войти</button>
</form>
<?php endif; ?>