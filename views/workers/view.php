<?php

/**
 * @var Workers $model;
 */

use app\models\Workers;
use yii\helpers\Html;

echo Html::beginTag('div', ['class' => 'd-flex flex-column']);
echo Html::tag('span', sprintf("Firstname: %s", $model->firstname));
echo Html::tag('span', sprintf("Lastname: %s", $model->lastname));
echo Html::tag('span', sprintf("Phone: %s", $model->phone));
echo Html::tag('span', sprintf("Post: %s", $model->post));
echo Html::tag('span', sprintf("Status: %s", (($model->status == 0) ? 'Inactive' : 'Active')));
echo Html::tag('span', sprintf("Wages: %s", $model->wages));
echo Html::endTag('div');