<?php

namespace app\controllers;

use yii\web\Controller;

class FirstController extends Controller{

	public function actionIndex(){
		return $this->render('index');
	}

	public function actionParams(){
		$a = 'Send params';
		$c = [5,9,7,3];
		return $this->render('params',['sendA'=> $a, 'sendB' => 10, 'sendC' => $c]);
	}

	public function actionPartial(){
		
		return $this->renderPartial('partial',['a' => 55, 'b' => 23]);
	}
}