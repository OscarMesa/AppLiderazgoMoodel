<?php

class CuotaController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionCreate() {
        $errors = array();
        $prioridad = array(); // este arreglo va a contener los cursos ordenados segun su orden natural
        //$prioridad2 = array();
        // Buscamos los cursos y los ordenamos por el campo category y sortorder. Este ultimo es el orden natural que toma dentro de moodle. 
        $prioridad1 = MdlCourse::model()->findAll(array('select' => 'id,sortorder,category,fullname,shortname,idnumber', 'order' => 'category ASC, sortorder ASC', 'condition' => 'id NOT IN(1,7,19,36,37,40,41)'));
        //  echo '<pre>';
        $c = -1;
        $k = 1;
        foreach ($prioridad1 as $prd) {
            // echo $prd['category'];
            if ($c != $prd['category']) {
                $c = $prd['category'];
                $prioridad[$c] = array();
                $k = 1;
            }
            $p = new AlmComplementoCursos();
            $p->prioridad = $k;
            $p->id_curso_mdl = $prd['id'];
            $prioridad[$c][] = $p;
            //$prioridad[$c][] = $prd;
        }
       // echo '<pre>';print_r($prioridad);exit();
        $model = new CuotaForm();
        if (isset($_POST['CuotaForm'])) {
            $model->attributes = $_POST['CuotaForm'];
            $success = true;
            $model->csvFile = CUploadedFile::getInstance($model, 'csvFile');
            if ($model->validate()) {
                if (($handle = fopen($model->csvFile->tempName, 'r')) !== FALSE) {
                    //echo '<pre>';
                    $content = file_get_contents($model->csvFile->tempName);
                    $data = explode("\n", mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true)));
                    // print_r($prioridad);

                    foreach ($data as $row) {
                        $rowData = explode(',', str_replace('"', '', $row));
                        if (count($rowData) >= 3 && $rowData[2] != 'clinom') {
                            //Si tiene cutas atrazadas no se hace nada y se registra el usuario en un error que se le retorna a el usuario.
                            if ($rowData[4] <= 0) {
                                $d = MdlUserInfoData::model()->find('data=? AND fieldid=1', array($rowData[3]));
                                if ($d != null) {
                                    $usuario = MdlUser::model()->findByPk($d->userid);
                                    $categoria = MdlUserInfoData::model()->find('userid=? AND fieldid=2', array($d->userid));
                                    if ($categoria != null) {
                                        //Procedemos a leer las cuotas por cada estudiante.
                                        $id_catgoria = $categoria->data;
                                        if (isset($prioridad[$id_catgoria])) {
//                                        echo '<pre>';
//                                    print_r($prioridad[$id_catgoria]);
//                                        exit();
                                            //Si en este campo de cuoatra llega un -1 vamos a activar todos
                                            if ($rowData[4] == -1) {
                                                $this->activarTodosLosCursos($prioridad[$id_catgoria], $usuario->id);
                                             //   break;
                                            } else  {
                                                //$rowData en la posicion 5 tiene la cuota a activar.
                                                $this->activarCursosxCuota($prioridad[$id_catgoria], $rowData[5], $_POST['CuotaForm']['consecutivos'], $usuario->id);
                                            }
                                        } else {
                                            $errors = array();
                                            $errors[] = "Al parecer una de las categorias en el archivo no existe en moodle, por favor verifique.";
                                        }
                                    }
                                } else {
                                   // 
                                    if (!isset($errors['usuarioInexixtente']))
                                        $errors['usuarioInexixtente'] = "<h4>Los siguientes usuarios no se encontraron con la cedula, o posiblemente no existan</h4><br/>";
                                    $errors['usuarioInexixtente'] .= $rowData[2].'<br/>';
//                                    echo 'esta son los tales ..... ';exit();
                                }
                            }else {
                                if (!isset($errors['cuotaTra']))
                                    $errors['cuotaTra'] = "<h4>Los siguientes usuarios son morosos.</h4><br/>";
                                $errors['cuotaTra'] .= $rowData[2] . '. ' . $rowData[4] . ' cuota(s).<br/>';
                           //     echo 'esta son los tales ..... ';
                            }
                        }
                    }
                    if(count($errors) == 0)
                    {
                        $this->regitrarLogMovimientoCuota($model);
                        $user = Yii::app()->getComponent('user');
                        $user->setFlash(
                                'success', "<strong>Exito!</strong> Los cambios han sido almacenados con éxito."
                        );
                    }else{
                        $model->addErrors($errors);
                    }
                }
            }
        }
        $this->render('subirCuota', array(
            'model' => $model,
        ));
    }

    public function activarTodosLosCursos($vecPridad, $id_usuario) {
        foreach ($vecPridad as $key => $AlmComplCurso) {
            $this->activarCurso($AlmComplCurso, $id_usuario);
        }
    }

    public function regitrarLogMovimientoCuota($model) {
        $registro = new AlmRegistroCuota();
        $registro->nombre_archivo = $model->csvFile->name;
        $registro->id_user_mdl = Yii::app()->user->getId();
        $registro->fecha_creacion = date('Y-m-d H:i:s');
        $registro->save();
    }

    /**
     * 
     * @param array $vectorPrioridad este vector contiene los cursos ordenados por prioridad como los tiene moodle
     * @param int $cuota Este es el numero de la cuota que se deseea activar
     * @param type $cantidadCursosActivarxCuota Con este dato se sabe cuantos cursos va activar por cuota
     * @param type $id_usario Identificador del usuario en moodle
     */
    public function activarCursosxCuota($vectorPrioridad, $cuota, $cantidadCursosActivarxCuota, $id_usario) {
//        echo '<pre>';print_r($vectorPrioridad);exit();
        $ciclos = 1;
        $ciclosxCuota = 1;
        for ($j = 0; $j < count($vectorPrioridad); $j = $j + $cantidadCursosActivarxCuota) {
            if ($ciclos == $cuota) {
                $ciclosxCuota = 1;
                for ($k = $j; $k < count($vectorPrioridad); $k++) {
                    if ($k == ($j + $cantidadCursosActivarxCuota)) {
                        break;
                    } else {
                        $AlmComplCurso = $vectorPrioridad[$k];
                        $this->activarCurso($AlmComplCurso, $id_usario);
                    }
                }
                break;
            }
            $ciclos++;
        }
    }

    public function activarCurso($AlmComplCurso, $id_usario) {
        $obj = (MdlCourse::model()->with(array('contexts' => array(
                        'condition' => 'contexts.contextlevel=50  '
            )))->findByPk($AlmComplCurso->id_curso_mdl));

        $context = $obj->contexts[0];

        if (MdlRoleAssignments::model()->count('contextid=? AND userid =?', array($context->id, $id_usario)) == 0) {
            $asignacion = new MdlRoleAssignments();
            $asignacion->roleid = 5;
            $asignacion->contextid = $context->id;
            $asignacion->timemodified = time();
            $asignacion->modifierid = 2;
            $asignacion->itemid = 0;
            $asignacion->sortorder = 0;
            $asignacion->userid = $id_usario;
            if (!$asignacion->save()) {
                print_r($asignacion->errors);
                exit();
            } else {
                $enrol = MdlEnrol::model()->find('courseid = ? AND enrol="manual"', array($AlmComplCurso->id_curso_mdl));
                if ($enrol != null) {
                    $enrolUser = new MdlUserEnrolments();
                    $enrolUser->status = 0;
                    $enrolUser->enrolid = $enrol->id;
                    $enrolUser->userid = $id_usario;
                    $enrolUser->timestart = time();
                    $enrolUser->timeend = 0;
                    $enrolUser->modifierid = 2;
                    $enrolUser->timecreated = time();
                    $enrolUser->timemodified = time();
                    if (!$enrolUser->save()) {
                        print_r($asignacion->errors);
                        exit();
                    }
                } else {

//                                    echo '<pre>Enrol no existe para el id curso '.$AlmComplCurso->id_curso_mdl;
//                                    print_r($vectorPrioridad);
//                                    exit();
                }
            }
        }
    }

    public function actionIndex() {
        
    }

}
