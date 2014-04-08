<?php
    /**
 * Created by PhpStorm.
 * User: root
 * Date: 3/26/14
 * Time: 9:54 PM
 */

?>
<?php if(Yii::app()->user->hasFlash('success')): ?>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
        'options'=>array(
            'title'=>'sukses',
            'autoOpen'=>true,
            'modal'=>true,
            'position'=>'center',
            'width'=>'auto',
            'height'=>'auto',
            'closeOnEscape'=>false,
            'close'=>'js:function(){
                $(this).dialog("close");
                window.location="/home";
            }'
        ),
    ));
    echo Yii::app()->user->getFlash('success');
    $this->endWidget();
    ?>
<?php endif; ?>
    <style>
        .required{
            color: #FF0000;
        }
        .contoh{
            font: Consolas italic;
            font-size: 10px;
        }
    </style>
<h1>Pasang Iklan</h1>
<blockquote>tanda <span class="required">*</span> harus diisi</blockquote>
<?php
$form=$this->beginWidget('CActiveForm', array(
        'id'=>'frm-pasangiklan',
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>true,
            'afterValidate'=>'js:function(form,data,hasError){
                if(!hasError){
                    alert("sukses");
                }
                else
                {
                    alert("gagal");
                }
            }',
        ),
    )
);
?>
<table>
    <tr>
        <td colspan="2">
            <div style="font-size: small; color:white; padding-left: 5%; padding-right: 5%; background-color:#C43C35 ; -webkit-border-radius: 8px 8px 8px 8px; width: 75%;">
                <?php echo $form->errorSummary($model); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td>Nama <span class="required">*</span></td>
        <td><?php echo $form->textField($model,'nama',array('placeholder'=>'Masukkan Nama Anda')); ?></td>
    </tr>
    <tr>
        <td>Tipe</td>
        <td><?php echo $form->dropDownList($model,'id_tipe_iklan',$ddliklan); ?></td>
    </tr>
    <tr>
        <td>Propinsi</td>
        <td>
            <?php echo $form->dropDownList($model,'kode_propinsi',$ddlpropinsi,array(
                "onchange"=>"
                    var kode_propinsi = $(this).val();
                    $.ajax({
                        type:'post',
                        url:'/home/getkota',
                        data:{kode_propinsi:kode_propinsi},
                        success:function(msg){
                            document.getElementById('ddlkota').innerHTML = msg;
                        }
                    });
                ",
            ));
            ?>
        </td>
    </tr>
    <tr>
        <td>Kota</td>
        <td>
            <div id="ddlkota">
                <?php
                echo $form->dropDownList($model,'kode_kota',$ddlkota,array(
//                    'prompt'=>'-- Pilh Kota --',

                ));
                ?>
            </div>
        </td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td><?php echo $form->textArea($model,'alamat',array('cols'=>40,'rows'=>5)) ?></td>
    </tr>
    <tr>
        <td>Luas</td>
        <td><?php echo $form->textField($model,'luas',array('placeholder'=>'--- x ---')) ?> <code class="contoh">contoh: 100 x 200</code></td></td>
    </tr>
    <tr>
        <td>Harga <span class="required">*</span></td>
        <td><?php echo $form->textField($model,'harga',array('')) ?></td>
    </tr>
    <tr>
        <td>Telp / HP <span class="required">*</span></td>
        <td><?php echo $form->textField($model,'telp',array('')) ?></td>
    </tr>
    <tr>
        <td>Pin BB</td>
        <td><?php echo $form->textField($model,'pinBB',array('')) ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $form->textField($model,'Email',array('')) ?></td>
    </tr>
    <tr>
        <td>Deskripsi</td>
        <td><?php echo $form->textArea($model,'deskripsi',array('cols'=>50,'rows'=>5)) ?></td>
    </tr>
    <tr>
        <td>Gambar</td>
        <td><?php echo $form->fileField($model,'gambar') ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center">
            <?php
            $this->widget('bootstrap.widgets.TbButton',array(
                'type'=>'primary',
                'buttonType'=>'submit',
                'label'=>'Simpan',
            ));
            ?>
        </td>
    </tr>
</table>
<?php
$this->endWidget();