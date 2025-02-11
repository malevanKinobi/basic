<?php
namespace app\models;

use yii\db\ActiveRecord;

class Grades extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%grades}}';
    }

    public function rules()
    {
        return [
            [['student_id', 'teacher_id', 'subject_id', 'grade', 'date_assigned'], 'required'],
            [['student_id', 'teacher_id', 'subject_id'], 'integer'],
            [['date_assigned'], 'date', 'format' => 'php:Y-m-d'],
            [['grade'], 'string', 'max' => 10],
            [['comment'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'student_id'    => 'Ученик',
            'teacher_id'    => 'Учитель',
            'subject_id'    => 'Предмет',
            'grade'         => 'Оценка',
            'comment'       => 'Комментарий',
            'date_assigned' => 'Дата выставления',
        ];
    }
}
