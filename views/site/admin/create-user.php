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
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.admin-form input,
.admin-form select {
    padding: 12px;
    font-size: 16px;
}

.btn-container {
    text-align: center;
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
    }

    .admin-form button:hover {
        background: #0f6fb2;
    }
    .admin-form button:active {
        background: #084d7a;
    }
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
    }

    .modal.active {
        display: flex;
    }

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
        <input type="text" name="name" placeholder="Имя" required>
        <input type="text" name="login" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>

        <select name="role">
            <option value="admin">Админ</option>
            <option value="receptionist">Регистратор</option>
        </select>

        <button type="submit">Создать</button>
    </form>
</div>

<div class="modal <?= isset($message) ? 'active' : '' ?>">
    <div class="modal-box">
        <h3><?= $message ?? '' ?></h3>
        <button onclick="closeModal()">OK</button>
    </div>
</div>

<script>
function closeModal() {
    document.querySelector('.modal').classList.remove('active');
}
</script>