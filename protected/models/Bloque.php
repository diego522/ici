<?php

/**
 * This is the model class for table "bloque".
 *
 * The followings are the available columns in table 'bloque':
 * @property string $id_bloque
 * @property string $hora_inicio
 * @property string $hora_fin
 *
 * The followings are the available model relations:
 * @property Horario[] $horarios
 */
class Bloque extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Bloque the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'bloque';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('hora_inicio, hora_fin', 'required'),
            array('hora_inicio, hora_fin', 'length', 'max' => 200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_bloque, hora_inicio, hora_fin', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'horarios' => array(self::HAS_MANY, 'Horario', 'id_bloque'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_bloque' => 'Id Bloque',
            'hora_inicio' => 'Hora Inicio',
            'hora_fin' => 'Hora Fin',
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

        $criteria->compare('id_bloque', $this->id_bloque, true);
        $criteria->compare('hora_inicio', $this->hora_inicio, true);
        $criteria->compare('hora_fin', $this->hora_fin, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}