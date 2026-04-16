<h1>Записи к врачу</h1>

<h3>Новая запись</h3>

<form method="POST" action="/pop-it-mvc/visits/create">

    <select name="patient_id">
        <?php foreach ($patients as $p): ?>
            <option value="<?= $p['id'] ?>">
                <?= $p['last_name'] ?> <?= $p['first_name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="doctor_id">
        <?php foreach ($doctors as $d): ?>
            <option value="<?= $d['id'] ?>">
                <?= $d['last_name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="datetime-local" name="visit_date" required>

    <button type="submit">Записать</button>
    <a href="/pop-it-mvc/">На главную</a>
</form>

<hr>

<h3>Записи</h3>

<?php foreach ($visits as $v): ?>
    <div style="margin-bottom:10px;">
        <b><?= $v['patient_last'] ?></b>
        |
        <?= $v['visit_date'] ?>
        |
        <?= $v['doctor_last'] ?>
        <form method="POST" action="/pop-it-mvc/visits/delete" style="display:inline;">
            <input type="hidden" name="id" value="<?= $v['id'] ?>">
            <button>Отменить</button>
        </form>
    </div>
<?php endforeach; ?>