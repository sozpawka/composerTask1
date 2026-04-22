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
            align-items: center;
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

        .user-avatar {
            display: flex;
            align-items: center;
        }

        .user-avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .modal {
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0; 
            top: 0; 
            width: 100%; 
            height: 100%; 
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 30px;
            border-radius: 12px;
            width: 350px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .modal-content h3 {
            margin: 0 0 20px 0;
            font-size: 24px;
        }

        .modal-form-btn {
            margin-top: 20px;
            padding: 12px 24px;
            background: #1688D3;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .modal-form-btn.cancel {
            background: #aaa;
            margin-left: 10px;
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
        .error-msg {
            color: #e53935;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .hint-text {
            font-size: 14px;
            color: #666;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<header>
    <div class="logo" onclick="location.href='/pop-it-mvc/'">Поликлиника</div>
    <div class="nav">
        <?php if (app()->auth::check()): ?>
            <div class="user-avatar" onclick="document.getElementById('photoModal').style.display='block'">
                <img src="/pop-it-mvc/public/uploads/<?= app()->auth::user()->avatar ?? 'baseicon.jpg' ?>" alt="Avatar">
            </div>
            <a href="/pop-it-mvc/visits">Записи</a>
            <a href="/pop-it-mvc/doctors">Врачи</a>
            <a href="/pop-it-mvc/patients">Пациенты</a>
            <a href="/pop-it-mvc/logout" class="logout">Выход (<?= app()->auth::user()->login ?>)</a>
        <?php else: ?>
            <a href="/pop-it-mvc/login">Войти</a>
            <a href="/pop-it-mvc/signup">Регистрация</a>
        <?php endif; ?>
    </div>
</header>

<div id="photoModal" class="modal">
    <div class="modal-content">
        <h3>Добавление фотографии</h3>
        
        <?php if ($error = \Src\Session::get('photo_error')): ?>
            <p class="error-msg"><?= $error ?></p>
            <?php \Src\Session::set('photo_error', null); ?>
            <script>document.getElementById('photoModal').style.display = 'block';</script>
        <?php endif; ?>

        <form action="<?= app()->route->getUrl('/upload-photo') ?>" method="post" enctype="multipart/form-data">
            <input name="csrf_token" type="hidden" value="<?= \Src\Session::get('csrf_token') ?>"/>      
            <input type="file" name="avatar" accept="image/*" required>
            <p class="hint-text">Максимальный размер: 2МБ (jpg, png)</p>
            <div class="modal-footer">
                <button type="submit" class="modal-form-btn">Загрузить</button>
                <button type="button" class="modal-form-btn cancel" onclick="document.getElementById('photoModal').style.display='none'">Отмена</button>
            </div>
        </form>
    </div>
</div>

<script>
    window.onclick = function(event) {
        var modal = document.getElementById('photoModal');
        if (event.target == modal) { modal.style.display = "none"; }
    }
</script>

<?= $content ?? ''; ?>

</body>
</html>