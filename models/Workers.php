<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Workers extends ActiveRecord {

	public static function tableName() {
		return 'workers';
	}

	public function rules()
	{
		return [
			[['firstname', 'lastname', 'phone', 'post', 'status', 'wages'], 'required'],
		];
	}

}