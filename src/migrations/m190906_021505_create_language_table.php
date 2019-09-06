<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%language}}`.
 */
class m190906_021505_create_language_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%language}}', [
            'id' => $this->primaryKey(),
            'locale' => $this->string(6)->unique()->notNull(),
            'name' => $this->string(),
            'is_default' => $this->boolean()->notNull()->defaultValue(false),
            'is_archived' => $this->boolean()->notNull()->defaultValue(false)
        ]);

        $this->addCommentOnColumn('{{%language}}', 'locale', 'Locale should be canonicalized to 
        the format of ll-CC, where ll is a two- or three-letter lowercase language code according to ISO-639 and CC is 
        a two-letter country code according to ISO-3166.');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%language}}');
    }
}
