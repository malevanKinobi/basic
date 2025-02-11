<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Schedule;
use app\models\Homework;

class DiaryController extends Controller
{
    public function actionIndex()
    {
        // Получаем авторизованного пользователя
        $user = Yii::$app->user->identity;
        if (!$user) {
            // Если пользователь не авторизован, перенаправляем на страницу логина
            return $this->redirect(['home/login']);
        }

        // Предполагается, что для учеников заполнено поле class_id
        $classId = $user->class_id;
        if (!$classId) {
            throw new \yii\web\ForbiddenHttpException('У вас не указан класс.');
        }

        // Получаем расписание для класса, упорядоченное по дате и времени начала
        $schedules = Schedule::find()
            ->where(['class_id' => $classId])
            ->orderBy(['date' => SORT_ASC, 'start_time' => SORT_ASC])
            ->all();

        // Получаем домашние задания для занятий данного класса
        // Здесь мы используем joinWith() для связи с таблицей schedule
        $homeworks = Homework::find()
            ->joinWith('schedule')
            ->where(['schedule.class_id' => $classId])
            ->orderBy(['schedule.date' => SORT_ASC])
            ->all();

        return $this->render('index', [
            'schedules' => $schedules,
            'homeworks' => $homeworks,
        ]);
    }
}