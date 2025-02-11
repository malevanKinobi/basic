<?php
namespace app\models;

use yii\db\ActiveRecord;

class Schedule extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%schedule}}';
    }

    public function rules()
    {
        return [
            [['class_id', 'subject_id', 'teacher_id', 'date', 'start_time', 'end_time'], 'required'],
            [['class_id', 'subject_id', 'teacher_id'], 'integer'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['start_time', 'end_time'], 'date', 'format' => 'php:H:i:s'],
            [['room'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'class_id'   => 'Класс',
            'subject_id' => 'Предмет',
            'teacher_id' => 'Учитель',
            'date'       => 'Дата',
            'start_time' => 'Начало занятия',
            'end_time'   => 'Конец занятия',
            'room'       => 'Кабинет',
        ];
    }

    // Файл: models/Schedule.php
    public function getSubject()
    {
        // Предполагается, что модель предметов называется Subjects
        return $this->hasOne(Subjects::class, ['id' => 'subject_id']);
    }

    public function getTeacher()
    {
        // Модель User используется для учителей
        return $this->hasOne(User::class, ['id' => 'teacher_id']);
    }
}
