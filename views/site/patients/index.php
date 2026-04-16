<h1>Пациенты</h1>

<a href="/pop-it-mvc/patients/create">Добавить пациента</a> <a href="/pop-it-mvc/">На главную</a>
<hr>
<?php if (!empty($patients)): ?>
    <?php foreach ($patients as $p): ?>
        <div style="margin-bottom:10px;">
            <b><?= htmlspecialchars($p['last_name']) ?></b>
            <?= htmlspecialchars($p['first_name']) ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Пациентов пока нет</p>
<?php endif; ?>