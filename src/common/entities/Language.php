<?php

namespace albertgeeca\language_manager\src\common\entities;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property int        $id
 * @property string     $locale in format of ll-CC, where ll is a two- or three-letter lowercase language code and CC is a two-letter country code according to ISO-3166.
 * @property string     $name
 * @property int        $is_default
 * @property int        $is_archived
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['locale'], 'required'],
            [['locale'], 'unique'],

            [['is_default', 'is_archived'], 'boolean', 'trueValue' => true, 'falseValue' => false],
            [['is_default', 'is_archived'], 'default', 'value' => false],

            [['locale'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('language', 'ID'),
            'locale' => Yii::t('language', 'Locale'),
            'name' => Yii::t('language', 'Name'),
            'is_default' => Yii::t('language', 'Is Default'),
            'is_archived' => Yii::t('language', 'Is Archived'),
        ];
    }
}
