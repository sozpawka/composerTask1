<?php $user = app()->auth::user(); ?>

<div class="container">

    <div class="title">
        <h2>Главная страница</h2>
        <?php if ($user): ?>
            <div class="role">
                Вы вошли как: <?= $user->login ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="divider"></div>

    <?php if ($user): ?>
        <div class="section-title">
            <?= $user->role === 'admin' ? 'Админ панель' : 'Регистратура' ?>
        </div>

        <div class="divider"></div>

        <div class="grid">

            <?php if ($user->role === 'admin'): ?>

                <a href="/pop-it-mvc/admin" class="btn full">Админ панель</a>

            <?php else: ?>

                <a href="/pop-it-mvc/patients" class="btn">Пациенты</a>
                <a href="/pop-it-mvc/doctors" class="btn">Врачи</a>

                <a href="/pop-it-mvc/patients/create" class="btn">Добавить пациента</a>
                <a href="/pop-it-mvc/doctors/create" class="btn">Добавить врача</a>

                <a href="/pop-it-mvc/visits" class="btn full">
                    Записать пациента к врачу
                </a>

            <?php endif; ?>

        </div>

    <?php else: ?>

        <div class="section-title">Вы гость</div>

    <?php endif; ?>

</div>