<?php
use yii\db\Migration;

class m230206_000004_create_subjects_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%subjects}}', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(100)->notNull(),
            'description' => $this->text()->null(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%subjects}}');
    }
}
