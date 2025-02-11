<?php
namespace app\models;

use yii\db\ActiveRecord;

class Homework extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%homework}}';
    }

    public function rules()
    {
        return [
            [['schedule_id', 'description'], 'required'],
            [['schedule_id'], 'integer'],
            [['description'], 'string'],
            [['due_date'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'schedule_id' => 'Расписание',
            'description' => 'Домашнее задание',
            'due_date'    => 'Срок сдачи',
        ];
    }

    public function getSchedule()
    {
        return $this->hasOne(Schedule::class, ['id' => 'schedule_id']);
    }
}
