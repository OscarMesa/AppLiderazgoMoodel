<?php

/**
 * This is the model class for table "mdl_quiz_attempts".
 *
 * The followings are the available columns in table 'mdl_quiz_attempts':
 * @property string $id
 * @property string $uniqueid
 * @property string $quiz
 * @property string $userid
 * @property integer $attempt
 * @property string $sumgrades
 * @property string $timestart
 * @property string $timefinish
 * @property string $timemodified
 * @property string $timecheckstate
 * @property string $layout
 * @property integer $preview
 * @property string $state
 * @property integer $needsupgradetonewqe
 * @property string $currentpage
 */
class MdlQuizAttempts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mdl_quiz_attempts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('layout', 'required'),
			array('attempt, preview, needsupgradetonewqe', 'numerical', 'integerOnly'=>true),
			array('uniqueid, quiz, userid, sumgrades, timestart, timefinish, timemodified, timecheckstate, currentpage', 'length', 'max'=>10),
			array('state', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uniqueid, quiz, userid, attempt, sumgrades, timestart, timefinish, timemodified, timecheckstate, layout, preview, state, needsupgradetonewqe, currentpage', 'safe', 'on'=>'search'),
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
                    'quiz'=>array(self::BELONGS_TO, 'MdlQuizAttempts', 'quiz'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uniqueid' => 'Uniqueid',
			'quiz' => 'Quiz',
			'userid' => 'Userid',
			'attempt' => 'Attempt',
			'sumgrades' => 'Sumgrades',
			'timestart' => 'Timestart',
			'timefinish' => 'Timefinish',
			'timemodified' => 'Timemodified',
			'timecheckstate' => 'Timecheckstate',
			'layout' => 'Layout',
			'preview' => 'Preview',
			'state' => 'State',
			'needsupgradetonewqe' => 'Needsupgradetonewqe',
			'currentpage' => 'Currentpage',
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
		$criteria->compare('uniqueid',$this->uniqueid,true);
		$criteria->compare('quiz',$this->quiz,true);
		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('attempt',$this->attempt);
		$criteria->compare('sumgrades',$this->sumgrades,true);
		$criteria->compare('timestart',$this->timestart,true);
		$criteria->compare('timefinish',$this->timefinish,true);
		$criteria->compare('timemodified',$this->timemodified,true);
		$criteria->compare('timecheckstate',$this->timecheckstate,true);
		$criteria->compare('layout',$this->layout,true);
		$criteria->compare('preview',$this->preview);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('needsupgradetonewqe',$this->needsupgradetonewqe);
		$criteria->compare('currentpage',$this->currentpage,true);

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
	 * @return MdlQuizAttempts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
