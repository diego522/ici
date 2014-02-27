<?php

/**
 * This is the model class for table "horario".
 *
 * The followings are the available columns in table 'horario':
 * @property integer $id_horario
 * @property string $id_nivel
 * @property string $id_ramo
 * @property string $id_dia
 * @property string $id_bloque
 * @property integer $id_usuario
 * @property string $fecha_actualizacion
 * @property string $fecha_creacion
 * @property integer $campus
 * @property string $sala
 * @property string $descripcion
 */
class Horario extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Horario the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'horario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_nivel, id_ramo, id_dia, id_bloque, id_usuario, campus ', 'required'),
            array('id_usuario, campus', 'numerical', 'integerOnly' => true),
            array('id_nivel, id_dia, id_bloque', 'length', 'max' => 10),
            array('id_ramo', 'length', 'max' => 200),
            array('sala, descripcion', 'length', 'max' => 2000),
            array('fecha_creacion', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_horario, id_nivel, id_ramo, id_dia, id_bloque, id_usuario, fecha_actualizacion, fecha_creacion, campus, sala, descripcion', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_horario' => 'Id Horario',
            'id_nivel' => 'Id Nivel',
            'id_ramo' => 'Ramo',
            'id_dia' => 'Id Dia',
            'id_bloque' => 'Id Bloque',
            'id_usuario' => 'Id Usuario',
            'fecha_actualizacion' => 'Fecha de Actualización',
            'fecha_creacion' => 'Fecha Creacion',
            'campus' => 'Campus',
            'sala' => 'Sala',
            'descripcion' => 'Descripción',
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

        $criteria->compare('id_horario', $this->id_horario);
        $criteria->compare('id_nivel', $this->id_nivel, true);
        $criteria->compare('id_ramo', $this->id_ramo, true);
        $criteria->compare('id_dia', $this->id_dia, true);
        $criteria->compare('id_bloque', $this->id_bloque, true);
        $criteria->compare('id_usuario', $this->id_usuario);
        $criteria->compare('fecha_actualizacion', $this->fecha_actualizacion, true);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        
        $criteria->compare('sala', $this->sala, true);
        $criteria->compare('descripcion', $this->descripcion, true);
        
        

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave() {
        $newDate1 = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_actualizacion);
        if ($newDate1 != null)
            $this->fecha_actualizacion = $newDate1->format('Y-m-d H:i:s');
//        else
        $this->fecha_actualizacion = NULL;
        return parent::beforeSave();
    }

    protected function afterFind() {
        // convert to display format
        $this->fecha_actualizacion != NULL ? $this->fecha_actualizacion = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_actualizacion)) : '';
        parent::afterFind();
    }

}