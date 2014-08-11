<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="es" />

        <!-- blueprint CSS framework -->
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/app.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/template.css"/>
    </head>

    <body>
<?php

$this->widget('bootstrap.widgets.TbNavbar', array(
            'type' => 'inverse', // null or 'inverse'
            'brand' => '<img src="'.Yii::app()->getBaseUrl(true).'/themes/Liderazgo/images/logo.png">',
            'brandUrl' => Yii::app()->getBaseUrl(true),
            'collapse' => true, // requires bootstrap-responsive.css
            'brandOptions' => array(
            ),
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label' => 'Home', 'url' => array(Yii::app()->defaultController)),
                        array('label' => 'Sobre nosotros', 'url' => 'http://www.escuelainternacionaldeliderazgo.com/conozcanos.html'),
                        array('label' => 'Ingresar '
                            , 'url' => array('/site/login')
                            , 'visible' => Yii::app()->user->isGuest
                            , 'itemOptions' => array(
                                'class' => 'menu_ingreso menu_entrar'
                            ),
                        ),
                        array('label' => 'Archivo de cartera'
                            , 'url' => array('/cuota/create')
                            , 'visible' => !Yii::app()->user->isGuest
                            , 'itemOptions' => array(
                            ),
                        ),
                        array('label' => 'Archivo de usuarios'
                            , 'url' => array('/usuarios/completarInfoUsuarios')
                            , 'visible' => !Yii::app()->user->isGuest
                            , 'itemOptions' => array(
                            ),
                        ),
                        /*array('label' => 'Priorizar cursos'
                            , 'url' => array('/course/prioridadCurso')
                            , 'visible' => !Yii::app()->user->isGuest
                            , 'itemOptions' => array(
                            ),
                        ),*/
                        array('label' => 'Reporte de evaluaciones'
                            , 'url' => array('/course/evaluacion')
                            , 'visible' => !Yii::app()->user->isGuest
                            , 'itemOptions' => array(
                            ),
                        ),
                      //  array('label' => 'Contactanos', 'url' => array('/site/contact')),
                        array('label' => 'Salir (' . Yii::app()->user->name . ')'
                            , 'url' => array('/site/logout')
                            , 'visible' => !Yii::app()->user->isGuest
                            , 'itemOptions' => array(
                                'class' => 'menu_ingreso menu_salir'
                            ),
                        ),
                    ),
                ),
            ),
        ));
        
            ?>
        <div id="menu_superior" class="grid_16 alpha omega"> 
        </div>
        <div id="curso">
            <div id="panel_izq">
                <div id="avatar">
                    <img src="<?php echo Yii::app()->getBaseUrl(true) ?>/themes/Liderazgo/images/logo-liderazgo.png">
                </div>
                
                <div id="pie">
                    <b>Escuela Internacional de liderazgo <br/> &copy; 2014</b>
                </div>               
            </div>
            <div id="panel_central">
                <div id="menu">
     
                </div>
                <div id="form">
                    <div  class="grid_16">
<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true,
    'fade' => true,
    'closeText' => '&times;', // false equals no close link
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array(// configurations per alert type
        // success, info, warning, error or danger
        'success' => array('closeText' => '&times;'),
        'info', // you don't need to specify full config
        'warning' => array('block' => false, 'closeText' => false),
        'error' => array('block' => false, 'closeText' => 'AAARGHH!!')
    ),
));
?>


                        <?php echo $content; ?>
                    </div>
                </div>
            </div>

        </div>
        <div id="footer">
            <p style="text-align: center;">
            </p>
        </div><!-- footer -->

    </body>
</html>