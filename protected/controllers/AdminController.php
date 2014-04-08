<?php

class AdminController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
//            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    public function accessRules()
    {
        switch(Yii::app()->session['leveluser']){
            case 'admin':
                return array(
                    array('allow',
                        'actions'=>array(''),
                        'users'=>array('*'),
                    ),
                    array('allow',
                        'actions'=>array('index','home','kategori','verifikasi','hapusiklan'),
                        'users'=>array('@'),
                    ),
                    array('deny',
                        'users'=>array('*'),
                    ),
                );
            break;
            case 'guest':
                return array(
                    array('allow',
                        'actions'=>array(''),
                        'users'=>array('*'),
                    ),
                    array('allow',
                        'actions'=>array('kategori'),
                        'users'=>array('@'),
                    ),
                    array('deny',
                        'users'=>array('*'),
                    ),
                );
            break;
            default:
                return array(
                    array('allow',
                        'actions'=>array('index','loginadmin'),
                        'users'=>array('*'),
                    ),
                    array('deny',
                        'users'=>array('*'),
                    ),
                );
            break;
        }
    }

    public function actionLoginadmin()
    {
        $this->redirect('/site/login');
    }

    public function actionIndex()
    {
        if(Yii::app()->session['leveluser']==='admin')
            $this->actionHome();
        else
            $this->redirect('/site/login');
    }

	public function actionHome()
	{
        $data['model'] = new Admin();
        $data['dataiklan'] = $data['model']->getalldataiklan();
		$this->render('index',$data);
	}

    public function actionVerifikasi()
    {
        $model = new Admin();
        $id_iklan = $_POST['id_iklan'];
        if($id_iklan!==''){
            $verifikasi=$model->verifikasi($id_iklan);
            if ($verifikasi){
                Yii::app()->user->setFlash('success','Verifikasi Berhasil!!!');
            }
        }
    }

    public function actionHapusiklan()
    {
        $model = new Admin();
        $id_iklan = $_POST['id_iklan'];
        if($id_iklan!==''){
            $file = Yii::app()->db->createCommand("select url from foto where id_iklan = '$id_iklan'")->queryScalar();
//            $foto=fopen(Yii::app()->basePath.'/..'.$file,'w');
            unlink(Yii::app()->basePath.'/..'.$file);
            $hapus=$model->hapusiklan($id_iklan);
//            if ($hapus){
//                Yii::app()->user->setFlash('success','Hapus Data Berhasil!!!');
//            }
        }
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}