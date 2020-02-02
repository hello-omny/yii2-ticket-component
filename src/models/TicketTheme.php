<?php

namespace omny\yii2\ticket\component\models;

use Yii;

/**
 * This is the model class for table "ticket_theme".
 *
 * @property int $id
 * @property string $title
 * @property string $status
 *
 * @property Ticket[] $tickets
 */
class TicketTheme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_theme';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::class, ['theme_id' => 'id']);
    }
}
