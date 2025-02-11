<?php
use yii\db\Migration;

class m230206_000010_add_auth_key_to_users_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'authKey', $this->string(32)->null()->after('class_id'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'authKey');
    }
}
