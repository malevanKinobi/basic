<?php
use yii\db\Migration;

class m230206_000003_add_fk_to_users_class_id extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-users-class_id',
            '{{%users}}',
            'class_id',
            '{{%classes}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-users-class_id', '{{%users}}');
    }
}
