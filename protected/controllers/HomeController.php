<?php

class HomeController extends Controller
{
//    public $layout='//layouts/column2';

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
//            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index','filter','detail','pasangiklan','getkota','rules','about'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array(''),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
	{
        $data['model'] = new Iklan();
        $data['sorting'] = $data['model']->sorting();
        $data['sort'] = isset($_GET['sort']) ? $_GET['sort'] : '';
        $data['iklan'] = $data['model']->getdaftariklan($data['sort']);
		$this->render('home',$data);
	}

    public function actionFilter()
    {
        $this->render('filter');
    }

    public function actionDetail()
    {
        if(isset($_POST['id_iklan']))
            Yii::app()->user->setState('id_iklan',$_POST['id_iklan']);
        $iklan = Yii::app()->user->getState('id_iklan');
        $data['model'] = new Iklan();
        $data['dataiklan'] = $data['model']->getdataiklan($iklan);

        $this->render('detail',$data);
    }

    public function actionPasangiklan()
    {
        $model = new Iklan();
        $ddlpropinsi = $model->getpropinsi();
        $ddliklan = $model->gettipeiklan();

        if(isset($_POST['kode_propinsi']))
            $kode_propinsi = $_POST['kode_propinsi'];
        else
            $kode_propinsi = $model->gettoppropinsi();
        $ddlkota = $model->getkota($kode_propinsi);

        if(isset($_POST['Iklan'])){
            $model->attributes = $_POST['Iklan'];
            $uuid = Yii::app()->db->createCommand("SELECT uuid()")->queryScalar();
            $upload=CUploadedFile::getInstance($model,'gambar');
            $filename = "{$upload}";
            $imgname=trim($uuid).'.'.trim(end(explode('.',$filename)));
            $model->gambar = $filename;
            $path = '/images/upload/'.$imgname;

            if($model->validate()){
                $tgl = date('Y-m-d');
                $upload->saveAs(Yii::app()->basePath.'/../images/upload/'.$imgname);

                chmod(Yii::app()->basePath.'/../images/upload/'.$imgname,0755);

                $insert = Yii::app()->db->createCommand("insert into iklan values (
                    '$uuid',
                    '$model->id_tipe_iklan',
                    '$model->kode_kota',
                    '$model->alamat',
                    '$model->luas',
                    '$model->harga',
                    '$model->deskripsi',
                    '$model->nama',
                    '$model->Email',
                    '$model->telp',
                    '$model->pinBB',
                    '0',
                    '$tgl');
                ")->execute();

                Yii::app()->db->createCommand("insert into foto values((uuid()),'$uuid','$path')")->execute();

                if($insert)
                    Yii::app()->user->setFlash('success','
                        Insert Data Sukses! Silahkan hubungi Admin untuk Verifikasi<br>
                        Contact Detail:
                        <br>
                        Phone : 081335121611
                        <br>
                        Email : info@jualtanahdanrumah.com
                        '
                    );
//                    echo "<script>alert('insert data sukses. silahkan')</script>";
//                $this->redirect('/home');
            }
            else{
                echo "salah";
            }
        }

        $this->render('iklan',array(
            'model'=>$model,
            'ddliklan'=>$ddliklan,
            'ddlpropinsi'=>$ddlpropinsi,
            'ddlkota'=>$ddlkota,
        ));
    }

    public function actionRules()
    {
        $this->render('rules');
    }

    public function actionAbout()
    {
        $this->render('about');
    }

    public function actionGetkota()
    {
        $model = new Iklan();
        $kode_propinsi = $_POST['kode_propinsi'];
//        $ddlkota = $model->getkota($kode_propinsi);

        echo CHtml::dropDownList('Iklan[kode_kota]','',$model->getkota($kode_propinsi));
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
    */
	/*
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