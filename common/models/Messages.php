<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int $issue81_id
 * @property string|null $send_text
 * @property string|null $to_whom
 * @property string|null $date_send
 */
class Messages extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return mb_strtolower(Fields::TAB_MESSAGES);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    	return Fields::getRules(Fields::TAB_MESSAGES);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
    	return Fields::getAttributes(Fields::TAB_MESSAGES);
    }

    /**
     * {@inheritdoc}
     * @return MessagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessagesQuery(get_called_class());
    }
}
