<?php

/**
 * This is the model class for table "mdl_user_enrolments".
 *
 * The followings are the available columns in table 'mdl_user_enrolments':
 * @property string $id
 * @property string $status
 * @property string $enrolid
 * @property string $userid
 * @property string $timestart
 * @property string $timeend
 * @property string $modifierid
 * @property string $timecreated
 * @property string $timemodified
 */
class MdlUserEnrolments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mdl_user_enrolments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('enrolid, userid', 'required'),
			array('status, enrolid, userid, timestart, timeend, modifierid, timecreated, timemodified', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, status, enrolid, userid, timestart, timeend, modifierid, timecreated, timemodified', 'safe', 'on'=>'search'),
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
                    'enrol'=>array(self::BELONGS_TO, 'MdlEnrol', 'enrolid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'status' => 'Status',
			'enrolid' => 'Enrolid',
			'userid' => 'Userid',
			'timestart' => 'Timestart',
			'timeend' => 'Timeend',
			'modifierid' => 'Modifierid',
			'timecreated' => 'Timecreated',
			'timemodified' => 'Timemodified',
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
		$criteria->compare('status',$this->status,true);
		$criteria->compare('enrolid',$this->enrolid,true);
		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('timestart',$this->timestart,true);
		$criteria->compare('timeend',$this->timeend,true);
		$criteria->compare('modifierid',$this->modifierid,true);
		$criteria->compare('timecreated',$this->timecreated,true);
		$criteria->compare('timemodified',$this->timemodified,true);

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
	 * @return MdlUserEnrolments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
