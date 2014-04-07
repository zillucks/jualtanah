<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/3/14
 * Time: 8:23 PM
 */
class Admin extends CFormModel
{
    public function getalldataiklan()
    {
        $sql = Yii::app()->db->createCommand("
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
              order by t1.tgl_upload desc
              ")->queryAll();
        return $sql;
    }

    public function verifikasi($id_iklan)
    {
        $sql = Yii::app()->db->createCommand("update iklan set status = 1 where id_iklan='$id_iklan'")->execute();
        return $sql;
    }

    public function hapusiklan($id_iklan)
    {
        $sql = Yii::app()->db->createCommand("call spHapusIklan('$id_iklan')")->execute();
        return $sql;
    }
}