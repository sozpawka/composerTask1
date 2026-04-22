<style>
    .filter-row,
    .filter-group,
    .filter-param-form,
    .search-form,
    .search-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .filter-group {
        justify-content: space-between;
        width: 100%;
        flex-wrap: wrap;
    }

    .filter-block {
        min-height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .filter-param-form {
        justify-content: center;
    }

    .filter-param-form select,
    .filter-param-form input[type="date"],
    .search-input,
    .modal-content input,
    .modal-content select {
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .search-input {
        flex-grow: 1;
        height: 40px;
    }

    .find-btn,
    .add-btn,
    .cancel-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.2s, transform 0.1s;
        text-decoration: none;
        box-sizing: border-box;
        white-space: nowrap;
    }

    .find-btn,
    .add-btn {
        background: #1688D3;
        color: #fff;
        height: 40px;
        padding: 0 20px;
    }

    .find-btn:hover,
    .add-btn:hover {
        background: #0f6fb3;
    }

    .find-btn:active,
    .add-btn:active {
        transform: translateY(1px);
    }

    .add-btn {
        margin-top: 30px;
        padding: 18px 30px;
        font-size: 18px;
        height: auto;
    }

    .cancel-btn {
        padding: 6px 14px;
        background: #e53935;
        color: #fff;
    }

    .cancel-btn:hover {
        background: #b71c1c;
    }

    a.find-btn {
        background: #999;
    }

    a.find-btn:hover {
        background: #777;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        text-align: center;
        margin-top: 10px;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 12px;
    }

    .table th {
        background: #f5f5f5;
        font-weight: bold;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        min-width: 350px;
    }

    .modal-content h3 {
        margin-top: 0;
        margin-bottom: 20px;
    }

    .modal-content input,
    .modal-content select {
        width: 100%;
        margin-bottom: 15px;
    }

    .divider {
        height: 1px;
        background: #eee;
        margin: 20px 0;
    }

    .hidden {
        display: none;
    }

    .empty-msg {
        color: #888;
        font-style: italic;
        padding: 20px;
    }

    .search-form {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #eee;
        margin: 20px 0;
    }
</style>

<div class="container">
    <h2>Записи к врачу</h2>
    <div class="divider"></div>

    <form class="search-form" method="GET" action="/pop-it-mvc/visits">
        <input type="text" name="search" class="search-input" placeholder="Поиск по пациенту или врачу" value="<?= htmlspecialchars($search ?? '') ?>">
        <div class="search-controls">
            <button type="submit" class="find-btn">Найти</button>
            <?php if (!empty($search)): ?>
                <a href="<?= app()->route->getUrl('/visits') ?>" class="find-btn" style="text-decoration: none; background: #999;">Сброс</a>
            <?php endif; ?>
        </div>
    </form>
    <div class="divider"></div>
    <div class="filter-row">
        <strong>Фильтр:</strong>
		<form method="GET" action="/pop-it-mvc/visits" class="filter-group">
			<label><input type="radio" name="filter" value="none" <?= empty($filter)||$filter=='none'?'checked':'' ?>> Без фильтра</label>
			<label><input type="radio" name="filter" value="patient" <?= $filter=='patient'?'checked':'' ?>> По пациенту</label>
			<label><input type="radio" name="filter" value="doctor" <?= $filter=='doctor'?'checked':'' ?>> По врачу и дате</label>
			<label><input type="radio" name="filter" value="patient_doctors" <?= $filter=='patient_doctors'?'checked':'' ?>> Врачи пациента</label>
			<button type="submit" class="find-btn">Показать</button>
		</form>
	</div>

	<div class="divider"></div>

	<div class="filter-block">
		<form id="patientParams" method="GET" action="/pop-it-mvc/visits" class="filter-param-form <?= (in_array($filter, ['patient','patient_doctors']))?'':'hidden' ?>">
			<input type="hidden" name="filter" value="<?= htmlspecialchars($filter) ?>">
			<select name="patient_id" onchange="this.form.submit()">
				<option value="">Все пациенты</option>
				<?php foreach ($patients as $p): ?>
					<option value="<?= $p['id'] ?>" <?= ($selectedPatient==$p['id'])?'selected':'' ?>>
						<?= htmlspecialchars($p['last_name'] . ' ' . $p['first_name']) ?>
					</option>
				<?php endforeach; ?>
			</select>
			<button type="submit" class="find-btn">Найти</button>
		</form>

		<form id="doctorParams" method="GET" action="/pop-it-mvc/visits" class="filter-param-form <?= ($filter=='doctor')?'':'hidden' ?>">
			<input type="hidden" name="filter" value="doctor">
			<select name="doctor_id">
				<option value="">Все врачи</option>
				<?php foreach ($doctors as $d): ?>
					<option value="<?= $d['id'] ?>" <?= ($selectedDoctor==$d['id'])?'selected':'' ?>>
						<?= htmlspecialchars($d['last_name']) ?>
					</option>
				<?php endforeach; ?>
			</select>
			<input type="date" name="date" value="<?= htmlspecialchars($selectedDate) ?>">
			<button type="submit" class="find-btn">Найти</button>
		</form>

		<span id="noFilterText" class="<?= (empty($filter)||$filter=='none')?'':'hidden' ?>">Без изменений</span>
	</div>

	<div class="divider"></div>

	<?php if ($mode === 'doctors'): ?>
		<table class="table">
			<thead>
				<tr>
					<th>ФИО врача</th>
					<th>Специализация</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($doctorsByPatient)): ?>
					<?php foreach ($doctorsByPatient as $doc): ?>
					<tr>
						<td><?= htmlspecialchars($doc['last_name'] . ' ' . $doc['first_name']) ?></td>
						<td><?= htmlspecialchars($doc['position']) ?></td>
					</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr><td colspan="2" class="empty-msg">У пациента нет записей к врачам</td></tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php else: ?>
		<table class="table">
			<thead>
				<tr>
					<th>ФИО пациента</th>
					<th>ФИО врача</th>
					<th>Дата и время</th>
					<th>Специализация</th>
					<th>Отмена записи</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($visits)): ?>
					<?php foreach ($visits as $v): ?>
					<tr>
						<td><?= htmlspecialchars($v['patient_last'] . ' ' . $v['patient_first']) ?></td>
						<td><?= htmlspecialchars($v['doctor_last'] . ' ' . $v['doctor_first']) ?></td>
						<td><?= htmlspecialchars($v['visit_date']) ?></td>
						<td><?= htmlspecialchars($v['doctor_position']) ?></td>
						<td>
							<form method="POST" action="/pop-it-mvc/visits/delete" style="display:inline;">
								<input type="hidden" name="id" value="<?= $v['id'] ?>">
								<button type="submit" class="cancel-btn">Отмена</button>
							</form>
						</td>
					</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr><td colspan="5" class="empty-msg">Записи не найдены</td></tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php endif; ?>

	<button class="add-btn" onclick="openModal()">Добавить новую запись</button>
</div>

<div id="modal" class="modal" onclick="closeModal()">
	<div class="modal-content" onclick="event.stopPropagation()">
		<h3>Новая запись</h3>
		<form method="POST" action="/pop-it-mvc/visits/create">
			<select name="patient_id" required>
				<option value="" disabled selected>Выберите пациента</option>
				<?php foreach ($patients as $p): ?>
					<option value="<?= $p['id'] ?>">
						<?= htmlspecialchars($p['last_name'] . ' ' . $p['first_name']) ?>
					</option>
				<?php endforeach; ?>
			</select>

			<select name="doctor_id" required>
				<option value="" disabled selected>Выберите врача</option>
				<?php foreach ($doctors as $d): ?>
					<option value="<?= $d['id'] ?>">
						<?= htmlspecialchars($d['last_name']) ?>
					</option>
				<?php endforeach; ?>
			</select>

			<input type="datetime-local" name="visit_date" required>
			<button type="submit" class="find-btn">Записать</button>
		</form>
	</div>
</div>

<script>
	document.querySelectorAll('input[name="filter"]').forEach(radio => {
		radio.addEventListener('change', function() {
			const patientBox = document.getElementById('patientParams');
			const doctorBox = document.getElementById('doctorParams');
			const noFilterText = document.getElementById('noFilterText');
			
			patientBox.classList.toggle('hidden', this.value !== 'patient' && this.value !== 'patient_doctors');
			doctorBox.classList.toggle('hidden', this.value !== 'doctor');
			noFilterText.classList.toggle('hidden', !(this.value === '' || this.value === 'none'));
		});
	});

	function openModal() {
		document.getElementById('modal').style.display = 'flex';
	}

	function closeModal() {
		document.getElementById('modal').style.display = 'none';
	}

	document.addEventListener('keydown', e => { if(e.key === 'Escape') closeModal(); });
</script>