<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tables.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu_iestyles.css" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
    <div id="topnav">
        <div class="topnav_text">&nbsp;</div>
    </div>
    <div id="header">
        <div id="logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png"><?php //echo CHtml::encode(Yii::app()->name); ?></div>
    </div><!-- header -->
    <div id="mainmenu" style="padding-bottom: 5px">
        <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/home/index'),'visible'=>Yii::app()->session['leveluser']!='admin'),
                array('label'=>'Home', 'url'=>array('/admin/home'),'visible'=>Yii::app()->session['leveluser']=='admin'),
                array('label'=>'Rules', 'url'=>array('/home/rules')),
                array('label'=>'About', 'url'=>array('/home/about')),
                array('label'=>'Logout', 'url'=>array('/site/logout'),'visible'=>Yii::app()->session['leveluser']=='admin'),
            ),
        )); ?>
        <span style="float: right;padding-right:20px;vertical-align: text-top">
<!--            for right margin-->
        </span>
    </div> <!--mainmenu -->
    <?php echo $content; ?>

    <div>
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'<span class="">jualtanah.com</span>',
        ));
//        $kategori=Yii::app()->db->createCommand("select * from tbl_kategori order by kategori asc")->queryAll();
//        foreach ($kategori as $value) {
//            echo CHtml::link($value['kategori'],'/kat/');
//            echo '<br/>';
//        }
        ?>
        <br />
        <?php
        $this->endWidget('zii.widgets.CPortlet');
        ?>
    </div>
    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by <?php echo CHtml::link('oYikNetwork','http://oyiknetwork.com') ?><br/>
        All Rights Reserved.<br/>
        <?php echo CHtml::image('/images/oyiklogo.png'); ?>
    </div><!-- footer -->

</div><!-- page -->

</body>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/jquery-1.7.2.min.js"); ?>
</html>