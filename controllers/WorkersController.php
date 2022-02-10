<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Workers;

class WorkersController extends Controller {
	public function actionAdd() {
		$model = new Workers();
		if (Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post());
			if ($model->validate() && $model->save()) {
				Yii::$app->session->setFlash('message', 'Employee successfully added.');
			}
			return $this->refresh();
		} else {
			return $this->render('add', [
				'model' => $model,
			]);
		}
	}

	public function actionList() {
		$query = Workers::find();
		$status = Yii::$app->request->post('status');
		if (!is_null($status)) {
			$filters['status'] = $status;
		}
		if (!empty($filters)) {
			Yii::$app->session->set('filters', json_encode($filters));
		}

		$filters = json_decode(Yii::$app->session->get('filters'));
		if (isset($filters->status) && $filters->status !== '*') {
			$query->where(['status' => $filters->status]);
		}


		return $this->render('list', [
			'query' => $query,
			'status' => $filters
		]);
	}

	public function actionDelete() {
		$id = Yii::$app->request->get('id');
		Workers::deleteAll(['id' => $id]);
		return $this->redirect(['workers/list']);
	}

	public function actionUpdate() {
		$id = Yii::$app->request->get('id');
		$model = Workers::findOne($id);
		if (Yii::$app->request->isPost) {
			$data = Yii::$app->request->post('Workers');
			$model->lastname = $data['lastname'];
			$model->firstname = $data['firstname'];
			$model->phone = $data['phone'];
			$model->wages = $data['wages'];
			$model->post = $data['post'];
			$model->status = $data['status'];
			if ($model->validate()) {
				$model->save();
			}
			$this->redirect(['workers/list']);
		} else {
			return $this->render('update', ['model' => $model]);
		}
	}

	public function actionView() {
		$id = Yii::$app->request->get('id');
		$model = Workers::findOne($id);
		return $this->render('view', ['model' => $model]);
	}

	public function actionReport() {
		$model = Workers::find()->where(['status' => 1]);
		$report = '';
		$taxSumAll = 0;
		$wagesSumAll = 0;
		$wagesSumWithTaxAll = 0;
		foreach ($model->all() as $worker) {
			$tax = ($worker->wages < 10000) ? 0.1 : (($worker > 25000) ? '0.25' : 0.15);
			$taxSum = $worker->wages * $tax;
			$taxSumAll += $taxSum;
			$wagesSumWithTax = $worker->wages - $taxSum;
			$wagesSumAll += $worker->wages;
			$wagesSumWithTaxAll += $wagesSumWithTax;
			$report .= sprintf("%s %s, %g, %g, %g\r\n", $worker->firstname, $worker->lastname, $worker->wages, $taxSum, $wagesSumWithTax);
		}
		$report .= sprintf("%s %g, %g, %g\r\n", 'Total: ', $wagesSumAll, $taxSumAll, $wagesSumWithTaxAll);
		$filename = md5(microtime()) . '.txt';
		$path = Yii::$app->runtimePath . '\\tmp\\' . $filename;
		touch($path);
		file_put_contents($path, $report);
		Yii::$app->response->sendFile($path)->send();
		unlink($path);
	}
}