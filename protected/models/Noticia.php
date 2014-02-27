<?php

/**
 * This is the model class for table "noticia".
 *
 * The followings are the available columns in table 'noticia':
 * @property integer $id_noticia
 * @property string $titulo
 * @property string $contenido
 * @property integer $creador
 * @property string $fecha_actualizacion
 * @property string $fecha_creacion
 * @property integer $estado
 * @property integer $campus
 * @property integer $prioridad
 * @property string $fecha_publicacion
 * @property integer $imagen_portada
 * @property integer $id_categoria
 *
 * The followings are the available model relations:
 * @property CategoriaNoticia $idCategoria
 * @property Usuario $creador0
 * @property Estado $estado0
 */
class Noticia extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Noticia the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'noticia';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('titulo, contenido, estado, id_categoria', 'required'),
            array('creador, estado, campus, prioridad, imagen_portada, id_categoria', 'numerical', 'integerOnly' => true),
            array('titulo', 'length', 'max' => 2000),
            array('fecha_creacion, fecha_publicacion', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_noticia, titulo, contenido, creador, fecha_actualizacion, fecha_creacion, estado, campus, prioridad, fecha_publicacion, imagen_portada, id_categoria', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idCategoria' => array(self::BELONGS_TO, 'CategoriaNoticia', 'id_categoria'),
            'creador0' => array(self::BELONGS_TO, 'Usuario', 'creador'),
            'estado0' => array(self::BELONGS_TO, 'Estado', 'estado'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_noticia' => 'Id Noticia',
            'titulo' => 'Título',
            'contenido' => 'Contenido',
            'creador' => 'Creador',
            'id_categoria' => 'Categoría',
            'imagen_portada' => 'Imágen de la Portada',
            'fecha_actualizacion' => 'Fecha de última actualización',
            'fecha_creacion' => 'Fecha de Creación',
            'estado' => 'Estado',
            'campus' => 'Campus',
            'prioridad' => 'Prioridad',
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

        $criteria->compare('id_noticia', $this->id_noticia);
        $criteria->compare('titulo', $this->titulo, true);
        $criteria->compare('contenido', $this->contenido, true);
        $criteria->compare('creador', $this->creador);
        $criteria->compare('fecha_actualizacion', $this->fecha_actualizacion, true);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('estado', $this->estado);
        $criteria->compare('campus', $this->campus);
        $criteria->compare('prioridad', $this->prioridad);
        $criteria->order = 'id_noticia DESC';
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

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->creador = Yii::app()->user->id;
            $this->fecha_creacion = new CDbExpression('NOW()');
        } else {
            $newDate = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_creacion);
            if ($newDate != null)
                $this->fecha_creacion = $newDate->format('Y-m-d H:i:s');
            $this->fecha_actualizacion = new CDbExpression('NOW()');
        }
        //$this->modified = new CDbExpression('NOW()');
        return parent::beforeSave();
    }

    protected function afterFind() {
        // convert to display format
        $this->fecha_creacion != NULL ? $this->fecha_creacion = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_creacion)) : '';
        $this->fecha_actualizacion != NULL ? $this->fecha_actualizacion = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_actualizacion)) : '';
        parent::afterFind();
    }

}