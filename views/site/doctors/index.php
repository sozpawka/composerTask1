<h1>Список врачей</h1>
<a href="/pop-it-mvc/doctors/create">Добавить врача</a>
<hr>
<?php if (!empty($doctors)): ?>
    <?php foreach ($doctors as $doctor): ?>
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <b>ФИО:</b>
            <?= $doctor['last_name'] ?>
            <?= $doctor['first_name'] ?>
            <?= $doctor['middle_name'] ?>
            <br>
            <b>Дата рождения:</b><?= $doctor['birth_date'] ?>
            <br>
            <b>Должность:</b><?= $doctor['position'] ?>
            <br>
            <b>Специализация:</b><?= $doctor['specialization'] ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Врачи не найдены</p>
<?php endif; ?>
<a href="/pop-it-mvc/">На главную</a>