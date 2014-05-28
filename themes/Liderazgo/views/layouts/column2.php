<?php $this->beginContent('//layouts/main'); ?>

<div class="alpha grid_3">
    <div id="sidebar">
        &nbsp;
        <?php
        if (!Yii::app()->user->isGuest) {
            ?>
            <br>
            <div id="menu-admin" class="input-append">
                <div class="btn-group">
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        Actiones
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <?php
                        foreach ($this->menu as $option) {
                            echo '<li><a href="'.$option['url'][0].'">' . $option['label'] . '</a></li>';
                        }
                        ?> 
                    </ul>
                </div>
            </div>
            <?php
        }
        ?>

    </div><!-- sidebar -->
</div>   
<div class="container" >
    <div class="grid_13 omega">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>

</div>
<?php $this->endContent(); ?>