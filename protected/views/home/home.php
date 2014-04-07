<?php
/* @var $this HomeController */
Yii::app()->clientScript->registerScript('js-act',"
//    $('#btnselengkapnya[id]').click(function(){
//        alert(this.id);
//        window.location='/home/detail';
//    });
");
?>
<?php
//if(Yii::app()->user->hasFlash('success')):
?>
<div>
    <?php
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true,
        'fade'=>true,
        'closeText'=>'&times;',
        'alerts'=>array(
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
        ),
    ));
    ?>
</div>
<div class="row" style="margin: 5px 0">
    <span style="color: #00172F;font: 11px cursive;font-style: italic;font-weight: bold">Sort By : </span>
    <?php
    echo CHtml::dropDownList('sort',$sort,$sorting,array(
        'onchange'=>"
            var sort = this.value;
            if (sort=='')
                window.location='/home/index';
            else
                window.location='/home/index?sort='+sort;
        ",
    ));
    ?>
</div>
<?php
//endif;

foreach ($iklan as $data):
?>
<div style="border: 1px solid #c0c0c0;height: 250px;width: 180px;text-align: center;padding: 10px 10px 2px;margin: 0 5px 10px;float: left">
    <div style="text-align: center;min-height: 140px"><img src="<?php echo Yii::app()->baseUrl.$data['url'] ?>" alt="" width="160px"/></div>
    <div style="text-align: left">Lokasi: <?php echo $data['kota'] ?></div>
    <div style="text-align: left">Luas: <?php echo $data['luas'] ?></div>
    <div style="text-align: left;font-size: 16px;font-weight: bold"><?php echo $data['harga'] ?></div>
    <div style="text-align: right;padding: 2px 0 0">
        <?php
        $this->widget('bootstrap.widgets.TbButton',array(
            'label'=>'Selengkapnya >>',
            'type'=>'primary',
            'size'=>'small',
            'htmlOptions'=>array(
//                'id'=>'btnselengkapnya',
                'onclick'=>"
                    var id = '".$data['id_iklan']."';
                    /*var  html = $(\"<form action='/home/detail' method='POST'>\" +
                        \"<input type='hidden' name='id_iklan' value=\"+id+\">\" +
                        \"</form\");
                    $('body').append(html);
                    $(html).submit();*/
                    $.ajax({
                        type:'post',
                        data:{id_iklan:id},
                        url:'/home/detail',
                        success:function(response){
                            window.location='/home/detail';
                        }
                    });
                ",
            ),
        ));
        ?>
    </div>
</div>
<?php
endforeach;