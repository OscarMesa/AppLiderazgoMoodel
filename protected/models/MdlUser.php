<?php

/**
 * This is the model class for table "mdl_user".
 *
 * The followings are the available columns in table 'mdl_user':
 * @property string $id
 * @property string $auth
 * @property integer $confirmed
 * @property integer $policyagreed
 * @property integer $deleted
 * @property integer $suspended
 * @property string $mnethostid
 * @property string $username
 * @property string $password
 * @property string $idnumber
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property integer $emailstop
 * @property string $icq
 * @property string $skype
 * @property string $yahoo
 * @property string $aim
 * @property string $msn
 * @property string $phone1
 * @property string $phone2
 * @property string $institution
 * @property string $department
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string $lang
 * @property string $theme
 * @property string $timezone
 * @property string $firstaccess
 * @property string $lastaccess
 * @property string $lastlogin
 * @property string $currentlogin
 * @property string $lastip
 * @property string $secret
 * @property string $picture
 * @property string $url
 * @property string $description
 * @property integer $descriptionformat
 * @property integer $mailformat
 * @property integer $maildigest
 * @property integer $maildisplay
 * @property integer $htmleditor
 * @property integer $autosubscribe
 * @property integer $trackforums
 * @property string $timecreated
 * @property string $timemodified
 * @property string $trustbitmask
 * @property string $imagealt
 */
class MdlUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'prograv3_moodle.mdl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('confirmed, policyagreed, deleted, suspended, emailstop, descriptionformat, mailformat, maildigest, maildisplay, htmleditor, autosubscribe, trackforums', 'numerical', 'integerOnly'=>true),
			array('auth, phone1, phone2', 'length', 'max'=>20),
			array('mnethostid, firstaccess, lastaccess, lastlogin, currentlogin, picture, timecreated, timemodified, trustbitmask', 'length', 'max'=>10),
			array('username, firstname, lastname, email, timezone', 'length', 'max'=>100),
			array('password, idnumber, url, imagealt', 'length', 'max'=>255),
			array('icq, secret', 'length', 'max'=>15),
			array('skype, yahoo, aim, msn, theme', 'length', 'max'=>50),
			array('institution', 'length', 'max'=>40),
			array('department, lang', 'length', 'max'=>30),
			array('address', 'length', 'max'=>70),
			array('city', 'length', 'max'=>120),
			array('country', 'length', 'max'=>2),
			array('lastip', 'length', 'max'=>45),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, auth, confirmed, policyagreed, deleted, suspended, mnethostid, username, password, idnumber, firstname, lastname, email, emailstop, icq, skype, yahoo, aim, msn, phone1, phone2, institution, department, address, city, country, lang, theme, timezone, firstaccess, lastaccess, lastlogin, currentlogin, lastip, secret, picture, url, description, descriptionformat, mailformat, maildigest, maildisplay, htmleditor, autosubscribe, trackforums, timecreated, timemodified, trustbitmask, imagealt', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'auth' => 'Auth',
			'confirmed' => 'Confirmed',
			'policyagreed' => 'Policyagreed',
			'deleted' => 'Deleted',
			'suspended' => 'Suspended',
			'mnethostid' => 'Mnethostid',
			'username' => 'Username',
			'password' => 'Password',
			'idnumber' => 'Idnumber',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
			'emailstop' => 'Emailstop',
			'icq' => 'Icq',
			'skype' => 'Skype',
			'yahoo' => 'Yahoo',
			'aim' => 'Aim',
			'msn' => 'Msn',
			'phone1' => 'Phone1',
			'phone2' => 'Phone2',
			'institution' => 'Institution',
			'department' => 'Department',
			'address' => 'Address',
			'city' => 'City',
			'country' => 'Country',
			'lang' => 'Lang',
			'theme' => 'Theme',
			'timezone' => 'Timezone',
			'firstaccess' => 'Firstaccess',
			'lastaccess' => 'Lastaccess',
			'lastlogin' => 'Lastlogin',
			'currentlogin' => 'Currentlogin',
			'lastip' => 'Lastip',
			'secret' => 'Secret',
			'picture' => 'Picture',
			'url' => 'Url',
			'description' => 'Description',
			'descriptionformat' => 'Descriptionformat',
			'mailformat' => 'Mailformat',
			'maildigest' => 'Maildigest',
			'maildisplay' => 'Maildisplay',
			'htmleditor' => 'Htmleditor',
			'autosubscribe' => 'Autosubscribe',
			'trackforums' => 'Trackforums',
			'timecreated' => 'Timecreated',
			'timemodified' => 'Timemodified',
			'trustbitmask' => 'Trustbitmask',
			'imagealt' => 'Imagealt',
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
		$criteria->compare('auth',$this->auth,true);
		$criteria->compare('confirmed',$this->confirmed);
		$criteria->compare('policyagreed',$this->policyagreed);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('suspended',$this->suspended);
		$criteria->compare('mnethostid',$this->mnethostid,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('idnumber',$this->idnumber,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('emailstop',$this->emailstop);
		$criteria->compare('icq',$this->icq,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('yahoo',$this->yahoo,true);
		$criteria->compare('aim',$this->aim,true);
		$criteria->compare('msn',$this->msn,true);
		$criteria->compare('phone1',$this->phone1,true);
		$criteria->compare('phone2',$this->phone2,true);
		$criteria->compare('institution',$this->institution,true);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('theme',$this->theme,true);
		$criteria->compare('timezone',$this->timezone,true);
		$criteria->compare('firstaccess',$this->firstaccess,true);
		$criteria->compare('lastaccess',$this->lastaccess,true);
		$criteria->compare('lastlogin',$this->lastlogin,true);
		$criteria->compare('currentlogin',$this->currentlogin,true);
		$criteria->compare('lastip',$this->lastip,true);
		$criteria->compare('secret',$this->secret,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('descriptionformat',$this->descriptionformat);
		$criteria->compare('mailformat',$this->mailformat);
		$criteria->compare('maildigest',$this->maildigest);
		$criteria->compare('maildisplay',$this->maildisplay);
		$criteria->compare('htmleditor',$this->htmleditor);
		$criteria->compare('autosubscribe',$this->autosubscribe);
		$criteria->compare('trackforums',$this->trackforums);
		$criteria->compare('timecreated',$this->timecreated,true);
		$criteria->compare('timemodified',$this->timemodified,true);
		$criteria->compare('trustbitmask',$this->trustbitmask,true);
		$criteria->compare('imagealt',$this->imagealt,true);

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
	 * @return MdlUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
