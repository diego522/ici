<?php

/**
 * This is the model class for table "requisitos_ramo".
 *
 * The followings are the available columns in table 'requisitos_ramo':
 * @property string $ramo
 * @property string $ramo_requisito
 */
class RequisitosRamo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RequisitosRamo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'requisitos_ramo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ramo, ramo_requisito', 'required'),
			array('ramo, ramo_requisito', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ramo, ramo_requisito', 'safe', 'on'=>'search'),
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
			'ramo' => 'Ramo',
			'ramo_requisito' => 'Ramo Requisito',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ramo',$this->ramo,true);
		$criteria->compare('ramo_requisito',$this->ramo_requisito,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}