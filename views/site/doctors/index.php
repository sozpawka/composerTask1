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

        <div class="patients-title">Список врачей</div>

        <?php if (!empty($doctors)): ?>

            <table class="patients-table">
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Дата рождения</th>
                    <th>Должность</th>
                    <th>Специализация</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($doctors as $doctor): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($doctor['last_name']) ?>
                            <?= htmlspecialchars($doctor['first_name']) ?>
                            <?= htmlspecialchars($doctor['middle_name'] ?? '') ?>
                        </td>
                        <td><?= htmlspecialchars($doctor['birth_date']) ?></td>
                        <td><?= htmlspecialchars($doctor['position']) ?></td>
                        <td><?= htmlspecialchars($doctor['specialization']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <div class="empty-text">Врачи не найдены</div>
        <?php endif; ?>

        <button class="add-patient-btn"
                onclick="location.href='/pop-it-mvc/doctors/create'">
            Добавить врача
        </button>

    </div>

</div>