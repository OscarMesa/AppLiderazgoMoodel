<?php

class CourseController extends Controller {

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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update','PrioridadCurso','evaluacion'),
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
    
    public function actionEvaluacion()
    {
        //$_POST['course'] = 18;
       // $_POST['user'] = 264;
        $command1 = Yii::app()->db1->createCommand();
        $command1->select('id,fullname,shortname,idnumber');
        $command1->from('mdl_course');
        $command1->order('idnumber ASC');
        
        
        $command = Yii::app()->db1->createCommand();
        $command->select("u.id userid,CONCAT(u.firstname,' ',u.lastname) username,c.id course_id,c.fullname,c.shortname, qa.id, qa.attempt, qa.quiz, qa.sumgrades AS grade, qa.timefinish, qa.timemodified, q.sumgrades, q.grade AS maxgrade");
        $command->from(array("mdl_quiz q"));
        $command->join('mdl_quiz_attempts qa', 'qa.quiz = q.id');
        $command->join('mdl_course c', 'q.course = c.id');
        $command->join('mdl_user u', 'u.id = qa.userid');
        $command->where("state =  'finished'");
        if(isset($_POST['course']) && !empty($_POST['course']))
        {
            $command->andWhere("q.course = ".$_POST['course']);
            $command1->andWhere("id = ".$_POST['course']);
        }
        if(isset($_POST['ValEstudiante']) && !empty($_POST['ValEstudiante'])){
            $command->andWhere('CONCAT(u.firstname," ",u.lastname) LIKE "%'.$_POST['ValEstudiante'].'%"');
            $command->orWhere('u.email LIKE "%'.$_POST['ValEstudiante'].'%" ');
            $command->orWhere('u.username LIKE "%'.$_POST['ValEstudiante'].'%" ');
        }
        if(isset($_POST['user']))
        {
            $command->andWhere("qa.userid = ".$_POST['user']);
        }
        $command->order("qa.userid,qa.timefinish ASC");
    //        echo '<pre>'.$command->getText();
    //        exit();
        //Lo primero que hacemos es pasar toda la data a un arregloe es usuario => array(curso1=>array(),curso2=>array(),curso3=>array())
        $data = array();
        $idUsuario = -1;
        $result = $command->queryAll(true);
        foreach ($result as $key => $row) {
            if($idUsuario != $row['userid']){
                $idUsuario = $row['userid'];
                $data[$idUsuario] = array();
            }
            $data[$idUsuario][$row['course_id']][] = $row;
        }
        
        if(isset($_POST['ajax']))
        {
            if(count($result)> 0){
            echo $this->renderPartial('reporteEvaluacionTbl', array(
                'data'=>$data,
                'header' => $command1->queryAll(true)
            ));
            }else{
                echo 'No se han encontrado resultados.';
            }
        }else{        
        $this->render('reporteEvaluaciones', array(
            'data'=>$data,
            'header' => $command1->queryAll(true)
        ));
        }
    }


    public function actionPrioridadCurso()
    {
        $model = new AlmComplementoCursos();
        if(isset($_POST['Curso_Consecutivo']))
        {
            $return = true;
            AlmComplementoCursos::model()->deleteAll();
            foreach ($_POST['Curso_Consecutivo'] as $curso => $prioridad) {
               if($prioridad == null)continue;
                $x = new AlmComplementoCursos();
                $x->id_curso_mdl = $curso;
                $x->prioridad = $prioridad;
                if(!$x->save())
                {
                   $return = false;
                   break;
                }
            }
            if($return)
            {
                $user = Yii::app()->getComponent('user');
                $user->setFlash(
                    'success', "<strong>Exito!</strong> Los cambios han sido almacenados con éxito."
            );
            }
            $model = $x;
        }
        $this->render('proridad', array(
            'cursos' => MdlCourse::model()->findAll(array('order'=>'idnumber ASC')),
            'model' => $model
        ));
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new MdlCourse;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['MdlCourse'])) {
            $model->attributes = $_POST['MdlCourse'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['MdlCourse'])) {
            $model->attributes = $_POST['MdlCourse'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
// we only allow deletion via POST request
            $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('MdlCourse');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new MdlCourse('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['MdlCourse']))
            $model->attributes = $_GET['MdlCourse'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = MdlCourse::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'mdl-course-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
