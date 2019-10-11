<?php
declare(strict_types=1);
namespace albertgeeca\language_manager\src\common\entities;

use Yii;
use yii\base\Exception;
use \yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "language".
 *
 * @property int        $id
 * @property string     $locale in format of ll-CC, where ll is a two- or three-letter lowercase language code and CC is a two-letter country code according to ISO-3166.
 * @property string     $name
 * @property int        $is_default
 * @property int        $is_archived
 */
class Language extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName():string
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
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
    public function attributeLabels():array
    {
        return [
            'id' => Yii::t('language', 'ID'),
            'locale' => Yii::t('language', 'Locale'),
            'name' => Yii::t('language', 'Name'),
            'is_default' => Yii::t('language', 'Default'),
            'is_archived' => Yii::t('language', 'Archived'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($this->is_default) {
                if ($this->is_archived) {
                    throw new Exception(Yii::t("language", "Default language can not be archived"));
                }
                $currentDefault = Language::findOne(['is_default' => true]);
                if ($currentDefault == null) {
                    throw new NotFoundHttpException(Yii::t('language', "Default language not found"));
                }
                $currentDefault->is_default = false;
                $currentDefault->save();
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * Retriesves Language model by its id
     * @param int $id
     * @return Language|null
     * @throws NotFoundHttpException
     */
    public static function findModel(int $id):ActiveRecord
    {
        $language = Language::findOne($id);
        if ($language == null) {
            throw new NotFoundHttpException(Yii::t('language', "Language with such ID not found"));
        }
        return $language;
    }

    /**
     * @param $id - ID of new default element
     * @return mixed
     * @throws Exception
     */
    public static function switchDefault(int $id):void
    {
        $language = Language::findModel($id);

        if (!$language->is_default) {
            $language->is_default = true;
            $language->save();
        } else {
            throw new \Exception(Yii::t('language', 'This language is default already'));
        }

    }
}
