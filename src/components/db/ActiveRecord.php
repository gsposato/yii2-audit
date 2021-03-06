<?php
/**
 * Base model for the audit classes containing some helper functions to auto serialize/unserialize the
 * raw data attributes.
 */

namespace gsposato\yii2\audit\components\db;

use gsposato\yii2\audit\Audit;
use gsposato\yii2\audit\components\Helper;

/**
 * ActiveRecord
 * @package gsposato\yii2\audit\models
 * @property string $created
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
	/** @var bool
	 * If true, automatically pack and unpack the data attribute
	 * */
    protected $autoSerialize = true;

	/**
     * @var array
     */
    protected $serializeAttributes = ['data'];

    /**
     * @return \yii\db\Connection
     */
    public static function getDb()
	{
		$audit = new Audit(1);
		return $audit->getDb();
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($insert && $this->hasAttribute('created'))
            $this->created = date('Y-m-d H:i:s');

        if ($this->autoSerialize)
            foreach ($this->serializeAttributes as $attribute)
                if ($this->hasAttribute($attribute))
                    $this->$attribute = [Helper::serialize($this->$attribute, false), \PDO::PARAM_LOB];

        return parent::beforeSave($insert);
    }

    /**
     * @param bool  $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->autoSerialize)
            foreach ($this->serializeAttributes as $attribute)
                if ($this->hasAttribute($attribute)) {
                    if (is_array($this->$attribute)) {
                        // Get rid of the extra PDO parameter type if needed
                        $array = $this->$attribute;
                        $this->$attribute = $array[0];
                    }
                    $this->$attribute = Helper::unserialize($this->$attribute);
                }
    }

    /**
     *
     */
    public function afterFind()
    {
        parent::afterFind();

        if ($this->autoSerialize)
            foreach ($this->serializeAttributes as $attribute)
                if ($this->hasAttribute($attribute))
                    $this->$attribute = Helper::unserialize($this->$attribute);
    }
}
