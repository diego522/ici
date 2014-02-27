<?php

/**
 * This is the model class for table "parametros_generales".
 *
 * The followings are the available columns in table 'parametros_generales':
 * @property integer $id_parametros_generales
 * @property integer $campus
 * @property string $correo_jefe_carrera
 * @property string $nombre_jefe_carrera
 * @property string $correo_director_departamento
 * @property string $nombre_director_departamento
 * @property string $correo_secretaria
 */
class ParametrosGenerales extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ParametrosGenerales the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'parametros_generales';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('correo_jefe_carrera, nombre_jefe_carrera, correo_director_departamento, nombre_director_departamento, correo_secretaria', 'required'),
            array('campus', 'numerical', 'integerOnly' => true),
            array('correo_jefe_carrera, nombre_jefe_carrera, correo_director_departamento, nombre_director_departamento, correo_secretaria', 'length', 'max' => 2000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_parametros_generales, campus, correo_jefe_carrera, nombre_jefe_carrera, correo_director_departamento, nombre_director_departamento, correo_secretaria', 'safe', 'on' => 'search'),
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
            'id_parametros_generales' => 'Id Parametros Generales',
            'campus' => 'Campus',
            'correo_jefe_carrera' => 'Correo Jefe de Carrera/Director(a) de Escuela',
            'nombre_jefe_carrera' => 'Nombre Jefe de Carrera/Director(a) de Escuela',
            'correo_director_departamento' => 'Correo Director(a) de Departamento',
            'nombre_director_departamento' => 'Nombre Director(a) de Departamento',
            'correo_secretaria' => 'Correo Secretaria',
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

        $criteria->compare('id_parametros_generales', $this->id_parametros_generales);
        $criteria->compare('campus', $this->campus);
        $criteria->compare('correo_jefe_carrera', $this->correo_jefe_carrera, true);
        $criteria->compare('nombre_jefe_carrera', $this->nombre_jefe_carrera, true);
        $criteria->compare('correo_director_departamento', $this->correo_director_departamento, true);
        $criteria->compare('nombre_director_departamento', $this->nombre_director_departamento, true);
        $criteria->compare('correo_secretaria', $this->correo_secretaria, true);
        if (!Yii::app()->user->checkeaAccesoMasivo(array(Rol::$SUPER_USUARIO))) {
            $criteria->addCondition("campus=" . Yii::app()->user->getState('campus'));
        }
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}