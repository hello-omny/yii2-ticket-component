<?php

namespace omny\yii2\ticket\component\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ticket_theme".
 *
 * @property int $id
 * @property string $title
 * @property string $status
 *
 * @property Ticket[] $tickets
 */
class TicketTheme extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'ticket_theme';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title', 'status'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::class, ['theme_id' => 'id']);
    }
}
