<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/26/14
 * Time: 8:40 PM
 */
Yii::app()->clientScript->registerScript('js-act',"
    //
",CClientScript::POS_READY);
?>
<div class="container">
    <table border="1" style="border: 1px solid #ccc">
        <tr>
            <td colspan="2" style="width: 80%">
                <?php echo CHtml::image($dataiklan['url'],'',array('style'=>'max-width:480px')); ?>
            </td>
            <td style="vertical-align: top;text-align: left">
                <table>
                    <tr>
                        <td>Tipe</td>
                        <td>:</td>
                        <td><?php echo $dataiklan['tipe_iklan'] ?></td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td><?php echo $dataiklan['kota'] ?></td>
                    </tr>
                    <tr>
                        <td>Luas</td>
                        <td>:</td>
                        <td><?php echo $dataiklan['luas'] ?></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td><?php echo $dataiklan['harga'] ?></td>
                    </tr>
                    <tr>
                        <td>Telp / HP</td>
                        <td>:</td>
                        <td><?php echo $dataiklan['telp'] ?></td>
                    </tr>
                    <tr>
                        <td>Pin BB</td>
                        <td>:</td>
                        <td><?php echo $dataiklan['pinBB'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $dataiklan['Email'] ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">Deskripsi</td>
        </tr>
        <tr>
            <td><?php echo CHtml::textArea('deskripsi',$dataiklan['deskripsi'],array('disabled'=>true,'cols'=>60,'rows'=>5,'style'=>'color:#000000;resize:none')) ?></td>
<!--            <td>-->
<!--                <textarea readonly cols="60" rows="5" style="resize: none">-->
<!--                    --><?php //echo trim($dataiklan['deskripsi']) ?>
<!--                </textarea>-->
<!--            </td>-->
        </tr>
    </table>
    <div class="row">
        <?php
        $this->widget('bootstrap.widgets.TbButton',array(
            'label'=>'Kembali',
            'type'=>'primary',
            'size'=>'small',
            'htmlOptions'=>array(
                'onclick'=>"
                    var session = '".Yii::app()->session['leveluser']."';
                    if(session=='admin')
                        window.location='/admin/home';
                    else
                        window.location='/home/index';
                ",
            ),
        ));
        ?>
    </div>
</div>