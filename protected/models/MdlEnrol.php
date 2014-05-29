<?php

/**
 * This is the model class for table "mdl_enrol".
 *
 * The followings are the available columns in table 'mdl_enrol':
 * @property string $id
 * @property string $enrol
 * @property string $status
 * @property string $courseid
 * @property string $sortorder
 * @property string $name
 * @property string $enrolperiod
 * @property string $enrolstartdate
 * @property string $enrolenddate
 * @property integer $expirynotify
 * @property string $expirythreshold
 * @property integer $notifyall
 * @property string $password
 * @property string $cost
 * @property string $currency
 * @property string $roleid
 * @property string $customint1
 * @property string $customint2
 * @property string $customint3
 * @property string $customint4
 * @property string $customint5
 * @property string $customint6
 * @property string $customint7
 * @property string $customint8
 * @property string $customchar1
 * @property string $customchar2
 * @property string $customchar3
 * @property string $customdec1
 * @property string $customdec2
 * @property string $customtext1
 * @property string $customtext2
 * @property string $customtext3
 * @property string $customtext4
 * @property string $timecreated
 * @property string $timemodified
 */
class MdlEnrol extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mdl_enrol';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('courseid', 'required'),
			array('expirynotify, notifyall', 'numerical', 'integerOnly'=>true),
			array('enrol, cost', 'length', 'max'=>20),
			array('status, courseid, sortorder, enrolperiod, enrolstartdate, enrolenddate, expirythreshold, roleid, customint1, customint2, customint3, customint4, customint5, customint6, customint7, customint8, timecreated, timemodified', 'length', 'max'=>10),
			array('name, customchar1, customchar2', 'length', 'max'=>255),
			array('password', 'length', 'max'=>50),
			array('currency', 'length', 'max'=>3),
			array('customchar3', 'length', 'max'=>1333),
			array('customdec1, customdec2', 'length', 'max'=>12),
			array('customtext1, customtext2, customtext3, customtext4', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, enrol, status, courseid, sortorder, name, enrolperiod, enrolstartdate, enrolenddate, expirynotify, expirythreshold, notifyall, password, cost, currency, roleid, customint1, customint2, customint3, customint4, customint5, customint6, customint7, customint8, customchar1, customchar2, customchar3, customdec1, customdec2, customtext1, customtext2, customtext3, customtext4, timecreated, timemodified', 'safe', 'on'=>'search'),
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
                     'userEnrolmets' => array(self::HAS_MANY, 'MdlUserEnrolments','enrolid')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'enrol' => 'Enrol',
			'status' => 'Status',
			'courseid' => 'Courseid',
			'sortorder' => 'Sortorder',
			'name' => 'Name',
			'enrolperiod' => 'Enrolperiod',
			'enrolstartdate' => 'Enrolstartdate',
			'enrolenddate' => 'Enrolenddate',
			'expirynotify' => 'Expirynotify',
			'expirythreshold' => 'Expirythreshold',
			'notifyall' => 'Notifyall',
			'password' => 'Password',
			'cost' => 'Cost',
			'currency' => 'Currency',
			'roleid' => 'Roleid',
			'customint1' => 'Customint1',
			'customint2' => 'Customint2',
			'customint3' => 'Customint3',
			'customint4' => 'Customint4',
			'customint5' => 'Customint5',
			'customint6' => 'Customint6',
			'customint7' => 'Customint7',
			'customint8' => 'Customint8',
			'customchar1' => 'Customchar1',
			'customchar2' => 'Customchar2',
			'customchar3' => 'Customchar3',
			'customdec1' => 'Customdec1',
			'customdec2' => 'Customdec2',
			'customtext1' => 'Customtext1',
			'customtext2' => 'Customtext2',
			'customtext3' => 'Customtext3',
			'customtext4' => 'Customtext4',
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
		$criteria->compare('enrol',$this->enrol,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('courseid',$this->courseid,true);
		$criteria->compare('sortorder',$this->sortorder,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('enrolperiod',$this->enrolperiod,true);
		$criteria->compare('enrolstartdate',$this->enrolstartdate,true);
		$criteria->compare('enrolenddate',$this->enrolenddate,true);
		$criteria->compare('expirynotify',$this->expirynotify);
		$criteria->compare('expirythreshold',$this->expirythreshold,true);
		$criteria->compare('notifyall',$this->notifyall);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('cost',$this->cost,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('roleid',$this->roleid,true);
		$criteria->compare('customint1',$this->customint1,true);
		$criteria->compare('customint2',$this->customint2,true);
		$criteria->compare('customint3',$this->customint3,true);
		$criteria->compare('customint4',$this->customint4,true);
		$criteria->compare('customint5',$this->customint5,true);
		$criteria->compare('customint6',$this->customint6,true);
		$criteria->compare('customint7',$this->customint7,true);
		$criteria->compare('customint8',$this->customint8,true);
		$criteria->compare('customchar1',$this->customchar1,true);
		$criteria->compare('customchar2',$this->customchar2,true);
		$criteria->compare('customchar3',$this->customchar3,true);
		$criteria->compare('customdec1',$this->customdec1,true);
		$criteria->compare('customdec2',$this->customdec2,true);
		$criteria->compare('customtext1',$this->customtext1,true);
		$criteria->compare('customtext2',$this->customtext2,true);
		$criteria->compare('customtext3',$this->customtext3,true);
		$criteria->compare('customtext4',$this->customtext4,true);
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
	 * @return MdlEnrol the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
