<?php

class ContenidosController extends Controller {

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
        $permisos_profesor = array();
        if (Yii::app()->user->esProfesor()) {
            $permisos_profesor = array('create', 'update', 'curso', 'admin', 'delete');
        } else {
            $permisos_profesor = array('create', 'update', 'curso');
        }
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => $permisos_profesor,
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

    public function obtenerComonentesMultimedia($idTaller, $tipo = "") {
        $multimedia = ImgVideosSonido::model()->with(array('multimedia' => array('alias' => 'multimedia')));
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
        $model = new Contenidos();
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Contenidos'])) {
            $model->attributes = $_POST['Contenidos'];
            $model->almacenado_total = TRUE;
//            exit();
            if ($model->save()){
                if(isset($_POST['idTaller']))
                {
                   $contenidoTaller = new ContenidosTalleres();
                   $contenidoTaller->contenidos_id = $model->id;
                   $contenidoTaller->talleres_idtalleres = $_POST['idTaller'];
                   if($contenidoTaller->save())
                   {
                       $user = Yii::app()->getComponent('user');
                       $user->setFlash(
                            'success', "<strong>Exito!</strong> El contenido a sido agregado al taller exitosamente."
                        );
                       $this->redirect(Yii::app()->getBaseUrl(true).'/talleres/update'.$_POST['idTaller']);
                   }
                }else{
                    $this->redirect(array('admin'));
                }
            }
            // $this->redirect(array('view', 'id' => $model->id));
        }else {
            Contenidos::model()->deleteAll('almacenado_total=?', array(FALSE));
            $model->almacenado_total = FALSE;
            $model->insert();
        }

        $this->render('create', array(
            'model' => $model,
            'contenido' => $this,
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

        if (isset($_POST['Contenidos'])) {
            $model->attributes = $_POST['Contenidos'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model,
            'contenido' => $this,
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
            $model = $this->loadModel($id);
            $model->state_contenido = "inactive";
            $model->save();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Contenidos();
        $model->almacenado_total = TRUE;
        $model->state_contenido = "";
        $this->render('index', array(
            'dataProvider' => $model->search(),
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Contenidos('search');
        $model->unsetAttributes();  // clear any default values
        $model->almacenado_total = TRUE;
        if (isset($_GET['Contenidos'])){
            $model->attributes = $_GET['Contenidos'];
            $model->id = $_GET['Contenidos']['id'];
        }
       // print_r($model->attributes );
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
        $model = Contenidos::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contenidos-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
