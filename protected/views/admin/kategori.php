<?php
/* @var $this KategoriController */
/* @var $model Kategori */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kategori-kategori-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idkategori'); ?>
		<?php echo $form->textField($model,'idkategori'); ?>
		<?php echo $form->error($model,'idkategori'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kdkategori'); ?>
		<?php echo $form->textField($model,'kdkategori'); ?>
		<?php echo $form->error($model,'kdkategori'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kategori'); ?>
		<?php echo $form->textField($model,'kategori'); ?>
		<?php echo $form->error($model,'kategori'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->