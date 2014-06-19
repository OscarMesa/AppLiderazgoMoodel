<?php

class UsuariosController extends Controller {

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
                'actions' => array('index', 'view', 'inicio'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('CompletarInfoUsuarios', 'create', 'update', 'active'),
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

    public function actionCompletarInfoUsuarios() {
        header('Content-Type: text/html; charset=UTF-8');
        $errors = array();
        if (isset($_FILES['txtFileMigra'])) {
            $file = CUploadedFile::getInstanceByName('txtFileMigra');

            if (($handle = fopen($file->tempName, 'r')) !== FALSE) {
                $content = file_get_contents($file->tempName);
                $data = explode("\n", mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true)));
                foreach ($data as $row) {
                    $rowData = array_values(explode(',', $row));
                    if (isset($rowData[2]) && $rowData[2] != 'clinom') {
                        $usuario = $this->buscarEstudiante(str_replace('"', '', strtolower($rowData[2])));
                        if ($usuario != null) {
                            $cedula = new MdlUserInfoData();
                            $cedula->userid = $usuario->id;
                            $cedula->fieldid = 1;
                            $cedula->data = str_replace('"','', $rowData[3]);
                            $cedula->dataformat = 0;

                            if(($x = MdlUserInfoData::model()->count('userid = ? AND fieldid=1', array($usuario->id))) <= 0) {
                                //La cateoria 2 es Practitioner Instructor Personal de PNL y la 3 es Secretos para una vida plena con PNL! tabla mdl_course_categories
                                $cedula->save();
                            }
                            $cat_curso = Yii::app()->db1->createCommand('
                                                SELECT c.category
                                                FROM mdl_user u
                                                INNER JOIN `mdl_role_assignments` mra ON ( u.id = mra.userid )
                                                INNER JOIN mdl_context mc ON ( mra.contextid = mc.id )
                                                INNER JOIN mdl_course c ON ( c.id = mc.instanceid )
                                                WHERE mc.contextlevel =50 AND u.id = ' . $usuario->id . ' AND c.category IN (2,3)
                                                LIMIT 1')->queryAll();
                            if($cat_curso == null){
                                $cat_curso =  MdlUserInfoData::model()->find('userid = ? AND fieldid=2', array($usuario->id));
                                if($cat_curso!=null)
                                $cat_curso =  array(array('category'=>$cat_curso->data));
                            }
                            if (count($cat_curso) > 0) {
                                if (MdlUserInfoData::model()->count('userid = ? AND fieldid=2 AND data=?', array($usuario->id, $cat_curso[0]['category'])) <= 0) {
                                    $cat = new MdlUserInfoData();
                                    $cat->userid = $usuario->id;
                                    $cat->fieldid = 2;
                                    $cat->data = $cat_curso[0]['category'];
                                    $cat->dataformat = 0;
                                    $cat->save();
                                }
                            }else {
                                if (!isset($errors['sinCursoAsinarCat']))
                                    $errors['sinCursoAsinarCat'] = '<h4>Los siguientes usuarios no tienen ningun curso vinculado o la categoria de los cursos.</h4>';
                                $errors['sinCursoAsinarCat'] .= $rowData[2] . '<br/>';
                            }
                        } else {
                            if (!isset($errors['lecturaUsuarios']))
                                $errors['lecturaUsuarios'] = '<h4>Los siguientes usuarios no fueron encontrados en moodle, verifica que existan (No importa mayusculas o minusculas, lo importante es que sus nombres y apellidos coincidan con este.)</h4>';
                            $errors['lecturaUsuarios'] .= $rowData[2] . '<br/>';
                        }
                    }
                }
            }
        }

        $this->render('completarInfoUsuarios', array(
            'errors' => $errors
        ));
    }

    /**
     * @param array $nombre 
     */
    public function buscarEstudiante($nombre) {
        $nombre = (explode(" ", $nombre));
        $usuario = null;
        $data = null;
        if (count($nombre) == 6) {
            $data = array($nombre[0] . ' ' . $nombre[1] . ' ' . $nombre[2], $nombre[3] . ' ' . $nombre[4] . ' ' . $nombre[5]);
        } else if (count($nombre) == 5) {
            $data = array($nombre[0] . ' ' . $nombre[1], $nombre[2] . ' ' . $nombre[3] . ' ' . $nombre[4]);
//             print_r($data);exit();
        } else if (count($nombre) == 4) {
            $data = array($nombre[0] . ' ' . $nombre[1], $nombre[2] . ' ' . $nombre[3]);
        } else if (count($nombre) == 3) {
            $data = array($nombre[0] . ' ' . $nombre[1], $nombre[2]);
        } else if (count($nombre) == 2) {
            $data = array($nombre[0], $nombre[1]);
        }

        if ($data != null) {
            $usuario = MdlUser::model()->find('LOWER(lastname) LIKE (\'%' . $data[0] . '%\') AND LOWER(firstname) LIKE (\'%' . $data[1] . '%\')');
        }

        return $usuario;
    }

    public function actionInicio() {
        //print_r(Yii::app()->user);exit();
        if (!Yii::app()->user->isGuest) {
            // $this->render('application.views.site.inicio');
            $this->redirect(Yii::app()->getBaseUrl(true) . '/cuota/create');
        } else {
            $this->redirect(Yii::app()->getBaseUrl(true) . '/site/login');
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Usuarios::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && ($_POST['ajax'] === 'usuarios-form' || $_POST['ajax'] === 'usuarios-form-recuperar')) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionActive($id) {
        Usuarios::model()->updateByPk($id, array('state_usuario' => 'active'));
        $this->render('application.views.site.inicio');
    }

    public function actionInactive($id) {
        Usuarios::model()->updateByPk($id, array('state_usuario' => 'inactive'));
        $this->render('application.views.site.inicio');
    }

    /**
     * Este metodo se encarga de enviar el grid por ajax, filtrando por cualquier campo
     * @author Oskar <oscarmesa.elpoli@gmail.com>
     * 
     */
    public function actionAjaxFiltroUsuarios() {
        $columnas = json_decode($_POST['columnas']);
        $criteria = new CDbCriteria();
        $criteria->alias = 'usuario';
        // $criteria->join = ' INNER JOIN perfiles perfil'
        $criteria->join = ' INNER JOIN usuarios_perfiles up ON up.usuarios_id_usuario= usuario.id_usuario';
        $criteria->join .= ' INNER JOIN perfiles perfil ON perfil.id_perfil= up.perfiles_id_perfil';
        $params = array();
        if (count($columnas) > 0) {
            foreach ($columnas as $columna) {
                if ($columna->id != 'perfil')
                    $criteria->addCondition('usuario.' . $columna->id . '=?', 'OR');
                else
                    $criteria->addCondition('perfil.nombre=?', 'OR');
                $params[] = $_POST['data'];
            }
        } else {
            $criteria->addCondition('usuario.nombre=?', 'OR');
            $criteria->addCondition('usuario.apellido1=?', 'OR');
            $criteria->addCondition('usuario.apellido2=?', 'OR');
            $criteria->addCondition('usuario.telefono=?', 'OR');
            $criteria->addCondition('usuario.celular=?', 'OR');
            $criteria->addCondition('usuario.correo=?', 'OR');
            $criteria->addCondition('perfil.nombre=?', 'OR');
            for ($i = 0; $i < 7; $i++) {
                $params[] = $_POST['data'];
            }
        }
        $criteria->group = 'usuario.id_usuario';
        $criteria->select = 'usuario.*,perfil.nombre nombre_perfil';
        $criteria->params = $params;
        $dataProvider = new CActiveDataProvider('Usuarios', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            )
                )
        );
        echo $this->renderPartial('_gridUsuarios', array('dataProvider' => $dataProvider), true);
    }

}
