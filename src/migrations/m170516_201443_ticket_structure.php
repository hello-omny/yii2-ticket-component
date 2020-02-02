<?php

use yii\db\Migration;

class m170516_201443_ticket_structure extends Migration
{
    public function up()
    {
        $this->createTable(
            'ticket',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(),
                'status' => $this->string()->defaultValue('new'),
                'user_id' => $this->bigInteger()->notNull(),
                'support_id' => $this->bigInteger()->null(),
                'theme_id' => $this->integer()->notNull(),
                'created' => 'timestamp without time zone NULL',
                'closed' => 'timestamp without time zone NULL',
            ]
        );

        $this->createIndex('idx__ticket__status', 'ticket', 'status');
        $this->createIndex('idx__ticket__user_id', 'ticket', 'user_id');
        $this->createIndex('idx__ticket__support_id', 'ticket', 'support_id');
        $this->createIndex('idx__ticket__theme_id', 'ticket', 'theme_id');
        $this->createIndex('idx__ticket__created', 'ticket', 'created');
        $this->createIndex('idx__ticket__closed', 'ticket', 'closed');


        $this->createTable(
            'ticket_message',
            [
                'id' => $this->primaryKey(),
                'text' => $this->string()->notNull(),
                'user_id' => $this->bigInteger()->notNull(),
                'status' => $this->string()->defaultValue('new'),
                'ticket_id' => $this->bigInteger()->notNull(),
                'created' => 'timestamp without time zone NULL',
                'viewed' => 'timestamp without time zone NULL',
            ]
        );

        $this->createIndex('idx__ticket_message__user_id', 'ticket_message', 'user_id');
        $this->createIndex('idx__ticket_message__ticket_id', 'ticket_message', 'ticket_id');
        $this->createIndex('idx__ticket_message__status', 'ticket_message', 'status');
        $this->createIndex('idx__ticket_message__created', 'ticket_message', 'created');
        $this->createIndex('idx__ticket_message__viewed', 'ticket_message', 'viewed');


        $this->createTable(
            'ticket_theme',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(),
                'status' => $this->string()->defaultValue('active'),
            ]
        );

        $this->createIndex('idx__ticket_theme__status', 'ticket_theme', 'status');

        $this->addForeignKey('fk__ticket__ticket_theme', 'ticket', 'theme_id', 'ticket_theme', 'id');
        $this->addForeignKey('fk__ticket__ticket_message', 'ticket_message', 'ticket_id', 'ticket', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk__ticket__ticket_theme', 'ticket');
        $this->dropForeignKey('fk__ticket__ticket_message', 'ticket_message');

        $this->dropTable('ticket_theme');
        $this->dropTable('ticket_message');
        $this->dropTable('ticket');
    }
}
