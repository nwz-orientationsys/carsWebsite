<?php/** * This is the model class for table "{{users}}". * * The followings are the available columns in table '{{users}}': * @property string $id * @property string $phone * @property string $email * @property string $name * @property string $password * @property string $type * @property string $created */class User extends CActiveRecord {    /**     * @return string the associated database table name     */    public $password1;    public $password2;    public function tableName() {        return '{{users}}';    }    /**     * @return array validation rules for model attributes.     */    public function rules() {        // NOTE: you should only define rules for those attributes that        // will receive user inputs.        return array(            array('phone, type', 'required'),            array('phone', 'unique'),            array('phone', 'length', 'max' => 11),            array('email', 'length', 'max' => 100),            array('name', 'length', 'max' => 50),            array('password', 'required', 'on' => 'insert'),            array('email', 'email'),            array('phone', 'match', 'pattern' => '/^1[358]\d{9}$/'),            array('password2', 'compare', 'compareAttribute' => 'password1', 'on' => 'passwordupdate'),            array('password2, password1, password', 'required', 'on' => 'passwordupdate'),            array('password', 'check_db_password', 'on' => 'passwordupdate'),            array('name', 'required', 'on'=>'insert, update'),            array('created', 'default', 'value' => new CDbExpression('NOW()'), 'on' => 'insert'),            array('id, name, password, email, phone, created, type', 'safe'),            // The following rule is used by search().            // @todo Please remove those attributes that should not be searched.            array('id, name, email, phone, created, type', 'safe', 'on' => 'search'),        );    }    public function check_db_password($attribute, $params) {        $user = User::model()->findByPk($this->id);        if ($user->password != $this->$attribute) {            $this->addError($attribute, '原密码输入错误！');        }    }    protected function beforeSave() {        if ($this->scenario == 'passwordupdate') {            $this->password = md5($this->password1);        } else {            $this->password = md5($this->password);        }        return parent::beforeSave();    }    /**     * @return array relational rules.     */    public function relations() {        // NOTE: you may need to adjust the relation name and the related        // class name for the relations automatically generated below.        return array(            'cars' => array(self::HAS_MANY, 'Cars', 'owner_id'),        );    }    /**     * @return array customized attribute labels (name=>label)     */    public function attributeLabels() {        return array(            'id' => 'ID',            'name' => '名字',            'email' => '邮箱',            'phone' => '手机',            'password' => '密码',            'password1' => '新密码',            'password2' => '确认密码',            'created' => 'Create Time',            'type' => '用户类型'        );    }    /**     * Retrieves a list of models based on the current search/filter conditions.     *     * Typical usecase:     * - Initialize the model fields with values from filter form.     * - Execute this method to get CActiveDataProvider instance which will filter     * models according to data in model fields.     * - Pass data provider to CGridView, CListView or any similar widget.     *     * @return CActiveDataProvider the data provider that can return the models     * based on the search/filter conditions.     */    public function search() {        // @todo Please modify the following code to remove attributes that should not be searched.        $criteria = new CDbCriteria;        $criteria->compare('id', $this->id, true);        $criteria->compare('phone', $this->phone, true);        $criteria->compare('name', $this->name, true);        $criteria->compare('email', $this->email, true);        $criteria->compare('password', $this->password, true);        $criteria->compare('type', $this->type, true);        $criteria->compare('created', $this->created);        return new CActiveDataProvider($this, array(            'criteria' => $criteria,        ));    }    /**     * Returns the static model of the specified AR class.     * Please note that you should have this exact method in all your CActiveRecord descendants!     * @param string $className active record class name.     * @return User the static model class     */    public static function model($className = __CLASS__) {        return parent::model($className);    }}