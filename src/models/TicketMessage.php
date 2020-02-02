<?php

namespace omny\yii2\ticket\component\models;

use Yii;

/**
 * This is the model class for table "ticket_message".
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property string $status
 * @property int $ticket_id
 * @property string $created
 * @property string $viewed
 *
 * @property Ticket $ticket
 */
class TicketMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'user_id', 'ticket_id'], 'required'],
            [['user_id', 'ticket_id'], 'default', 'value' => null],
            [['user_id', 'ticket_id'], 'integer'],
            [['created', 'viewed'], 'safe'],
            [['text', 'status'], 'string', 'max' => 255],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::class, 'targetAttribute' => ['ticket_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'status' => 'Status',
            'ticket_id' => 'Ticket ID',
            'created' => 'Created',
            'viewed' => 'Viewed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::class, ['id' => 'ticket_id']);
    }
}
