<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/26/14
 * Time: 10:03 PM
 */

class Iklan extends CFormModel
{
    public $id_tipe_iklan;
    public $kode_propinsi;
    public $kode_kota;
    public $nama;
    public $alamat;
    public $luas;
    public $harga;
    public $deskripsi;
    public $Email;
    public $telp;
    public $pinBB;
    public $status;
    public $tgl_upload;
    public $gambar;

    public function rules()
    {
        return array(
            array('kode_kota, harga, nama, telp', 'required','message'=>'{attribute} tidak boleh kosong'),
            array('id_tipe_iklan','length','max'=>1),
            array('alamat,luas,deskripsi','length','max'=>250),
            array('pinBB','length','max'=>8),
            array('gambar', 'file','types'=>'jpg,jpeg,JPG,JPEG'),
            array('Email','email','message'=>'{attribute} Tidak Valid!!!'),
            array('telp','length','max'=>14),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id_tipe_iklan'=>'Tipe Iklan',
            'kode_propinsi'=>'Propinsi',
            'kode_kota'=>'Kota',
            'nama'=>'Nama',
            'alamat'=>'Alamat',
            'luas'=>'Luas',
            'harga'=>'Harga',
            'deskripsi'=>'Deskripsi',
            'Email'=>'Alamat Email',
            'telp'=>'Telepon atau HP',
            'pinBB'=>'Pin BB',
            'status'=>'Status',
            'tgl_upload'=>'Tanggal Upload',
            'gambar'=>'Gambar',
        );
    }

    public function getpropinsi()
    {
        $cmd = Yii::app()->db->createCommand("select * from propinsi order by propinsi asc ")->queryAll();
        $data = CHtml::listData($cmd,'kode_propinsi','propinsi');
        return $data;
    }

    public function gettoppropinsi()
    {
        $cmd = Yii::app()->db->createCommand("select kode_propinsi from propinsi order by propinsi asc limit 1")->queryScalar();
        return $cmd;
    }

    public function getkota($kode_propinsi)
    {
        $cmd = Yii::app()->db->createCommand("select * from kota where kode_propinsi = '$kode_propinsi' order by kota asc ")->queryAll();
        $data = CHtml::listData($cmd,'kode_kota','kota');
        return $data;
    }

    public function gettipeiklan()
    {
        $cmd = Yii::app()->db->createCommand("select * from tipe_iklan order by tipe_iklan,id_tipe_iklan asc ")->queryAll();
        $data = CHtml::listData($cmd,'id_tipe_iklan','tipe_iklan');
        return $data;
    }

    public function getdataiklan($id_iklan)
    {
        $data = Yii::app()->db->createCommand("
            select
              t1.id_iklan
              ,t1.alamat
              ,t1.luas
              ,t1.harga
              ,t1.deskripsi
              ,t1.nama
              ,t1.Email
              ,t1.telp
              ,t1.pinBB
              ,t1.tgl_upload
              ,t2.tipe_iklan
              ,t3.id_foto
              ,t3.url
              ,t4.kota
              ,(case t1.status
                when 1 then 'verified'
                when 0 then 'unverified'
                end) as statusverifikasi
            from iklan t1
              left join tipe_iklan t2 on t2.id_tipe_iklan = t1.id_tipe_iklan
              left join foto t3 on t3.id_iklan = t1.id_iklan
              left join kota t4 on t4.kode_kota = t1.kode_kota
              where t1.id_iklan = '$id_iklan'
        ")->queryRow();
        return $data;
    }

    public function getdaftariklan($sort)
    {
        if ($sort !='')
            $sort = ' order by ' .$sort;

        $data = Yii::app()->db->createCommand("
            select
              t1.id_iklan
              ,t1.alamat
              ,t1.luas
              ,t1.harga
              ,t1.deskripsi
              ,t1.nama
              ,t1.Email
              ,t1.telp
              ,t1.pinBB
              ,t1.tgl_upload
              ,t2.tipe_iklan
              ,t3.id_foto
              ,t3.url
              ,t4.kota
              ,(case t1.status
                when 1 then 'verified'
                when 0 then 'unverified'
                end) as statusverifikasi
            from iklan t1
              left join tipe_iklan t2 on t2.id_tipe_iklan = t1.id_tipe_iklan
              left join foto t3 on t3.id_iklan = t1.id_iklan
              left join kota t4 on t4.kode_kota = t1.kode_kota
              where t1.status = 1 $sort
        ")->queryAll();
        return $data;
    }

    public function sorting()
    {
        $cmd = Yii::app()->db->createCommand("select * from filter order by id_filter ASC")->queryAll();
        $list = CHtml::listData($cmd,'kode_filter','filter');
        return $list;
    }
}