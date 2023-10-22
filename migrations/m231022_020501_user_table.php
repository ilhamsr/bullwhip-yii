<?php

use yii\db\Migration;

/**
 * Class m231022_020501_user_table
 */
class m231022_020501_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'nama_pegawai' => $this->string()->notNull(),
            'alamat_pegawai' => $this->string()->notNull(),
            'hp_pegawai' => $this->string()->notNull(),
            'id_bagian' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'access_token' => $this->string(),

            // Add more columns as needed for your user model
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231022_020501_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231022_020501_user_table cannot be reverted.\n";

        return false;
    }
    */
}
