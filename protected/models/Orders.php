<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property string $id
 * @property string $user_id
 * @property string $car_id
 * @property string $operator_id
 * @property string $date
 * @property string $time
 * @property string $comment
 * @property string $created
 */
class Orders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{orders}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, car_id, date', 'required'),
			array('user_id, car_id', 'length', 'max'=>20),
			array('time', 'length', 'max'=>2),
			array('comment', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
		    array('operator_id', 'default', 'value' => 1, 'on' => 'insert,update'),
		    array('created', 'default', 'value' => new CDbExpression('NOW()'), 'on' => 'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, car_id, date, time, comment, created,operator_id', 'safe', 'on'=>'search'),
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
				'applicant' => array(self::BELONGS_TO, 'Customer', 'user_id'),
				'operator' => array(self::BELONGS_TO, 'User', 'operator_id'),
 				'licenseNumber' => array(self::BELONGS_TO, 'Cars', 'car_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '车主',
			'car_id' => '车',
			'date' => '接车日期',
			'time' => '接车时间',
			'comment' => '备注',
			'status' => '预约状态',
			'created' => '创建时间',
		    'operator_id'=>'接车员',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('car_id',$this->car_id,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('operator_id',$this->operator_id,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getStatusName($status = null)
	{
		$array = array('pending'=>'未分配','accepted'=>'已分配', 'finished'=>'已完成', 'expired'=>'已过期');
		return $array[$status];
	}
	
	/*获取接线员的名字*/
	public static function getOperatorName(){
	    return CHtml::listData( User::model()->findAll('type="operator" OR id=1'), 'id', 'name' );
	}
}
