<?php

/**
 * This is the model class for table "mdl_course".
 *
 * The followings are the available columns in table 'mdl_course':
 * @property string $id
 * @property string $category
 * @property string $sortorder
 * @property string $fullname
 * @property string $shortname
 * @property string $idnumber
 * @property string $summary
 * @property integer $summaryformat
 * @property string $format
 * @property integer $showgrades
 * @property string $sectioncache
 * @property string $modinfo
 * @property integer $newsitems
 * @property string $startdate
 * @property string $marker
 * @property string $maxbytes
 * @property integer $legacyfiles
 * @property integer $showreports
 * @property integer $visible
 * @property integer $visibleold
 * @property integer $groupmode
 * @property integer $groupmodeforce
 * @property string $defaultgroupingid
 * @property string $lang
 * @property string $theme
 * @property string $timecreated
 * @property string $timemodified
 * @property integer $requested
 * @property integer $enablecompletion
 * @property integer $completionnotify
 */
class MdlCourse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'prograv3_moodle.mdl_course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('summaryformat, showgrades, newsitems, legacyfiles, showreports, visible, visibleold, groupmode, groupmodeforce, requested, enablecompletion, completionnotify', 'numerical', 'integerOnly'=>true),
			array('category, sortorder, startdate, marker, maxbytes, defaultgroupingid, timecreated, timemodified', 'length', 'max'=>10),
			array('fullname', 'length', 'max'=>254),
			array('shortname', 'length', 'max'=>255),
			array('idnumber', 'length', 'max'=>100),
			array('format', 'length', 'max'=>21),
			array('lang', 'length', 'max'=>30),
			array('theme', 'length', 'max'=>50),
			array('summary, sectioncache, modinfo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category, sortorder, fullname, shortname, idnumber, summary, summaryformat, format, showgrades, sectioncache, modinfo, newsitems, startdate, marker, maxbytes, legacyfiles, showreports, visible, visibleold, groupmode, groupmodeforce, defaultgroupingid, lang, theme, timecreated, timemodified, requested, enablecompletion, completionnotify', 'safe', 'on'=>'search'),
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
                    'complemento' => array(self::HAS_ONE,  'AlmComplementoCursos', 'id_curso_mdl'),
                    'contexts' => array(self::HAS_MANY,  'MdlContext','instanceid')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => 'Category',
			'sortorder' => 'Sortorder',
			'fullname' => 'Fullname',
			'shortname' => 'Shortname',
			'idnumber' => 'Idnumber',
			'summary' => 'Summary',
			'summaryformat' => 'Summaryformat',
			'format' => 'Format',
			'showgrades' => 'Showgrades',
			'sectioncache' => 'Sectioncache',
			'modinfo' => 'Modinfo',
			'newsitems' => 'Newsitems',
			'startdate' => 'Startdate',
			'marker' => 'Marker',
			'maxbytes' => 'Maxbytes',
			'legacyfiles' => 'Legacyfiles',
			'showreports' => 'Showreports',
			'visible' => 'Visible',
			'visibleold' => 'Visibleold',
			'groupmode' => 'Groupmode',
			'groupmodeforce' => 'Groupmodeforce',
			'defaultgroupingid' => 'Defaultgroupingid',
			'lang' => 'Lang',
			'theme' => 'Theme',
			'timecreated' => 'Timecreated',
			'timemodified' => 'Timemodified',
			'requested' => 'Requested',
			'enablecompletion' => 'Enablecompletion',
			'completionnotify' => 'Completionnotify',
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
		$criteria->compare('category',$this->category,true);
		$criteria->compare('sortorder',$this->sortorder,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('shortname',$this->shortname,true);
		$criteria->compare('idnumber',$this->idnumber,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('summaryformat',$this->summaryformat);
		$criteria->compare('format',$this->format,true);
		$criteria->compare('showgrades',$this->showgrades);
		$criteria->compare('sectioncache',$this->sectioncache,true);
		$criteria->compare('modinfo',$this->modinfo,true);
		$criteria->compare('newsitems',$this->newsitems);
		$criteria->compare('startdate',$this->startdate,true);
		$criteria->compare('marker',$this->marker,true);
		$criteria->compare('maxbytes',$this->maxbytes,true);
		$criteria->compare('legacyfiles',$this->legacyfiles);
		$criteria->compare('showreports',$this->showreports);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('visibleold',$this->visibleold);
		$criteria->compare('groupmode',$this->groupmode);
		$criteria->compare('groupmodeforce',$this->groupmodeforce);
		$criteria->compare('defaultgroupingid',$this->defaultgroupingid,true);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('theme',$this->theme,true);
		$criteria->compare('timecreated',$this->timecreated,true);
		$criteria->compare('timemodified',$this->timemodified,true);
		$criteria->compare('requested',$this->requested);
		$criteria->compare('enablecompletion',$this->enablecompletion);
		$criteria->compare('completionnotify',$this->completionnotify);

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
	 * @return MdlCourse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
