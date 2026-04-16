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

<h4>Фильтр</h4>

<form method="GET" action="/pop-it-mvc/visits">

    <p>
        <input type="radio" name="filter" value=""
            <?= empty($filter) ? 'checked' : '' ?>>
        Без фильтра
    </p>

    <p>
        <input type="radio" name="filter" value="patient"
            <?= $filter === 'patient' ? 'checked' : '' ?>>
        По пациенту
    </p>

    <p>
        <input type="radio" name="filter" value="doctor"
            <?= $filter === 'doctor' ? 'checked' : '' ?>>
        По врачу и дате
    </p>

    <div id="patientBox">
        <select name="patient_id">
            <option value="">Все пациенты</option>
            <?php foreach ($patients as $p): ?>
                <option value="<?= $p['id'] ?>"
                    <?= ($selectedPatient == $p['id']) ? 'selected' : '' ?>>
                    <?= $p['last_name'] ?> <?= $p['first_name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div id="doctorBox">
        <select name="doctor_id">
            <?php foreach ($doctors as $d): ?>
                <option value="<?= $d['id'] ?>"
                    <?= ($selectedDoctor == $d['id']) ? 'selected' : '' ?>>
                    <?= $d['last_name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="date" name="date"
            value="<?= $selectedDate ?? '' ?>">
    </div>

    <button type="submit">Показать</button>
</form>
<hr>
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

<script>
const radios = document.querySelectorAll('input[name="filter"]');
const patientBox = document.getElementById('patientBox');
const doctorBox = document.getElementById('doctorBox');
const patientSelect = document.querySelector('select[name="patient_id"]');
const doctorSelect = document.querySelector('select[name="doctor_id"]');
const dateInput = document.querySelector('input[name="date"]');

function resetFields() {
    if (patientSelect) patientSelect.selectedIndex = 0;
    if (doctorSelect) doctorSelect.selectedIndex = 0;
    if (dateInput) dateInput.value = '';
}

function update() {
    let val = document.querySelector('input[name="filter"]:checked').value;
    patientBox.style.display = (val === 'patient') ? 'block' : 'none';
    doctorBox.style.display = (val === 'doctor') ? 'block' : 'none';
}

radios.forEach(r => {
    r.addEventListener('change', () => {
        resetFields();
        update();
    });
});

update();
</script>