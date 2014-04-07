<?php

/**
 * This is the model class for table "tbl_kategori".
 *
 * The followings are the available columns in table 'tbl_kategori':
 * @property string $idkategori
 * @property string $kdkategori
 * @property string $kategori
 */
class Kategori extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Kategori the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_kategori';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idkategori, kdkategori, kategori', 'required'),
			array('idkategori, kdkategori', 'length', 'max'=>36),
			array('kategori', 'length', 'max'=>35),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idkategori, kdkategori, kategori', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idkategori' => 'Idkategori',
			'kdkategori' => 'Kdkategori',
			'kategori' => 'Kategori',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idkategori',$this->idkategori,true);
		$criteria->compare('kdkategori',$this->kdkategori,true);
		$criteria->compare('kategori',$this->kategori,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}