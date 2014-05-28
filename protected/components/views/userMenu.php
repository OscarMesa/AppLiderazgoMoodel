<ul>
        <?php if(!Yii::app()->user->isGuest){ ?>
        <li><?php echo CHtml::link('Tasas',array('/tasas/admin')); ?></li>
        <li><?php echo CHtml::link('Monedas',array('/moneda/admin')); ?></li>
        <li><?php echo CHtml::link('Sedes',array('/sede/admin')); ?></li>
        <?php } ?>
</ul>