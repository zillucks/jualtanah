<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
	'Admin',
);
?>
<h1>Data Iklan</h1>
<table class="table table-bordered table-striped table-responsive">
    <thead>
    <th>No.</th>
    <th>Image</th>
    <th>Uploader</th>
    <th>Tipe Iklan</th>
    <th>Kota</th>
    <th>Luas</th>
    <th>Harga</th>
    <th>Status</th>
    <th>Operation</th>
    </thead>
    <tbody>
    <?php
    $no = 0;
    foreach ($dataiklan as $data):
    $no++;
    ?>
    <tr>
        <td><?php echo $no ?></td>
        <td>
            <?php
            echo CHtml::image($data['url'],'no image',array('style'=>'width:90px'));
            ?>
        </td>
        <td><?php echo $data['nama'] ?></td>
        <td><?php echo $data['tipe_iklan'] ?></td>
<!--        <td>--><?php //echo $data['url'] ?><!--</td>-->
        <td><?php echo $data['kota'] ?></td>
        <td><?php echo $data['luas'] ?></td>
        <td><?php echo $data['harga'] ?></td>
        <td>
            <?php
            if($data['statusverifikasi'] == 'verified'){
                echo CHtml::image('/images/tbinsert.png','verified',array(
                    'title' => 'telah diverifikasi',
                    'style'=>'width:25px',
                ));
            }else{
                echo CHtml::image('/images/error.png','verifikasi',array(
                    'title' => 'klik untuk verifikasi',
                    'style'=>'width:25px;cursor:pointer',
                    'onclick'=>"
                        var id_iklan = '".$data['id_iklan']."';
                        $.ajax({
                            type:'post',
                            data:{id_iklan:id_iklan},
                            url:'/admin/verifikasi',
                            success:function(){
                                window.location.reload();
                            }
                        });
                    "
                ));
            }
            ?>
        </td>
        <td>
            <?php
            echo CHtml::image('/images/tbedit.png','',array(
                'title' => 'klik untuk lihat detail iklan',
                'style'=>'width:25px;cursor:pointer',
                'onclick'=>"
                        var id_iklan = '".$data['id_iklan']."';
//                        window.location='/home/detail?iklan='+id_iklan;
                        $.ajax({
                                type:'post',
                                data:{id_iklan:id_iklan},
                                url:'/home/detail',
                                success:function(){
                                    window.location='/home/detail';
                                }
                            });
                    "
            ));
            echo '&nbsp;&nbsp;';
            echo CHtml::image('/images/error.png','',array(
                'title' => 'klik untuk hapus iklan',
                'style'=>'width:25px;cursor:pointer',
                'onclick'=>"
                        var id_iklan = '".$data['id_iklan']."';
                        if (confirm('Iklan akan dihapus, Lanjutkan?'))
                        {
                            $.ajax({
                                type:'post',
                                data:{id_iklan:id_iklan},
                                url:'/admin/hapusiklan',
                                success:function(){
                                    window.location.reload();
                                }
                            });
                        }
                    "
            ));
            ?>
        </td>
    </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="9">
            <quote style="font: 10px Consolas italic">lek centang berarti wes verifikasi, lek minus berarti durung</quote>
        </td>
    </tr>
    </tbody>
</table>