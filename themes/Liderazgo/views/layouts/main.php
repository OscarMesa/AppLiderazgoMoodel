<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="es" />

        <!-- blueprint CSS framework -->
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/app.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/template.css"/>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.tools.min.js"></script>
    </head>

    <body>

        <div id="menu_superior" class="grid_16 alpha omega"> <?php
            $this->widget('zii.widgets.CMenu', array(
                'items' => array( 
                    //array('label' => 'Ingresar', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                    array('label' => 'Salir (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                ),
            ));
            ?>
        </div>
        <div id="curso">
            <div id="panel_izq">
                <div id="avatar">
                    <img src="<?php echo Yii::app()->getBaseUrl(true) ?>/themes/PoliAuLink/images/profe.png">
                </div>
                <div id="informacion_personal">
                    <div class='acordion'>
                        <div class="titulo"> Datos Personales</div>
                        <table>
                            <tr>
                                <td colspan="2">Diego Alberto Ochoa Ortiz</td>
                            </tr>
                            <tr>
                                <td>Perfil</td><td>Docente</td>
                            </tr>
                            <tr>

                            </tr>				
                        </table>
                    </div>
                    <div class='acordion'>
                        <div class="titulo"> Cursos Actuales </div>
                        <table>
                            <tr>
                                <td>Materia</td><td>Estado</td>
                            </tr>						
                            <tr>
                                <td>Matematica</td><td><img src='<?php echo Yii::app()->getBaseUrl(true) ?>/themes/PoliAuLink/images/activo.png'></td>
                            </tr>	
                            <tr>
                                <td>Fisica</td><td><img src='<?php echo Yii::app()->getBaseUrl(true) ?>/themes/PoliAuLink/images/activo.png'></td>
                            </tr>	
                            <tr>
                                <td>Quimica</td><td><img src='<?php echo Yii::app()->getBaseUrl(true) ?>/themes/PoliAuLink/images/inactivo.png'></td>
                            </tr>	
                            <tr>
                                <td>Español</td><td><img src='<?php echo Yii::app()->getBaseUrl(true) ?>/themes/PoliAuLink/images/activo.png'></td>
                            </tr>				
                        </table>
                    </div>
                    <div class='acordion'>
                        <div class="titulo"> Nuevo Curso </div>
                    </div>								
                </div>

                <div id="pie">
                    <img src="<?php echo Yii::app()->getBaseUrl(true) ?>/themes/PoliAuLink/images/iefo.png" aling="left"><b>INSTITUCION EDUCATIVA FEDERICO OZANAM <br/> &copy; 2014</b>
                </div>               
            </div>
            <div id="panel_central">
                <div id="menu">
                    <?php 
                                if(isset(Yii::app()->user->__perfiles) && Yii::app()->user->esProfesor())
                                {
                    
                    ?>
                    <div id="op" class='activo'><a href="<?php echo Yii::app()->getBaseUrl(true)?>/cursos/admin">Curso</a></div>
                    <div id="op"><a href="<?php echo Yii::app()->getBaseUrl(true)?>/talleres/admin">Talleres</a></div>
                    <div id="op">Ejercicios</div>
                    <div id="op">Multimedia</div>
                    <div id="op">Evaluaciones</div>
                                <?php } ?>
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