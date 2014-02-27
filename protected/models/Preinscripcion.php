<?php

/**
 * This is the model class for table "preinscripcion".
 *
 * The followings are the available columns in table 'preinscripcion':
 * @property integer $id_preinscripcion
 * @property string $ramo
 * @property string $fecha_cierre
 * @property string $fecha_creacion
 * @property integer $creador
 * @property integer $cupos
 * @property string $descripcion
 * @property integer $campus
 * @property integer $estado
 * @property string $descripcion_prerrequisitos
 * @property integer $local
 * @property integer $adjunto
 * @property string $horario
 * @property string $docente
 * @property string $fecha_apertura
 *
 * The followings are the available model relations:
 * @property Usuario[] $usuarios
 * @property Estado $estado0
 * @property Adjunto $adjunto0
 */
class Preinscripcion extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Preinscripcion the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'preinscripcion';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ramo,fecha_cierre,cupos', 'required'),
            array('creador, cupos, campus, estado, local, adjunto', 'numerical', 'integerOnly' => true),
            array('ramo', 'length', 'max' => 11),
            array('docente', 'length', 'max' => 2000),
            array('fecha_cierre,creador,fecha_apertura,campus, fecha_creacion,descripcion, descripcion_prerrequisitos, horario', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_preinscripcion, ramo, fecha_cierre, fecha_creacion, creador, cupos, descripcion, campus, estado, descripcion_prerrequisitos, local, adjunto, horario, docente, fecha_apertura', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'usuarios' => array(self::MANY_MANY, 'Usuario', 'alumno_preinscripcion(id_preinscripcion, id_alumno)','order' => 'fecha_realizacion'),
            'estado0' => array(self::BELONGS_TO, 'Estado', 'estado'),
            'adjunto0' => array(self::BELONGS_TO, 'Adjunto', 'adjunto'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_preinscripcion' => 'Id Preinscripcion',
            'ramo' => 'Ramo',
            'fecha_cierre' => 'Fecha de Cierre',
            'fecha_creacion' => 'Fecha de Creación',
            'creador' => 'Creador',
            'cupos' => 'Cupos',
            'descripcion' => 'Descripción',
            'campus' => 'Campus',
            'estado' => 'Estado',
            'descripcion_prerrequisitos' => 'Prerrequisitos',
            'local' => 'Local',
            'adjunto' => 'Adjunto',
            'horario' => 'Horario',
            'docente' => 'Docente',
            'fecha_apertura' => 'Fecha de Apertura',
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

        $criteria->compare('id_preinscripcion', $this->id_preinscripcion);
        $criteria->compare('ramo', $this->ramo, true);
        $criteria->compare('fecha_cierre', $this->fecha_cierre, true);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('creador', $this->creador);
        $criteria->compare('cupos', $this->cupos);
        $criteria->compare('descripcion', $this->descripcion, true);
        $criteria->compare('campus', $this->campus);
        $criteria->compare('estado', $this->estado);
        $criteria->compare('descripcion_prerrequisitos', $this->descripcion_prerrequisitos, true);
        $criteria->compare('local', $this->local);
        $criteria->compare('adjunto', $this->adjunto);
        $criteria->compare('horario', $this->horario, true);
        $criteria->compare('docente', $this->docente, true);
        $criteria->compare('fecha_apertura', $this->fecha_apertura, true);
        $criteria->addCondition('campus=' . Yii::app()->user->getState('campus'));
        $criteria->order = 'fecha_creacion DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchDisponibles() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_preinscripcion', $this->id_preinscripcion);
        $criteria->compare('ramo', $this->ramo, true);
        $criteria->compare('fecha_cierre', $this->fecha_cierre, true);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('creador', $this->creador);
        $criteria->compare('cupos', $this->cupos);
        $criteria->compare('descripcion', $this->descripcion, true);
        $criteria->compare('campus', $this->campus);
        $criteria->compare('estado', $this->estado);
        $criteria->compare('descripcion_prerrequisitos', $this->descripcion_prerrequisitos, true);
        $criteria->compare('local', $this->local);
        $criteria->compare('adjunto', $this->adjunto);
        $criteria->compare('horario', $this->horario, true);
        $criteria->compare('docente', $this->docente, true);
        $criteria->compare('fecha_apertura', $this->fecha_apertura, true);
        $criteria->addCondition('campus=' . Yii::app()->user->getState('campus'));
        $criteria->addCondition('estado=' . Estado::$PREINSCRIPCON_ABIERTA);
        $criteria->addCondition('id_preinscripcion not in (select id_preinscripcion from alumno_preinscripcion where id_alumno=' . Yii::app()->user->id . ')');
        $criteria->order = 'fecha_creacion DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchMisInscripciones() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('id_preinscripcion', $this->id_preinscripcion);
//        //$criteria->compare('ramo', $this->actividad, true);
//        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
//        $criteria->compare('fecha_cierre', $this->fecha_cierre, true);
//        $criteria->compare('creador', $this->creador);
//        $criteria->compare('cupos', $this->cupos);
//        $criteria->compare('descripcion', $this->descripcion, true);
//        $criteria->compare('campus', $this->campus);
        // $criteria->compare('estado', $this->estado);
//        $criteria->compare('requisitos', $this->requisitos, true);
//        $criteria->compare('horario', $this->horario, true);
//        $criteria->compare('fecha_apertura', $this->fecha_apertura, true);
//        $criteria->compare('adjunto', $this->adjunto);
        $criteria->addCondition('id_preinscripcion in (select id_preinscripcion from alumno_preinscripcion where id_alumno=' . Yii::app()->user->id . ')');
        $criteria->order = 'fecha_apertura DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->fecha_creacion = new CDbExpression('NOW()');
            $this->creador = Yii::app()->user->id;
            $this->campus = Yii::app()->user->getState('campus');
            $this->estado = Estado::$PREINSCRIPCON_EN_ESPERA;
            if ($this->fecha_apertura == NULL)
                $this->fecha_apertura = new CDbExpression('NOW()');
        } else {
            $newDate = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_creacion);
            if ($newDate != null)
                $this->fecha_creacion = $newDate->format('Y-m-d H:i:s');
            else
                $this->fecha_creacion = NULL;
        }

        $newDate2 = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_apertura);
        if ($newDate2 != null)
            $this->fecha_apertura = $newDate2->format('Y-m-d H:i:s');
//        else
//            $this->fecha_apertura = NULL;


        $newDate1 = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_cierre);
        if ($newDate1 != null)
            $this->fecha_cierre = $newDate1->format('Y-m-d H:i:s');
//        else
//            $this->fecha_cierre = NULL;
        return parent::beforeSave();
    }

    protected function afterFind() {
        // convert to display format
        $this->fecha_creacion != NULL ? $this->fecha_creacion = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_creacion)) : '';
        $this->fecha_cierre != NULL ? $this->fecha_cierre = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_cierre)) : '';
        $this->fecha_apertura != NULL ? $this->fecha_apertura = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_apertura)) : '';
        parent::afterFind();
    }

}