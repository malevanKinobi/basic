<?php
use yii\db\Migration;

class m230206_000005_create_schedule_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%schedule}}', [
            'id'         => $this->primaryKey(),
            'class_id'   => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'teacher_id' => $this->integer()->notNull(),
            'date'       => $this->date()->notNull(),
            'start_time' => $this->time()->notNull(),
            'end_time'   => $this->time()->notNull(),
            'room'       => $this->string(50)->null(),
        ]);

        // Внешние ключи
        $this->addForeignKey(
            'fk-schedule-class_id',
            '{{%schedule}}',
            'class_id',
            '{{%classes}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-schedule-subject_id',
            '{{%schedule}}',
            'subject_id',
            '{{%subjects}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-schedule-teacher_id',
            '{{%schedule}}',
            'teacher_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-schedule-class_id', '{{%schedule}}');
        $this->dropForeignKey('fk-schedule-subject_id', '{{%schedule}}');
        $this->dropForeignKey('fk-schedule-teacher_id', '{{%schedule}}');
        $this->dropTable('{{%schedule}}');
    }
}
