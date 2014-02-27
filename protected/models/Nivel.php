<?php

/**
 * This is the model class for table "nivel".
 *
 * The followings are the available columns in table 'nivel':
 * @property string $id_nivel
 * @property string $nombre
 * @property integer $campus
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Horario[] $horarios
 * @property Estado $estado0
 */
class Nivel extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Nivel the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'nivel';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre, campus', 'required'),
            array('campus, estado', 'numerical', 'integerOnly' => true),
            array('nombre', 'length', 'max' => 200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_nivel, nombre, campus, estado', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'horarios' => array(self::HAS_MANY, 'Horario', 'id_nivel'),
            'estado0' => array(self::BELONGS_TO, 'Estado', 'estado'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_nivel' => 'Id Nivel',
            'nombre' => 'Nombre',
            'campus' => 'Campus',
            'estado' => 'Estado',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_nivel', $this->id_nivel, true);
        $criteria->compare('nombre', $this->nombre, true);
        
        $criteria->compare('estado', $this->estado);
        $criteria->addCondition('campus='.Yii::app()->user->getState('campus'));
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->campus = Yii::app()->user->getState('campus');
            $this->estado = Estado::$NIVEL_EN_CONSTRUCCION;
        }
        return parent::beforeSave();
    }

}