<?php
use yii\db\Migration;

class m230206_000001_create_users_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id'            => $this->primaryKey(),
            'username'      => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'email'         => $this->string()->notNull()->unique(),
            'role'          => $this->string(20)->notNull(), // teacher или student
            'class_id'      => $this->integer()->null(),      // для учеников (если один класс)
            'authKey'       => $this->string(32)->null(),       // добавлено поле для authKey
            'created_at'    => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at'    => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
