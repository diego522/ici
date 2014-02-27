<?php

/**
 * This is the model class for table "concurso".
 *
 * The followings are the available columns in table 'concurso':
 * @property integer $id_concurso
 * @property string $nombre
 * @property integer $max_participantes
 * @property string $descripcion
 * @property string $fechaCreacion
 * @property string $fechaApertura
 * @property string $fechaCierre
 * @property integer $adjunto
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Estado $estado0
 * @property EquipoRelUsuarioRelConcurso[] $equipoRelUsuarioRelConcursos
 */
class Concurso extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Concurso the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'concurso';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre, descripcion,fechaApertura,fechaCierre', 'required'),
            array('max_participantes, adjunto, estado', 'numerical', 'integerOnly' => true),
            array('nombre', 'length', 'max' => 2000),
            array('fechaApertura, fechaCierre', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_concurso, nombre, max_participantes, descripcion, fechaCreacion, fechaApertura, fechaCierre, adjunto, estado', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'estado0' => array(self::BELONGS_TO, 'Estado', 'estado'),
            'equipoRelUsuarioRelConcursos' => array(self::HAS_MANY, 'EquipoRelUsuarioRelConcurso', 'id_concurso'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_concurso' => 'Id Concurso',
            'nombre' => 'Nombre',
            'max_participantes' => 'Max Participantes',
            'descripcion' => 'Descripción',
            'fechaCreacion' => 'Fecha de Creación',
            'fechaApertura' => 'Fecha de Apertura',
            'fechaCierre' => 'Fecha Cierre',
            'adjunto' => 'Adjunto',
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

        $criteria->compare('id_concurso', $this->id_concurso);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('max_participantes', $this->max_participantes);
        $criteria->compare('descripcion', $this->descripcion, true);
        $criteria->compare('fechaCreacion', $this->fechaCreacion, true);
        $criteria->compare('fechaApertura', $this->fechaApertura, true);
        $criteria->compare('fechaCierre', $this->fechaCierre, true);
        $criteria->compare('adjunto', $this->adjunto);
        $criteria->compare('estado', $this->estado);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function verificaDisponibilidadDePlazo() {
        $fechaCierreConcurso = strtotime($this->fechaCierre);
        $fechaApertura = strtotime($this->fechaApertura);
        $fechaHoy = strtotime(date("Y-m-d H:i:s"));
        // echo (($fechaApertura < $fechaHoy) && ($fechaHoy < $fechaCierreConcurso));
        return (($fechaApertura < $fechaHoy) && ($fechaHoy < $fechaCierreConcurso));
    }

}