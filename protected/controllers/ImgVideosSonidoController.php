<?php

class ImgVideosSonidoController extends Controller {

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
                'actions' => array('create', 'update','LoadFormulario', 'saveMultimediaContent','LoadMultimediaByContent'),
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
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
    
    public function actionLoadFormulario()
    {
        $model = new ImgVideosSonido();
        $model->attributes = $_GET['ImgVideosSonido'];
        $contenido = new Contenidos();
        $contenido->id = $_GET['ImgVideosSonidoContenidos']['contenidos_id'];
        echo $this->renderPartial('_form', array('model'=>$model,'Contenidomodel'=>$contenido,'cursoSeccion'=>true), true);
    }
    
    public function actionLoadMultimediaByContent() {
        echo $this->renderPartial('application.views.imgVideosSonido._contenido', array('model' => new ImgVideosSonido(), 'id_contenido' => $_REQUEST['id_contenido']), true);
    }

    public function actionSaveMultimediaContent() {
        $model = new ImgVideosSonido();

        if (isset($_POST['ImgVideosSonido'])) {
            $model->attributes = $_POST['ImgVideosSonido'];
            $model->state_img_videos = 'active';
            if ($model->type == 'img') 
                    $model->url = CUploadedFile::getInstance($model, 'url');
            if ($model->save()) {
                if ($model->type == 'img') {
                    $model->url = CUploadedFile::getInstance($model, 'url');
                    $this->saveImgContenido($model, $_POST['ImgVideosSonidoContenidos']['contenidos_id']);
                }
                $modelImgVideoContent = new ImgVideosSonidoContenidos();
                $modelImgVideoContent->img_videos_id = $model->id;
                $modelImgVideoContent->contenidos_id = $_POST['ImgVideosSonidoContenidos']['contenidos_id'];
                $modelImgVideoContent->state_video_has_contenidos = 'active';
                if ($modelImgVideoContent->save()) {
                    echo json_encode(array('rpt' => true,'id_contenido'=>$model->id));
                    exit();
                } else {
                    echo json_encode($modelImgVideoContent->errors);
                    exit();
                }
                echo json_encode(array('rpt' => true,'id_contenido'=>$model->id));
                exit();
            } else {
                echo json_encode($model->errors);
                exit();
            }
        }
        echo json_encode(array('rpt' => false));
    }

    public function saveImgContenido($model, $id_contenido) {
        //es la carpeta donde se guardan las imagenes
        //es la carpeta donde se guardan las imagenes
        $relativeFolder = "themes/PoliAuLink/images/contenidos/$id_contenido/";
        $pathImages = Yii::app()->basePath . '/../' . $relativeFolder;
        if (!is_dir($pathImages)) {
            mkdir($pathImages, 0755);
        }
        if ($model->url != "") {

            $model->url->saveAs($pathImages . $model->url);
            $model->url = $relativeFolder . $model->url;
            $model->save();
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new ImgVideosSonido('normal');

// Uncomment the following line if AJAX validation is needed
        
        if (isset($_POST['ImgVideosSonido'])) {
            $model->attributes = $_POST['ImgVideosSonido'];
            if($model->type=="video")
            {
                $model->scenario = 'video';
            }
            $this->performAjaxValidation($model);
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

        if (isset($_POST['ImgVideosSonido'])) {
            $model->attributes = $_POST['ImgVideosSonido'];
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
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('ImgVideosSonido');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ImgVideosSonido('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ImgVideosSonido']))
            $model->attributes = $_GET['ImgVideosSonido'];

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
        $model = ImgVideosSonido::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'img-videos-sonido-form') {
            if($model->type=="img"){
                $_POST['ImgVideosSonido']['url'] = 'url';
                $model->scenario = 'img';
                $model->name_img = $_POST['ImgVideosSonido']['name_img'];
            }
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }   
    }

}
