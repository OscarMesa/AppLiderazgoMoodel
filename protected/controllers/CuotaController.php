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
        $model = new CuotaForm();
        if (isset($_POST['CuotaForm'])) {
            $model->attributes = $_POST['CuotaForm'];
            $success = true;
            $model->csvFile = CUploadedFile::getInstance($model, 'csvFile');
            if ($model->validate()) {
                if (($handle = fopen($model->csvFile->tempName, 'r')) !== FALSE) {
                    // necessary if a large csv file
                    set_time_limit(0);
                    Yii::import('application.vendor.Utilidades');
                    Yii::import('application.vendor.passwordEncrypt');
                    $row = 0;
                    $delimitador = Utilidades::getDelimiter($model->csvFile->tempName);
                    $camposBD = array();
                    $cuota = 0;
                    //Consultamos el orden de prioridad de los cursos, ordenado por la prioridad.
                    $prioridad = AlmComplementoCursos::model()->findAll(array('order' => 'prioridad ASC'));
                    if(count($prioridad)>0){
                    while (($data = fgetcsv($handle, 1000, $delimitador)) !== FALSE) {
                        // number of fields in the csv
                        if ($row == 0) {
                            foreach ($data as $key => $value) {
                                if ($value == 'cuota') {
                                    $cuota = $key;
                                    break;
                                } else {
                                    $camposBD[] = $value;
                                }
                            }
                        } else {
                            $usuario = new MdlUser();
                            $relacionUsuario = new AlmComplementoUsuario();
                            //Primero le vaciamos los valores de las columnas que se van a almacenar en los obejtos que se vayan a guardar en la BD
                            foreach ($camposBD as $key => $value) {
                                $usuario->setAttribute($value, $data[$key]);
                                $relacionUsuario->setAttribute($value, $data[$key]);
                            }
                            $u_existente = MdlUser::model()->find('username=?', array($usuario->username));
                            $usuario->password = passwordEncrypt::password_hash($usuario->password, PASSWORD_DEFAULT, array());
                            $usuario->setAttribute('mnethostid', 1);
                            $usuario->setAttribute('confirmed', 1);
                            if (count($u_existente) > 0) {
                                $usuario->id = $u_existente->id;
                                $usuario->isNewRecord = false;
                                if ($usuario->validate())
                                    $usuario->update();
                                else {
                                    $errors = array();
                                    foreach ($usuario->errors as $key => $value) {
                                        $errors[] = "Error en el archivo de subida." . $value;
                                    }
                                    $model->addErrors($errors);
                                    $success = false;
                                    break;
                                }
                            } else {
                                if ($usuario->validate())
                                    $usuario->save();
                                else {
                                    $errors = array();
                                    foreach ($usuario->errors as $key => $value) {
                                        $errors[] = "Error en el archivo de subida." . $value;
                                    }
                                    $model->addErrors($errors);
                                    $success = false;
                                    break;
                                }
                            }
                            $relacionUsuario->setAttribute('id_user_mdl', $usuario->id);
                            $u_existente = AlmComplementoUsuario::model()->find('id_user_mdl=?', array($usuario->id));
                            if (count($u_existente) > 0) {
                                $relacionUsuario->isNewRecord = false;
                                if ($relacionUsuario->validate())
                                    $relacionUsuario->update();
                                else {
                                    $errors = array();
                                    foreach ($relacionUsuario->errors as $key => $value) {
                                        $errors[] = "Error en el archivo de subida." . $value;
                                    }
                                    $model->addErrors($errors);
                                    $success = false;
                                    break;
                                }
                            } else {
                                if ($relacionUsuario->validate())
                                    $relacionUsuario->save();
                                else {
                                    $errors = array();
                                    foreach ($relacionUsuario->errors as $key => $value) {
                                        $errors[] = "Error en el archivo de subida." . $value;
                                    }
                                    $model->addErrors($errors);
                                    $success = false;
                                    break;
                                }
                            }
//                            echo 'estos son las cuotas<br/>';
                            // print_r($prioridad);
//                            exit();
                            //Procedemos a leer las cuotas por cada estudiante.
                            for ($i = $cuota; $i < count($data); $i++) {
                                if ($data[$i] == 'contado') {
                                    $this->activarTodosLosCursos($prioridad, $usuario->id);
                                    break;
                                } else if ($data[$i] != '') {
                                    $this->activarCursosxCuota($prioridad, $data[$i], $_POST['CuotaForm']['consecutivos'], $usuario->id);
                                }
                            }
                        }
                        $row++;
                    }
                    }else{
                        $model->addErrors(array('Aun falta priorizan los cursos.'));
                        $success = false;
                    }
                    fclose($handle);
                    if ($success) {
                        $this->regitrarLogMovimientoCuota($model);
                        $user = Yii::app()->getComponent('user');
                        $user->setFlash(
                                'success', "<strong>Exito!</strong> Los cambios han sido almacenados con éxito."
                        );
                        $this->redirect('create');
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
            $this->activarCurso($AlmComplCurso,$id_usuario);
        }
    }

    public function regitrarLogMovimientoCuota($model) {
        $registro = new AlmRegistroCuota();
        $registro->nombre_archivo = $model->csvFile->name;
        $registro->id_user_mdl = Yii::app()->user->getId();
        $registro->fecha_creacion = date('Y-m-d H:i:s');
        $registro->save();
    }

    public function activarCursosxCuota($vectorPrioridad, $cuota, $cantidadCursosActivarxCuota, $id_usario) {
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
                        $this->activarCurso($AlmComplCurso,$id_usario);
                    }
                }
                break;
            }
            $ciclos++;
        }
    }

    public function activarCurso($AlmComplCurso,$id_usario) {
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
