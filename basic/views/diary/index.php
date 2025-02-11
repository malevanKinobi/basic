<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $schedules app\models\Schedule[] */
/* @var $homeworks app\models\Homework[] */
?>
<h1>Электронный дневник</h1>

<h2>Расписание</h2>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Дата</th>
        <th>Время</th>
        <th>Предмет</th>
        <th>Учитель</th>
        <th>Кабинет</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($schedules as $schedule): ?>
        <tr>
            <td><?= Html::encode($schedule->date) ?></td>
            <td><?= Html::encode($schedule->start_time) ?> - <?= Html::encode($schedule->end_time) ?></td>
            <td><?= isset($schedule->subject) ? Html::encode($schedule->subject->name) : '-' ?></td>
            <td><?= isset($schedule->teacher) ? Html::encode($schedule->teacher->username) : '-' ?></td>
            <td><?= Html::encode($schedule->room) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2>Домашние задания</h2>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Дата занятия</th>
        <th>Предмет</th>
        <th>Описание задания</th>
        <th>Срок сдачи</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($homeworks as $hw): ?>
        <tr>
            <td><?= isset($hw->schedule) ? Html::encode($hw->schedule->date) : '-' ?></td>
            <td><?= (isset($hw->schedule) && isset($hw->schedule->subject)) ? Html::encode($hw->schedule->subject->name) : '-' ?></td>
            <td><?= Html::encode($hw->description) ?></td>
            <td><?= Html::encode($hw->due_date) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
