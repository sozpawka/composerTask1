<style>
    .auth-container {
        max-width: 400px;
        margin: 60px auto;
        background: #d9d9d9;
        padding: 40px;
        border-radius: 8px;
    }

    .auth-container h2 {
        text-align: center;
        font-size: 32px;
        margin-bottom: 30px;
    }

    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .form-group label {
        font-size: 18px;
        color: #333;
    }

    .auth-form input {
        padding: 12px;
        font-size: 18px;
        border: none;
        border-radius: 4px;
        background: #fff;
        outline: none;
    }

    .auth-form button {
        margin-top: 25px;
        padding: 15px;
        font-size: 18px;
        background: #1688D3;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.2s;
    }

    .auth-form button:hover {
        background: #0f6fb2;
    }

    .error-message {
        text-align: center;
        color: #e53935;
        font-size: 16px;
        margin-bottom: 15px;
    }
</style>

<div class="auth-container">
    <h2>Регистрация</h2>
    
    <?php if (!empty($message)): ?>
        <div class="error-message"><?= $message ?></div>
    <?php endif; ?>

    <form method="post" class="auth-form">
        <div class="form-group">
            <label>Имя</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Логин</label>
            <input type="text" name="login" required>
        </div>
        
        <div class="form-group">
            <label>Пароль</label>
            <input type="password" name="password" required>
        </div>
        
        <button type="submit">Зарегистрироваться</button>
    </form>
</div>
