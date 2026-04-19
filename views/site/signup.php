<h2>Регистрация</h2>
<h3><?= $message ?? '' ?></h3>
<form method="post">
    <input name="name" placeholder="Имя"><br>
    <input name="login" placeholder="Логин"><br>
    <input type="password" name="password" placeholder="Пароль"><br>
    <button>Зарегистрироваться</button>
</form>