<?php

/**
 * This is the model class for table "adjunto".
 *
 * The followings are the available columns in table 'adjunto':
 * @property integer $id_adjunto
 * @property string $nombre
 * @property string $ruta
 * @property string $tipo
 * @property integer $creador
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property Usuario $creador0
 * @property Inscripcion[] $inscripcions
 * @property Preinscripcion[] $preinscripcions
 * @property Solicitud[] $solicituds
 */
class Adjunto extends CActiveRecord {

    public static $formatos_imgagenes = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
    public static $formatos_documentos = array('pdf', 'doc', 'txt', 'odt', 'docx');

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Adjunto the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'adjunto';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre, ruta, tipo', 'required'),
            array('creador', 'numerical', 'integerOnly' => true),
            array('nombre, ruta, tipo', 'length', 'max' => 2000),
            array('fecha_creacion', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_adjunto, nombre, ruta, tipo, creador, fecha_creacion', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'creador0' => array(self::BELONGS_TO, 'Usuario', 'creador'),
            'inscripcions' => array(self::HAS_MANY, 'Inscripcion', 'adjunto'),
            'preinscripcions' => array(self::HAS_MANY, 'Preinscripcion', 'adjunto'),
            'solicituds' => array(self::HAS_MANY, 'Solicitud', 'adjunto'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_adjunto' => 'Id Adjunto',
            'nombre' => 'Nombre',
            'ruta' => 'Ruta',
            'tipo' => 'Tipo',
            'creador' => 'Creador',
            'fecha_creacion' => 'Fecha Creacion',
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

        $criteria->compare('id_adjunto', $this->id_adjunto);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('ruta', $this->ruta, true);
        $criteria->compare('tipo', $this->tipo, true);
        $criteria->compare('creador', $this->creador);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}