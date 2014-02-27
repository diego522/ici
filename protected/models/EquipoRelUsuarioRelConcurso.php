<?php

/**
 * This is the model class for table "equipo_rel_usuario_rel_concurso".
 *
 * The followings are the available columns in table 'equipo_rel_usuario_rel_concurso':
 * @property integer $id_equipo
 * @property integer $id_usuario
 * @property integer $id_concurso
 *
 * The followings are the available model relations:
 * @property Concurso $idConcurso
 * @property Equipo $idEquipo
 * @property Usuario $idUsuario
 */
class EquipoRelUsuarioRelConcurso extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EquipoRelUsuarioRelConcurso the static model class
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
		return 'equipo_rel_usuario_rel_concurso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_equipo, id_usuario, id_concurso', 'required'),
			array('id_equipo, id_usuario, id_concurso', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_equipo, id_usuario, id_concurso', 'safe', 'on'=>'search'),
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
			'idConcurso' => array(self::BELONGS_TO, 'Concurso', 'id_concurso'),
			'idEquipo' => array(self::BELONGS_TO, 'Equipo', 'id_equipo'),
			'idUsuario' => array(self::BELONGS_TO, 'Usuario', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_equipo' => 'Id Equipo',
			'id_usuario' => 'Id Usuario',
			'id_concurso' => 'Id Concurso',
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

		$criteria->compare('id_equipo',$this->id_equipo);
		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('id_concurso',$this->id_concurso);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}