<?php

/**
 * This is the model class for table "equipo".
 *
 * The followings are the available columns in table 'equipo':
 * @property integer $id_equipo
 * @property integer $estado
 * @property string $fecha_presentacion
 * @property string $nombre
 * @property integer $adjunto_bn
 * @property integer $adjunto_color
 *
 * The followings are the available model relations:
 * @property EquipoRelUsuarioRelConcurso[] $equipoRelUsuarioRelConcursos
 */
class Equipo extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Equipo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'equipo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre', 'required'),
            array('estado, adjunto_bn, adjunto_color', 'numerical', 'integerOnly' => true),
            array('nombre', 'length', 'max' => 200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_equipo, estado, fecha_presentacion, nombre, adjunto_bn, adjunto_color', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'equipoRelUsuarioRelConcursos' => array(self::HAS_MANY, 'EquipoRelUsuarioRelConcurso', 'id_equipo'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_equipo' => 'Id Equipo',
            'estado' => 'Estado',
            'fecha_presentacion' => 'Fecha Presentacion',
            'nombre' => 'Nombre',
            'adjunto_bn' => 'Adjunto Bn',
            'adjunto_color' => 'Adjunto Color',
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

        $criteria->compare('id_equipo', $this->id_equipo);
        $criteria->compare('estado', $this->estado);
        $criteria->compare('fecha_presentacion', $this->fecha_presentacion, true);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('adjunto_bn', $this->adjunto_bn);
        $criteria->compare('adjunto_color', $this->adjunto_color);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}