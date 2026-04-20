<style>
.form-wrapper {
    background: #dcdcdc;
    padding: 50px;
    border-radius: 10px;
    max-width: 900px;
    margin: 0 auto;
}

.form-title {
    font-size: 32px;
    margin-bottom: 40px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px 30px;
}

.form-group {
    display: flex;
    flex-direction: column;
    font-size: 18px;
    color: #444;
}

.form-group input {
    margin-top: 8px;
    padding: 12px;
    border-radius: 6px;
    border: none;
    background: #eee;
    font-size: 16px;
}

.form-actions {
    margin-top: 35px;
}

.submit-btn {
    padding: 16px 30px;
    font-size: 18px;
    background: #1688D3;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.2s;
}

.submit-btn:hover {
    background: #0f6fb2;
}

.submit-btn:active {
    background: #084d7a;
}
</style>

<div class="container">

    <div class="form-wrapper">

        <div class="form-title">Добавление врача</div>

        <form method="POST" action="/pop-it-mvc/doctors/create">

            <div class="form-grid">

                <div class="form-group">
                    Фамилия
                    <input type="text" name="last_name" required>
                </div>

                <div class="form-group">
                    Имя
                    <input type="text" name="first_name" required>
                </div>

                <div class="form-group">
                    Отчество
                    <input type="text" name="middle_name">
                </div>

                <div class="form-group">
                    Дата рождения
                    <input type="date" name="birth_date" required>
                </div>

                <div class="form-group">
                    Должность
                    <input type="text" name="position" required>
                </div>

                <div class="form-group">
                    Специализация
                    <input type="text" name="specialization" required>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">
                    Сохранить врача
                </button>
            </div>

        </form>

    </div>

</div>