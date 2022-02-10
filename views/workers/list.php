<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

use yii\grid\GridView;
use yii\data\ActiveDataProvider;

echo Html::beginForm(Yii::$app->request->url, 'POST');
echo Html::dropDownList(
	'status',
	null,
	array(
		'1' => 1,
		'0' => 0,
		'*' => '*'
	),
	['class' => 'form-control']
);
echo Html::submitButton('Apply filter', ['class' => 'btn btn-primary mt-2']);
echo Html::endForm();

$dataProvider = new ActiveDataProvider([
	                                       'query' => $query,
	                                       'pagination' => [
		                                       'pageSize' => 5,
	                                       ],
                                       ]);


echo Html::beginForm(['workers/delete'], 'POST');
echo GridView::widget([
	                      'dataProvider' => $dataProvider,
	                      'columns' => array(
		                      'id',
		                      'firstname',
		                      'lastname',
		                      'phone',
		                      'post',
		                      'status',
		                      'wages',
							  [
								  'class' => 'yii\grid\ActionColumn'
							  ]
	                      )
                      ]);

echo Html::endForm();