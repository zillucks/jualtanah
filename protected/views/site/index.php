<?php
/* @var $this SiteController */
Yii::app()->clientScript->registerScript('jscript',"

");
$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<?php
$kat="Branded bag new";
$kat1=explode(" ",$kat);
$kode="";
$c=count($kat1);
foreach ($kat1 as $k)
    $kode .= strtoupper($k[0]);
if($c<=1)
    $kode=strtoupper(substr($kat,0,2));


echo $kode;
echo "<br/>".$c;
?>