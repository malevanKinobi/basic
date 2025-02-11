<?php
use yii\db\Migration;

class m230206_000002_create_classes_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%classes}}', [
            'id'    => $this->primaryKey(),
            'name'  => $this->string(50)->notNull(), // например, "9-А"
            'grade' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%classes}}');
    }
}
