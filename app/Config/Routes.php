<?php

namespace Config;

use App\Controllers\ClientController;
use App\Controllers\OrderController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'userController::loginController');
// $routes->get('userreg','userController::regView');

$routes->get('student','studentController::index',['filter'=>'auth']);
$routes->post('student_store','studentController::store',['filter'=>'auth']);
$routes->get('student_fetch','studentController::fetch',['filter'=>'auth']);
$routes->post('student_edit','studentController::edit',['filter'=>'auth']);
$routes->post('student_update','studentController::update',['filter'=>'auth']);
$routes->post('student_delete','studentController::delete',['filter'=>'auth']);

$routes->get('course','courseController::index',['filter'=>'auth']);
$routes->post('course_store','courseController::store',['filter'=>'course','auth']);
$routes->get('course_fetch','courseController::fetch',['filter'=>'auth']);
$routes->post('course_edit','courseController::edit',['filter'=>'auth']);
$routes->post('course_update','courseController::update',['filter'=>'auth']);
$routes->post('course_delete','courseController::delete',['filter'=>'auth']);

/**
 * User Routes
 */
$routes->get('userreg','userController::regView',);
$routes->post('user_store','userController::saveUser',['filter'=>'reguser']);
$routes->get('user_login','userController::loginController',);
$routes->get('user_index','userController::userIndex',['filter'=>'auth']);
$routes->get('/','userController::loginController');
$routes->post('user_logger','LoginController::login',['filter'=>'loginval']);
$routes->get('user_logout','LoginController::logout');
$routes->get('usercheck','LoginController::checkSession');


/**
 * client routes
 */

 $routes->get('clientlogin','ClientController::index');
 $routes->post('client/login','ClientController::logger');
 $routes->get('client/index','ClientController::indexView');
 $routes->get('client/course_fetch','courseController::fetch',['filter'=>'auth']);
 $routes->post('client/client_pay','OrderController::clientPay');
 $routes->post('client/course_edit','OrderController::payClick');
 $routes->post('client/verifyOrder','OrderController::verifyOrder');
 $routes->get('client/return','OrderController::returnOrder');

 /**
  * Order routes
  */

  $routes->get('orders/preorders','OrderController::fetchPreOrders',['filter'=>'auth']);
  $routes->get('order','OrderController::index',['filter'=>'auth']);
  $routes->get('orders/usercheck','LoginController::checkSession',['filter'=>'auth']);
  $routes->post('payhere_charging','OrderController::payhereCharging',['filter'=>'auth']);
  $routes->post('tochargingapi','OrderController::toChargingAPI');
  $routes->post('orders/findorder','OrderController::findOrder');
  $routes->get('orders/subcription','OrderController::subcriptionIndex');
  $routes->get('orders/getallsub','OrderController::getAllSubcription');
  $routes->post('orders/findSubscription','OrderController::findSubscription');
  $routes->post('orders/retrysub','OrderController::retrySub');
  $routes->post('orders/cancelSub','OrderController::cancelSub');
  $routes->post('orders/paymentRefund','OrderController::paymentRefund');












/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
