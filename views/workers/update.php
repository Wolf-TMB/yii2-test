<?php

use app\models\Workers;

/**
 *  @var Workers $model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$message = Yii::$app->session->getFlash('message');
if ($message) {
	echo "
        <div class='alert alert-info'>
            $message
        </div>
    ";
}

$form = ActiveForm::begin(array(
	                          'id' => 'workers-add-form',
	                          'options' => ['class' => 'form-horizontal'],
                          )) ?>
<?= $form->field($model, 'firstname') ?>
<?= $form->field($model, 'lastname') ?>
<?= $form->field($model, 'phone') ?>
<?= $form->field($model, 'post') ?>
<?= $form->field($model, 'status')->dropdownList(
	array(
		'0' => 'Inactive',
		'1' => 'Active'
	),
	['prompt' => 'Select status']
) ?>
<?= $form->field($model, 'wages') ?>

	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
			<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
		</div>
	</div>
<?php ActiveForm::end() ?>