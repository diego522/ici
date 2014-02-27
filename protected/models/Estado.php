<?php

/**
 * This is the model class for table "estado".
 *
 * The followings are the available columns in table 'estado':
 * @property integer $id_estado
 * @property integer $id_tipo_estado
 * @property string $nombre
 *
 * The followings are the available model relations:
 * @property Concurso[] $concursos
 * @property TipoEstado $idTipoEstado
 * @property Inscripcion[] $inscripcions
 * @property Nivel[] $nivels
 * @property Noticia[] $noticias
 * @property Periodo[] $periodos
 * @property Preinscripcion[] $preinscripcions
 * @property Solicitud[] $solicituds
 */
class Estado extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Estado the static model class
     */
    
    public static $PERIODO_EN_ESPERA = 10;
    public static $PERIODO_ACTIVO = 11;
    public static $PERIODO_CERRADO = 12;
    
    public static $CONCURSO_EN_ESPERA= 20;
    public static $CONCURSO_ABIERTO = 21;
    public static $CONCURSO_CERRADO = 22;
    
    public static $EQUIPO_PRIMER_LUGAR = 23;
    public static $INSCRIPCION_EN_ESPERA = 1;
    public static $INSCRIPCION_ACTIVA = 2;
    public static $INSCRIPCION_CERRADA = 3;  
    
    public static $NIVEL_EN_CONSTRUCCION = 16;    
    public static $NIVEL_VIGENTE = 17;    
    public static $NIVEL_OBSOLETO = 19;   
    
    public static $PREINSCRIPCON_EN_ESPERA = 13;    
    public static $PREINSCRIPCON_ABIERTA = 14;    
    public static $PREINSCRIPCON_CERRADA = 15;    
    
    public static $SOLICITUD_PENDIENTE_DE_REVISION = 4;    
    public static $SOLICITUD_ACEPTADA_PARCIALMENTE = 27;    
    public static $SOLICITUD_RECHAZADA = 5;    
    public static $SOLICITUD_ACEPTADA = 6;    
    public static $NOTICIA_PUBLICADA = 25;    
    public static $NOTICIA_DESPUBLICADA = 26;    
     
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'estado';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_tipo_estado, nombre', 'required'),
            array('id_tipo_estado', 'numerical', 'integerOnly' => true),
            array('nombre', 'length', 'max' => 200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_estado, id_tipo_estado, nombre', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'concursos' => array(self::HAS_MANY, 'Concurso', 'estado'),
            'idTipoEstado' => array(self::BELONGS_TO, 'TipoEstado', 'id_tipo_estado'),
            'inscripcions' => array(self::HAS_MANY, 'Inscripcion', 'estado'),
            'nivels' => array(self::HAS_MANY, 'Nivel', 'estado'),
            'noticias' => array(self::HAS_MANY, 'Noticia', 'estado'),
            'periodos' => array(self::HAS_MANY, 'Periodo', 'estado'),
            'preinscripcions' => array(self::HAS_MANY, 'Preinscripcion', 'estado'),
            'solicituds' => array(self::HAS_MANY, 'Solicitud', 'estado'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_estado' => 'Código',
            'id_tipo_estado' => 'Tipo de Estado',
            'nombre' => 'Nombre',
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

        $criteria->compare('id_estado', $this->id_estado);
        $criteria->compare('id_tipo_estado', $this->id_tipo_estado);
        $criteria->compare('nombre', $this->nombre, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}