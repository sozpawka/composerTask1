<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Поликлиника</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 60px;
            background: #fff;
            border-bottom: 2px solid #ddd;
        }

        .logo,
        .nav a {
            cursor: pointer;
            color: #000;
            text-decoration: none;
            transition: 0.2s;
        }

        .logo {
            font-size: 27px;
            font-weight: bold;
        }

        .nav {
            display: flex;
            gap: 45px;
            font-size: 21px;
        }

        .logo:hover,
        .nav a:hover {
            color: #0f6fb2;
        }

        .logo:active,
        .nav a:active {
            color: #084d7a;
        }

        .logout {
            color: #e53935 !important;
        }

        .logout:hover {
            color: #b71c1c;
        }

        .logout:active {
            color: #ff6b6b;
        }

        .container {
            width: 90%;
            margin: 60px auto;
            background: #e9e9e9;
            padding: 60px;
            border-radius: 12px;
        }

        .title {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h2 {
            font-size: 36px;
            margin: 0;
        }

        .role {
            font-size: 21px;
            color: gray;
        }

        .divider {
            margin: 30px 0;
            border-top: 2px solid #ccc;
        }

        .section-title {
            text-align: center;
            font-size: 27px;
            color: gray;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 45px;
        }

        .btn {
            padding: 24px;
            font-size: 21px;
            text-align: center;
            background: #1688D3;
            color: #fff;
            border-radius: 9px;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn:hover {
            background: #0f6fb2;
        }

        .btn:active {
            background: #084d7a;
        }

        .full {
            grid-column: span 2;
        }
    </style>
</head>
<body>
<header>
    <div class="logo" onclick="location.href='/pop-it-mvc/'">
        Поликлиника
    </div>
    <div class="nav">
        <?php if (app()->auth::check()): ?>
            <a href="/pop-it-mvc/visits">Записи</a>
            <a href="/pop-it-mvc/doctors">Врачи</a>
            <a href="/pop-it-mvc/patients">Пациенты</a>
            <a href="/pop-it-mvc/logout" class="logout">
                Выход (<?= app()->auth::user()->login ?>)
            </a>
        <?php else: ?>
            <a href="/pop-it-mvc/login">Войти</a>
            <a href="/pop-it-mvc/signup">Регистрация</a>
        <?php endif; ?>
    </div>
</header>
    <?= $content ?? ''; ?>
</body>
</html>