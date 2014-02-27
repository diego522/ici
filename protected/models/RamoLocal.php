<?php

/**
 * This is the model class for table "ramo_local".
 *
 * The followings are the available columns in table 'ramo_local':
 * @property integer $id_ramo
 * @property string $agn_nombre
 * @property integer $campus
 */
class RamoLocal extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return RamoLocal the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ramo_local';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('agn_nombre', 'required'),
            array('agn_nombre', 'length', 'max' => 200),
            array('campus', 'safe',),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_ramo, agn_nombre', 'safe', 'on' => 'search'),
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
            'id_ramo' => 'Id Ramo',
            'agn_nombre' => 'Nombre del electivo',
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

        $criteria->compare('id_ramo', $this->id_ramo);
        $criteria->compare('agn_nombre', $this->agn_nombre, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->campus = Yii::app()->user->getState('campus');
        }

        return parent::beforeSave();
    }

}