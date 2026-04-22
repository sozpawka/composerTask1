<style>
    .auth-container {
        max-width: 400px;
        margin: 80px auto;
        background: #d9d9d9;
        padding: 40px;
        border-radius: 8px;
        text-align: left;
    }

    .auth-container h2 {
        text-align: center;
        font-size: 32px;
        margin-bottom: 40px;
    }

    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-size: 18px;
        color: #555;
    }

    .auth-form input {
        padding: 12px;
        font-size: 18px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }

    .auth-form button {
        margin-top: 20px;
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

    .message {
        text-align: center;
        color: #e53935;
        font-size: 16px;
    }
    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
        border: 1px solid #f5c6cb;
    }
</style>

<div class="auth-container">
    <h2>Авторизация</h2>
    
    <?php if (!empty($message)): ?>
        <div class="error-message">
            <?php 
                $errors = json_decode($message, true); 
                if (is_array($errors)): 
                    foreach ($errors as $fieldErrors): 
                        foreach ($fieldErrors as $error): ?>
                            <p style="margin: 0;"><?= $error ?></p>
                        <?php endforeach; 
                    endforeach; 
                else: 
                    echo $message;
                endif; 
            ?>
        </div>
    <?php endif; ?>

    <?php if (!app()->auth::check()): ?>
        <form method="post" class="auth-form">
            <div class="form-group">
                <label>Логин</label>
                <input type="text" name="login">
            </div>
            
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password">
            </div>
            
            <button type="submit">Войти</button>
        </form>
    <?php else: ?>
        <h3 style="text-align: center;">Вы вошли как: <?= app()->auth->user()->name ?? ''; ?></h3>
    <?php endif; ?>
</div>
