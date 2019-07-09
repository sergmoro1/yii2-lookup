<?php

use yii\db\Migration;

/**
 * Class m180704_105455_create_property
 */
class m180704_105455_create_property extends Migration
{
    private const TABLE_LOOKUP   = '{{%lookup}}';
    private const TABLE_PROPERTY = '{{%property}}';
    
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(static::TABLE_PROPERTY, [
            'id'    => $this->primaryKey(),
            'name'  => $this->string(256)->notNull(),
        ], $tableOptions);

        $this->addForeignKey ('fk-lookup-property', static::TABLE_LOOKUP, 'property_id', static::TABLE_PROPERTY, 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable(static::TABLE_PROPERTY);
    }}
