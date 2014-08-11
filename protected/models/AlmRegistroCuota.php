<?php

/**
 * This is the model class for table "alm_registro_cuota".
 *
 * The followings are the available columns in table 'alm_registro_cuota':
 * @property integer $id
 * @property string $nombre_archivo
 * @property integer $id_user_mdl
 * @property integer $cuota
 * @property string $fecha_creacion
 */
class AlmRegistroCuota extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alm_registro_cuota';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_archivo, id_user_mdl, fecha_creacion', 'required'),
			array('id_user_mdl, cuota', 'numerical', 'integerOnly'=>true),
			array('nombre_archivo', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre_archivo, id_user_mdl, cuota, fecha_creacion', 'safe', 'on'=>'search'),
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
			'nombre_archivo' => 'Nombre Archivo',
			'id_user_mdl' => 'Id User Mdl',
			'cuota' => 'Cuota',
			'fecha_creacion' => 'Fecha Creacion',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('nombre_archivo',$this->nombre_archivo,true);
		$criteria->compare('id_user_mdl',$this->id_user_mdl);
		$criteria->compare('cuota',$this->cuota);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AlmRegistroCuota the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
