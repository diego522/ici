<?php

/**
 * This is the model class for table "periodo".
 *
 * The followings are the available columns in table 'periodo':
 * @property integer $id_periodo
 * @property integer $id_tipo_proceso
 * @property string $fecha_apertura
 * @property string $fecha_cierre
 * @property string $fecha_creacion
 * @property integer $estado
 * @property integer $campus
 * @property string $titulo
 *
 * The followings are the available model relations:
 * @property TipoProceso $idTipoProceso
 * @property Estado $estado0
 * @property Solicitud[] $solicituds
 */
class Periodo extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Periodo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'periodo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('titulo,fecha_cierre, fecha_apertura', 'required', 'on' => 'create'),
            array('titulo,fecha_cierre, fecha_apertura,estado ', 'required', 'on' => 'update'),
            array('id_tipo_proceso, estado, campus', 'numerical', 'integerOnly' => true),
            array('titulo', 'length', 'max' => 2000),
            array('fecha_apertura, fecha_apertura,titulo', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_periodo, id_tipo_proceso, fecha_apertura, fecha_cierre, fecha_creacion, estado, campus, titulo', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idTipoProceso' => array(self::BELONGS_TO, 'TipoProceso', 'id_tipo_proceso'),
            'estado0' => array(self::BELONGS_TO, 'Estado', 'estado'),
            'solicituds' => array(self::HAS_MANY, 'Solicitud', 'id_periodo'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_periodo' => 'Id Periodo',
            'id_tipo_proceso' => 'Id Tipo Proceso',
            'fecha_apertura' => 'Fecha de Apertura',
            'fecha_cierre' => 'Fecha de Cierre',
            'fecha_creacion' => 'Fecha de Creacion',
            'estado' => 'Estado',
            'campus' => 'Campus',
            'titulo' => 'Título',
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
        $criteria->compare('id_periodo', $this->id_periodo);
        $criteria->compare('id_tipo_proceso', $this->id_tipo_proceso);
        $criteria->compare('fecha_apertura', $this->fecha_apertura, true);
        $criteria->compare('fecha_cierre', $this->fecha_cierre, true);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('estado', $this->estado);
        $criteria->compare('campus', $this->campus);
        $criteria->compare('titulo', $this->titulo, true);
        $criteria->addCondition('campus=' . Yii::app()->user->getState('campus'));
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function afterFind() {
        // convert to display format
        $this->fecha_creacion = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_creacion));
        $this->fecha_apertura = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_apertura));
        $this->fecha_cierre = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_cierre));
        parent::afterFind();
    }

    public function validacionDeFechas($attribute, $params = null) {
        $inicio = CDateTimeParser::parse($this->fecha_apertura, "dd/MM/yyyy HH:mm");
        $fin = CDateTimeParser::parse($this->fecha_cierre, "dd/MM/yyyy HH:mm");
        if ($inicio != NULL && $fin != NULL) {
            if ($inicio >= $fin) {
                $this->addError('fecha_apertura', 'La fecha no corresponde');
                $this->addError('fecha_cierre', 'La fecha no corresponde');
            }
        }
    }

    public static function obtienePeriodoActual() {
        return Periodo::model()->find('NOW() between fecha_apertura and fecha_cierre and campus=' . Yii::app()->user->getState('campus') . ' and estado=' . Estado::$PERIODO_ACTIVO);
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->fecha_creacion = new CDbExpression('NOW()');
            $this->campus = Yii::app()->user->getState('campus');
            $this->estado = Estado::$PERIODO_EN_ESPERA;
            $this->id_tipo_proceso = 1;
        } else {
            $newDate = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_creacion);
            if ($newDate != null)
                $this->fecha_creacion = $newDate->format('Y-m-d H:i:s');
        }
        $newDate2 = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_apertura);
        if ($newDate2 != null)
            $this->fecha_apertura = $newDate2->format('Y-m-d H:i:s');
        $newDate3 = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_cierre);
        if ($newDate3 != null)
            $this->fecha_cierre = $newDate3->format('Y-m-d H:i:s');
        return parent::beforeSave();
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

}