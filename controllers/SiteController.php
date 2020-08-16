<?php

namespace app\controllers;

use app\models\Order;
use app\models\Position;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Product;


class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionProductList()
    {
        $product_list = Product::find()->all();

        return $this->render('product_list', ['product_list' => $product_list]);
    }

    public function actionAddProduct()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(['site/product-list']);
        } else {
            return $this->render('add_product_form', ['model' => $model]);

        }
    }

    public function actionDeleteProduct()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Product::find()->where(['id' => $id])->one();
        $model->delete();
        return $this->redirect(['site/product-list']);

    }

    public function actionDeleteOrder()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Order::find()->where(['id' => $id])->one();
        $model->delete();
        return $this->redirect(['site/order-list']);
    }

    public function actionEditProduct()
    {
        if(Yii::$app->request->post()) {
            $prodouct = (Yii::$app->request->post())['Product'];

            $edit_product = Product::find()->where(['id' => $prodouct['id']])->one();
            $edit_product->name = $prodouct['name'];
            $edit_product->price = $prodouct['price'];
            $edit_product->available_quantity = $prodouct['available_quantity'];
            $edit_product->update();
            return $this->redirect(['site/product-list']);
        } else {
            $request = Yii::$app->request;
            $id = $request->get('id');
            $model = Product::find()->where(['id' => $id])->one();
            return $this->render('add_product_form', ['edit_product' => $model]);
        }
    }

    public function actionOrderList()
    {
        $order_list = Order::find()->all();
        $order_arr = [];
        foreach ($order_list as $order) {
            $positions = Position::find()->where(['order_id' => $order->id])->all();
            $order_arr[$order->id] = ['created'=>$order->created_at,'positions'=>[]];
            foreach ($positions as $position) {
                $product_name = Product::find()->where(['id' => $position->product_id])->one()->name;
                $position_info = ['name'=>$product_name,'quantity'=>$position->quantity];
                array_push($order_arr[$order->id]['positions'],$position_info);

            }
        }
//        echo '<pre>';
//        print_r($order_arr);
//        echo '</pre>';
        return $this->render('order_list', ['order_list' => $order_arr]);
    }

    public function actionMakeOrder()
    {
        if (Yii::$app->request->post()) {
            $positions = Yii::$app->request->post();
            $order = new Order();
            $order->save();
            foreach ($positions['Product'] as $product_id=>$quantity){
                if($quantity){
                    $position = new Position();
                    $position->product_id = $product_id;
                    $position->quantity = $quantity;
                    $position->order_id = $order['id'];
                    $position->save();
                }
            }
            return $this->redirect(['site/order-list']);
        } else {
            $product_list = Product::find()->all();
            return $this->render('make_order_form', ['product_list' => $product_list]);


        }
    }


}