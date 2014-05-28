<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
    'Error',
);
?>
<?php if (isset($code)) { ?>
    <h2>Error <?php echo $code; ?></h2>

    <div class="error">
        <?php echo CHtml::encode($message); ?>
    </div>
<?php } else { ?>

    
    <?php
}
?>
