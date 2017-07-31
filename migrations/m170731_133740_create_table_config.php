<?php

use yii\db\Migration;

class m170731_133740_create_table_config extends Migration
{
    public function safeUp()
    {
        $this->createTable('custom_log_config',[
            'id' => $this->primaryKey(),
            'key' => $this->string()->notNull(),
            'value' => $this->text()->null()
        ]);
        $this->insert('custom_log_config', [
            'key' => 'enable',
            'value' => '0'
        ]);
        $this->insert('custom_log_config', [
            'key' => 'url',
            'value' => 'http://test/test'
        ]);
        $this->insert('custom_log_config', [
            'key' => 'type',
            'value' => '1'
        ]);
        $this->insert('custom_log_config', [
            'key' => 'excludeRoutes',
            'value' => ''
        ]);
        $this->insert('custom_log_config', [
            'key' => 'useIpGeoBase',
            'value' => '1'
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('custom_log_config');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170731_133740_create_table_config cannot be reverted.\n";

        return false;
    }
    */
}
