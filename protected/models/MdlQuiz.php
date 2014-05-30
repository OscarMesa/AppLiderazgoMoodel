<?php

/**
 * This is the model class for table "mdl_quiz".
 *
 * The followings are the available columns in table 'mdl_quiz':
 * @property string $id
 * @property string $course
 * @property string $name
 * @property string $intro
 * @property integer $introformat
 * @property string $timeopen
 * @property string $timeclose
 * @property string $preferredbehaviour
 * @property integer $attempts
 * @property integer $attemptonlast
 * @property integer $grademethod
 * @property integer $decimalpoints
 * @property integer $questiondecimalpoints
 * @property integer $reviewattempt
 * @property integer $reviewcorrectness
 * @property integer $reviewmarks
 * @property integer $reviewspecificfeedback
 * @property integer $reviewgeneralfeedback
 * @property integer $reviewrightanswer
 * @property integer $reviewoverallfeedback
 * @property string $questionsperpage
 * @property integer $shufflequestions
 * @property integer $shuffleanswers
 * @property string $questions
 * @property string $sumgrades
 * @property string $grade
 * @property string $timecreated
 * @property string $timemodified
 * @property string $timelimit
 * @property string $overduehandling
 * @property string $graceperiod
 * @property string $password
 * @property string $subnet
 * @property string $browsersecurity
 * @property string $delay1
 * @property string $delay2
 * @property integer $showuserpicture
 * @property integer $showblocks
 * @property string $navmethod
 */
class MdlQuiz extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mdl_quiz';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('intro, questions', 'required'),
			array('introformat, attempts, attemptonlast, grademethod, decimalpoints, questiondecimalpoints, reviewattempt, reviewcorrectness, reviewmarks, reviewspecificfeedback, reviewgeneralfeedback, reviewrightanswer, reviewoverallfeedback, shufflequestions, shuffleanswers, showuserpicture, showblocks', 'numerical', 'integerOnly'=>true),
			array('course, timeopen, timeclose, questionsperpage, sumgrades, grade, timecreated, timemodified, timelimit, graceperiod, delay1, delay2', 'length', 'max'=>10),
			array('name, password, subnet', 'length', 'max'=>255),
			array('preferredbehaviour, browsersecurity', 'length', 'max'=>32),
			array('overduehandling, navmethod', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, course, name, intro, introformat, timeopen, timeclose, preferredbehaviour, attempts, attemptonlast, grademethod, decimalpoints, questiondecimalpoints, reviewattempt, reviewcorrectness, reviewmarks, reviewspecificfeedback, reviewgeneralfeedback, reviewrightanswer, reviewoverallfeedback, questionsperpage, shufflequestions, shuffleanswers, questions, sumgrades, grade, timecreated, timemodified, timelimit, overduehandling, graceperiod, password, subnet, browsersecurity, delay1, delay2, showuserpicture, showblocks, navmethod', 'safe', 'on'=>'search'),
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
                    'intentos'=>array(self::HAS_MANY, 'MdlQuiz', 'quiz'),
                    'notas'=>array(self::HAS_MANY, 'MdlQuizGrades', 'quiz'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'course' => 'Course',
			'name' => 'Name',
			'intro' => 'Intro',
			'introformat' => 'Introformat',
			'timeopen' => 'Timeopen',
			'timeclose' => 'Timeclose',
			'preferredbehaviour' => 'Preferredbehaviour',
			'attempts' => 'Attempts',
			'attemptonlast' => 'Attemptonlast',
			'grademethod' => 'Grademethod',
			'decimalpoints' => 'Decimalpoints',
			'questiondecimalpoints' => 'Questiondecimalpoints',
			'reviewattempt' => 'Reviewattempt',
			'reviewcorrectness' => 'Reviewcorrectness',
			'reviewmarks' => 'Reviewmarks',
			'reviewspecificfeedback' => 'Reviewspecificfeedback',
			'reviewgeneralfeedback' => 'Reviewgeneralfeedback',
			'reviewrightanswer' => 'Reviewrightanswer',
			'reviewoverallfeedback' => 'Reviewoverallfeedback',
			'questionsperpage' => 'Questionsperpage',
			'shufflequestions' => 'Shufflequestions',
			'shuffleanswers' => 'Shuffleanswers',
			'questions' => 'Questions',
			'sumgrades' => 'Sumgrades',
			'grade' => 'Grade',
			'timecreated' => 'Timecreated',
			'timemodified' => 'Timemodified',
			'timelimit' => 'Timelimit',
			'overduehandling' => 'Overduehandling',
			'graceperiod' => 'Graceperiod',
			'password' => 'Password',
			'subnet' => 'Subnet',
			'browsersecurity' => 'Browsersecurity',
			'delay1' => 'Delay1',
			'delay2' => 'Delay2',
			'showuserpicture' => 'Showuserpicture',
			'showblocks' => 'Showblocks',
			'navmethod' => 'Navmethod',
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
		$criteria->compare('course',$this->course,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('intro',$this->intro,true);
		$criteria->compare('introformat',$this->introformat);
		$criteria->compare('timeopen',$this->timeopen,true);
		$criteria->compare('timeclose',$this->timeclose,true);
		$criteria->compare('preferredbehaviour',$this->preferredbehaviour,true);
		$criteria->compare('attempts',$this->attempts);
		$criteria->compare('attemptonlast',$this->attemptonlast);
		$criteria->compare('grademethod',$this->grademethod);
		$criteria->compare('decimalpoints',$this->decimalpoints);
		$criteria->compare('questiondecimalpoints',$this->questiondecimalpoints);
		$criteria->compare('reviewattempt',$this->reviewattempt);
		$criteria->compare('reviewcorrectness',$this->reviewcorrectness);
		$criteria->compare('reviewmarks',$this->reviewmarks);
		$criteria->compare('reviewspecificfeedback',$this->reviewspecificfeedback);
		$criteria->compare('reviewgeneralfeedback',$this->reviewgeneralfeedback);
		$criteria->compare('reviewrightanswer',$this->reviewrightanswer);
		$criteria->compare('reviewoverallfeedback',$this->reviewoverallfeedback);
		$criteria->compare('questionsperpage',$this->questionsperpage,true);
		$criteria->compare('shufflequestions',$this->shufflequestions);
		$criteria->compare('shuffleanswers',$this->shuffleanswers);
		$criteria->compare('questions',$this->questions,true);
		$criteria->compare('sumgrades',$this->sumgrades,true);
		$criteria->compare('grade',$this->grade,true);
		$criteria->compare('timecreated',$this->timecreated,true);
		$criteria->compare('timemodified',$this->timemodified,true);
		$criteria->compare('timelimit',$this->timelimit,true);
		$criteria->compare('overduehandling',$this->overduehandling,true);
		$criteria->compare('graceperiod',$this->graceperiod,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('subnet',$this->subnet,true);
		$criteria->compare('browsersecurity',$this->browsersecurity,true);
		$criteria->compare('delay1',$this->delay1,true);
		$criteria->compare('delay2',$this->delay2,true);
		$criteria->compare('showuserpicture',$this->showuserpicture);
		$criteria->compare('showblocks',$this->showblocks);
		$criteria->compare('navmethod',$this->navmethod,true);

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
	 * @return MdlQuiz the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
