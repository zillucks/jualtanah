<?php $this->beginContent('//layouts/main'); ?>
<?php
Yii::app()->clientScript->registerScript('js-act',"
    $('#btn-pasangiklan').click(function(){
        window.location='/home/pasangiklan';
    });

    $('#btn-frontpage').click(function(){
        window.location='/home/index';
    });
");
?>
<div class="container">
	<div class="span-6 first">
        <div id="sidebar">
            <?php
            /*$this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'<span class="icon icon-user">Filter</span>',
            ));

            $kategori=Yii::app()->db->createCommand("select * from filter where kode_filter <> '' order by filter asc")->queryAll();
            foreach ($kategori as $value) {
                */?><!--
                <div style="padding: 3px 0;display: block;"><?php /*echo CHtml::link($value['filter'],$value['kode_filter']); */?></div>
                <?php
/*            }
            */?>
            <br />
            --><?php
/*            $this->endWidget();*/
            ?>

        </div><!-- sidebar -->
	</div>
	<div class="span-20">
        <div id="content">
            <?php echo $content; ?>
        </div>
	</div>
    <div class="span-6 last">
        <div id="sidebar">
            <?php
            $title = 'Pasang Iklan';
            $label = 'Pasang Iklan';
            $id = 'btn-pasangiklan';
            if(Yii::app()->session['leveluser']=='admin'){
                $title = 'Menu';
                $label = 'View Front Page';
                $id = 'btn-frontpage';
            }

            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>$title,
            ));
            ?>
            <div style="text-align: center;vertical-align:middle;padding: 5px 0 0 0">
                <?php
                $this->widget('bootstrap.widgets.TbButton',array(
                    'buttonType'=>'button',
                    'type'=>'primary',
                    'size'=>'small',
                    'label'=>$label,
                    'htmlOptions'=>array('id'=>$id),
                ));
                ?>
            </div>
            <br />
            <?php
            $this->endWidget();

//            $this->beginWidget('zii.widgets.CPortlet', array(
//                'title'=>'Shopping cart',
//            ));
//            ?>
<!--            <div style="text-align: center;padding: 5px">-->
<!--                <p>0 Items</p>-->
<!--                <p>-->
<!--                    --><?php
//                    $this->widget('bootstrap.widgets.TbButton',array(
//                        'buttonType'=>'button',
//                        'type'=>'primary',
//                        'size'=>'small',
//                        'label'=>'Checkout',
//                        'htmlOptions'=>array('id'=>'btn-ckout'),
//                    ));
//                    ?>
<!--                </p>-->
<!--            </div>-->
<!--            --><?php
//            $this->endWidget();
//            ?>

        </div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>