<?php

/**
 * This is the model class for table "solicitud".
 *
 * The followings are the available columns in table 'solicitud':
 * @property integer $id_solicitud
 * @property integer $tipo_solicitud
 * @property string $motivo
 * @property integer $id_alumno
 * @property integer $adjunto
 * @property integer $estado
 * @property string $fecha_creacion
 * @property string $motivo_rechazo
 * @property integer $id_periodo
 * @property string $fecha_resolucion
 *
 * The followings are the available model relations:
 * @property RamoSolicitud[] $ramoSolicituds
 * @property TipoSolicitud $tipoSolicitud
 * @property Usuario $idAlumno
 * @property Adjunto $adjunto0
 * @property Estado $estado0
 * @property Periodo $idPeriodo
 */
class Solicitud extends CActiveRecord {

    public $nombre;
    public static $SOLICITUD_POR_INCUMPLIMIENTO = 1;
    public static $SOLICITUD_POR_EXCESO_DE_CREDITOS = 2;
    public static $SOLICITUD_POR_ENERMEDAD = 3;
    public static $SOLICITUD_POR_OTRO_MOTIVO = 4;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Solicitud the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'solicitud';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tipo_solicitud, motivo,', 'required'),
            array('estado,', 'required', 'on' => 'resolver'),
            array('motivo_rechazo,', 'validaObservaciones', 'on' => 'resolver'),
            array('tipo_solicitud, id_alumno, adjunto, estado, id_periodo', 'numerical', 'integerOnly' => true),
            array('motivo_rechazo,fecha_creacion,fecha_resolucion,adjunto,estado,motivo,tipo_solicitud', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_solicitud, nombre,tipo_solicitud, motivo, id_alumno, adjunto, estado, fecha_creacion, motivo_rechazo, id_periodo, fecha_resolucion', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'ramoSolicituds' => array(self::HAS_MANY, 'RamoSolicitud', 'id_solicitud'),
            'tipoSolicitud' => array(self::BELONGS_TO, 'TipoSolicitud', 'tipo_solicitud'),
            'idAlumno' => array(self::BELONGS_TO, 'Usuario', 'id_alumno'),
            'adjunto0' => array(self::BELONGS_TO, 'Adjunto', 'adjunto'),
            'estado0' => array(self::BELONGS_TO, 'Estado', 'estado'),
            'idPeriodo' => array(self::BELONGS_TO, 'Periodo', 'id_periodo'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_solicitud' => 'Código de Solicitud',
            'tipo_solicitud' => 'Tipo de Solicitud',
            'motivo' => 'Motivo',
            'id_alumno' => 'Alumno',
            'adjunto' => 'Informe Curricular',
            'estado' => 'Estado',
            'fecha_creacion' => 'Fecha de Creación',
            'motivo_rechazo' => 'Observaciones',
            'id_periodo' => 'Periodo',
            'fecha_resolucion' => 'Fecha de Resolución',
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
        $criteria->compare('id_solicitud', $this->id_solicitud);
        $criteria->compare('tipo_solicitud', $this->tipo_solicitud);
        $criteria->compare('motivo', $this->motivo, true);
        $criteria->compare('id_alumno', $this->id_alumno);
        $criteria->compare('adjunto', $this->adjunto);
        $criteria->compare('estado', $this->estado);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('motivo_rechazo', $this->motivo_rechazo, true);
        $criteria->compare('id_periodo', $this->id_periodo);
        $criteria->compare('fecha_resolucion', $this->fecha_resolucion, true);
        $criteria->addCondition('id_alumno in (select id_usuario from usuario where campus=' . Yii::app()->user->getState('campus') . ')');
        if ($this->nombre != NULL) {
            $criteria->addCondition("id_alumno in (select id_usuario from usuario where UCASE(nombre) like ('%" . $this->nombre . "%'))");
        }
        $criteria->order = 'fecha_creacion DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchMisSolicitudes() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('id_solicitud', $this->id_solicitud);
        $criteria->compare('tipo_solicitud', $this->tipo_solicitud);
        $criteria->compare('motivo', $this->motivo, true);
        $criteria->compare('id_alumno', $this->id_alumno);
        $criteria->compare('adjunto', $this->adjunto);
        $criteria->compare('estado', $this->estado);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('motivo_rechazo', $this->motivo_rechazo, true);
        $criteria->compare('id_periodo', $this->id_periodo);
        $criteria->compare('fecha_resolucion', $this->fecha_resolucion, true);
        $criteria->addCondition('id_alumno=' . Yii::app()->user->id);
        $criteria->order = 'fecha_creacion DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array(
            'ERememberFiltersBehavior' => array(
                'class' => 'application.components.ERememberFiltersBehavior',
                'defaults' => array(), /* optional line */
                'defaultStickOnClear' => false /* optional line */
            ),
        );
    }

    protected function afterFind() {
        // convert to display format
        $this->fecha_creacion = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_creacion));
        $this->fecha_resolucion = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_resolucion));
        parent::afterFind();
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->fecha_creacion = new CDbExpression('NOW()');
            $this->estado = Estado::$SOLICITUD_PENDIENTE_DE_REVISION;
            $this->id_alumno = Yii::app()->user->id;
        } else {
            $newDate = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_creacion);
            if ($newDate != NULL)
                $this->fecha_creacion = $newDate->format('Y-m-d H:i:s');
            else
                $this->fecha_creacion = NULL;
        }
        $newDate2 = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_resolucion);
        if ($newDate2 != NULL)
            $this->fecha_resolucion = $newDate2->format('Y-m-d H:i:s');
        else
            $this->fecha_resolucion = NULL;
        return parent::beforeSave();
    }

    public function validaObservaciones($attribute, $params = null) {
        if ($this->estado == Estado::$SOLICITUD_RECHAZADA && $this->motivo_rechazo == NULL) {
            $this->addError('motivo_rechazo', 'las observaciones son obligatorias en el caso de rechazo.');
        }
    }

    public function cssClassStyle() {
        if ($this->estado == Estado::$SOLICITUD_ACEPTADA) {
            return "aceptada";
        } elseif ($this->estado == Estado::$SOLICITUD_PENDIENTE_DE_REVISION) {
            return "pendiente";
        } elseif ($this->estado == Estado::$SOLICITUD_RECHAZADA) {
            return "rechazada";
        } elseif ($this->estado == Estado::$SOLICITUD_ACEPTADA_PARCIALMENTE) {
            return "parcial";
        } else {
            return "";
        }
    }

}