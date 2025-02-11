<?php
use yii\db\Migration;

class m230206_000006_create_homework_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%homework}}', [
            'id'          => $this->primaryKey(),
            'schedule_id' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'due_date'    => $this->date()->null(),
            'created_at'  => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-homework-schedule_id',
            '{{%homework}}',
            'schedule_id',
            '{{%schedule}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-homework-schedule_id', '{{%homework}}');
        $this->dropTable('{{%homework}}');
    }
}
