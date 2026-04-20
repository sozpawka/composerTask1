<style>
.patients-title {
    font-size: 32px;
    margin-bottom: 30px;
}

.patients-wrapper {
    background: #dcdcdc;
    padding: 40px;
    border-radius: 10px;
}

.patients-table {
    width: 100%;
    border-collapse: collapse;
    background: #eee;
    margin-top: 20px;
}

.patients-table th,
.patients-table td {
    border: 2px solid #333;
    padding: 12px;
    text-align: center;
    font-size: 18px;
}

.patients-table th {
    background: #ccc;
    font-weight: bold;
}

.add-patient-btn {
    margin-top: 30px;
    padding: 14px 30px;
    font-size: 18px;
    background: #1688D3;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.2s;
}

.add-patient-btn:hover {
    background: #0f6fb2;
}

.add-patient-btn:active {
    background: #084d7a;
}

.empty-text {
    text-align: center;
    font-size: 20px;
    margin-top: 20px;
    color: gray;
}
</style>

<div class="container">

    <div class="patients-wrapper">

        <div class="patients-title">Список пациентов</div>

        <?php if (!empty($patients)): ?>

            <table class="patients-table">
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Дата рождения</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($patients as $p): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($p['last_name']) ?>
                            <?= htmlspecialchars($p['first_name']) ?>
                            <?= htmlspecialchars($p['middle_name'] ?? '') ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($p['birth_date']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <div class="empty-text">Пациентов пока нет</div>
        <?php endif; ?>

        <button class="add-patient-btn"
                onclick="location.href='/pop-it-mvc/patients/create'">
            Добавить пациента
        </button>

    </div>

</div>