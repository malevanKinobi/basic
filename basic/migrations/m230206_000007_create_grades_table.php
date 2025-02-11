<?php
use yii\db\Migration;

class m230206_000007_create_grades_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%grades}}', [
            'id'            => $this->primaryKey(),
            'student_id'    => $this->integer()->notNull(),
            'teacher_id'    => $this->integer()->notNull(),
            'subject_id'    => $this->integer()->notNull(),
            'grade'         => $this->string(10)->notNull(), // можно использовать число, если требуется
            'comment'       => $this->text()->null(),
            'date_assigned' => $this->date()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-grades-student_id',
            '{{%grades}}',
            'student_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-grades-teacher_id',
            '{{%grades}}',
            'teacher_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-grades-subject_id',
            '{{%grades}}',
            'subject_id',
            '{{%subjects}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-grades-student_id', '{{%grades}}');
        $this->dropForeignKey('fk-grades-teacher_id', '{{%grades}}');
        $this->dropForeignKey('fk-grades-subject_id', '{{%grades}}');
        $this->dropTable('{{%grades}}');
    }
}
