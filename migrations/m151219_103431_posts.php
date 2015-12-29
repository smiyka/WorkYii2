<?php

use yii\db\Schema;
use yii\db\Migration;

class m151219_103431_posts extends Migration
{
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'text_post' => $this->text()->notNull(),
            'author' => $this->string(),
        ]);
    }

    public function down()
    {
        $this->dropTable('posts');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
