<?php

use yii\db\Schema;
use yii\db\Migration;

class m151219_110718_category_posts extends Migration
{
    public function up()
    {
        $this->createTable('category_posts', [
            'category_id' => $this->integer()->notNull(),
            'posts_id' => $this->integer()->notNull(),
        ]);

        $this ->addForeignKey('FK_Category_Posts','category_posts','category_id', 'category', 'id');
        $this ->addForeignKey('FK_Posts_Category','category_posts','posts_id', 'posts', 'id');
    }

    public function down()
    {
        $this->dropTable('middle');
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
