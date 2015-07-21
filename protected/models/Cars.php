<?php

/**
 * This is the model class for table "cars".
 *
 * The followings are the available columns in table 'cars':
 * @property string $id
 * @property string $licenseNumber
 * @property string $ower_id
 * @property string $type_id
 */
class Cars extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cars';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('licenseNumber, ower_id, type_id', 'required'),
			array('licenseNumber, ower_id, type_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, licenseNumber, ower_id, type_id', 'safe', 'on'=>'search'),
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
				'type'=>array(self::BELONGS_TO, 'CarTypes', 'type_id'),
				'isOrdered'=>array(self::HAS_MANY, 'Orders', 'car_id', 'on'=>'isOrdered.status = "pending" OR isOrdered.status="accepted"'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'licenseNumber' => '牌照',
			'ower_id' => '车主',
			'type_id' => '汽车类别',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('licenseNumber',$this->licenseNumber,true);
		$criteria->compare('ower_id',$this->ower_id,true);
		$criteria->compare('type_id',$this->type_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cars the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/*check the car_id is ordered or not*/
	public static function checkOrdered($userId){
        //取出预约过的车的id
	    $info = Cars::model()->findAllBySql('select cars.licenseNumber from cars LEFT JOIN orders on cars.id = orders.car_id WHERE cars.ower_id = '.$userId 
            .' AND cars.id not in (select cars.id from cars LEFT JOIN orders on cars.id = orders.car_id 
            WHERE cars.ower_id = '. $userId .' AND orders.`status` in ("pending","accepted"))');
	    
        $listData = array();
	    foreach($info as $row){
	        $listData[] = $row->licenseNumber;
	    }
	    
	    return  $listData ;
	}
	
	
	
	/*根据ower_id查询车牌号*/
	public static function getCustomerCars($id=''){
		return CHtml::listData( Cars::model()->findAll($id ? 'ower_id='.$id : ''), 'id', 'licenseNumber' );
	}
	
	
	
	
	public static function getCustomerCar($id){
        
		return CHtml::listData( Cars::model()->findByPk($id), 'id', 'licenseNumber' );
	}
	
}
