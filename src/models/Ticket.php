<?php

namespace omny\yii2\ticket\component\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id
 * @property string $title
 * @property string $status
 * @property int $user_id
 * @property int $support_id
 * @property int $theme_id
 * @property string $created
 * @property string $closed
 *
 * @property TicketTheme $theme
 * @property TicketMessage[] $ticketMessages
 */
class Ticket extends ActiveRecord
{
    public const STATUS_NEW = 'new';
    public const STATUS_CLOSED = 'closed';

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'ticket';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['user_id', 'theme_id'], 'required'],
            [['user_id', 'support_id', 'theme_id'], 'default', 'value' => null],
            [['user_id', 'support_id', 'theme_id'], 'integer'],
            [['created', 'closed'], 'safe'],
            [['title', 'status'], 'string', 'max' => 255],
            [['theme_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketTheme::class, 'targetAttribute' => ['theme_id' => 'id']],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'status' => 'Status',
            'user_id' => 'User ID',
            'support_id' => 'Support ID',
            'theme_id' => 'Theme ID',
            'created' => 'Created',
            'closed' => 'Closed',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getTheme()
    {
        return $this->hasOne(TicketTheme::class, ['id' => 'theme_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTicketMessages()
    {
        return $this->hasMany(TicketMessage::class, ['ticket_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getActiveTicketMessages()
    {
        return $this->getTicketMessages()->andWhere(['ticket_message.status' => ['new']]);
    }

    /**
     * @return TicketMessage
     */
    public function getLastTicketMessage(): TicketMessage
    {
        return $this->getActiveTicketMessages()
            ->orderBy(['ticket_message.created' => SORT_DESC])
            ->one();
    }
}
