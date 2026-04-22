<style>
    .admin-container {
        max-width: 400px;
        margin: 60px auto;
        background: #d9d9d9;
        padding: 50px 40px;
        border-radius: 4px;
    }

    .admin-container h2 {
        text-align: center;
        font-size: 28px;
        margin-bottom: 20px;
    }

    .admin-form {
        display: flex;
        flex-direction: column;
        gap: 15px; /* Уменьшил отступ, так как добавятся блоки ошибок */
    }

    .admin-form input, .admin-form select {
        padding: 12px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Стиль для текста ошибки под полем */
    .field-error {
        color: #e53935;
        font-size: 14px;
        margin-top: -10px;
        margin-bottom: 5px;
    }

    .admin-form button {
        padding: 12px 40px;
        font-size: 18px;
        background: #1688D3;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: 0.2s;
        margin-top: 10px;
    }

    .admin-form button:hover { background: #0f6fb2; }
    .modal {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
        z-index: 10;
    }
    .modal.active { display: flex; }
    .modal-box {
        background: white;
        padding: 30px;
        border-radius: 6px;
        text-align: center;
    }
</style>

<div class="admin-container">
    <h2>Создать сотрудника</h2>
    <form method="POST" class="admin-form">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        
        <input type="text" name="name" placeholder="Имя" value="<?= $_POST['name'] ?? '' ?>">
        <?php if(isset($errors['name'])): ?>
            <div class="field-error"><?= $errors['name'][0] ?></div>
        <?php endif; ?>

        <input type="text" name="login" placeholder="Логин" value="<?= $_POST['login'] ?? '' ?>">
        <?php if(isset($errors['login'])): ?>
            <div class="field-error"><?= $errors['login'][0] ?></div>
        <?php endif; ?>

        <input type="password" name="password" placeholder="Пароль">
        <?php if(isset($errors['password'])): ?>
            <div class="field-error"><?= $errors['password'][0] ?></div>
        <?php endif; ?>

        <select name="role">
            <option value="admin">Админ</option>
            <option value="receptionist">Регистратор</option>
        </select>

        <button type="submit">Создать</button>
    </form>
</div>
<?php if (isset($message)): ?>
<div class="modal active">
    <div class="modal-box">
        <h3 style="color: #2e7d32;">Успех!</h3>
        <p><?= $message ?></p>
        <button onclick="closeModal()" style="padding: 10px 20px; cursor: pointer;">ОК</button>
    </div>
</div>
<?php endif; ?>

<script>
function closeModal() {
    document.querySelector('.modal').classList.remove('active');
}
</script>