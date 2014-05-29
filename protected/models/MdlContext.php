<?php

/**
 * This is the model class for table "mdl_context".
 *
 * The followings are the available columns in table 'mdl_context':
 * @property string $id
 * @property string $contextlevel
 * @property string $instanceid
 * @property string $path
 * @property integer $depth
 */
class MdlContext extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mdl_context';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('depth', 'numerical', 'integerOnly'=>true),
			array('contextlevel, instanceid', 'length', 'max'=>10),
			array('path', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contextlevel, instanceid, path, depth', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'course'=>array(self::BELONGS_TO, 'MdlCourse', 'instanceid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contextlevel' => 'Contextlevel',
			'instanceid' => 'Instanceid',
			'path' => 'Path',
			'depth' => 'Depth',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('contextlevel',$this->contextlevel,true);
		$criteria->compare('instanceid',$this->instanceid,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('depth',$this->depth);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->db1;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MdlContext the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
