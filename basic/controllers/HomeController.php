<?php
namespace app\controllers;

use app\models\LoginSchedule;
use app\models\User;
use Yii;
use app\models\Schedule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class HomeController extends Controller
{
    public $layout = 'default';
    

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                // Здесь можно настроить правила доступа к login, logout и другим действиям
                'only' => ['logout', 'login'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'], // гость
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'], // авторизованные пользователи
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $schedules = Schedule::find()->all();
        return $this->render('index', [
            'schedules' => $schedules,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Schedule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Schedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная страница не найдена.');
    }

    /**
     * Действие входа в систему.
     */
    public function actionLogin()
    {


        // Если пользователь уже авторизован, перенаправляем его на главную
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginSchedule();
        echo Yii::$app->security->generatePasswordHash('123456');

        // Если форма отправлена и логин прошёл успешно – перенаправляем
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
        }

        //Очищаем пароль, если вход не выполнен
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Действие выхода из системы.
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}