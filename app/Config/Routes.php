<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->get('/', 'HomeController::index');

$routes->get('/admin/user-management', 'UsersController::index');
$routes->get('/admin/add_user', 'UsersController::addUser');
$routes->post('/user/storeUser', 'UsersController::storeUser');
$routes->get('/user/deleteUser/(:num)', 'UsersController::deleteUser/$1');
$routes->get('/user/editUser/(:num)', 'UsersController::editUser/$1');
$routes->put('/user/updateUser/(:num)', 'UsersController::updateUser/$1');

$routes->get('/admin/customer-management', 'CustomersController::index');
$routes->get('/admin/add_customer', 'CustomersController::addCustomer');
$routes->post('/customer/storeCustomer', 'CustomersController::storeCustomer');
$routes->get('/customer/deleteCustomer/(:num)', 'CustomersController::deleteCustomer/$1');
$routes->get('/customer/editCustomer/(:num)', 'CustomersController::editCustomer/$1');
$routes->put('/customer/updateCustomer/(:num)', 'CustomersController::updateCustomer/$1');

$routes->get('/admin/supply-inventory', 'SupplyInventoryController::index');
$routes->post('/supply/storeSupply', 'SupplyInventoryController::storeSupply');
$routes->put('/supply/updateSupply/(:num)', 'SupplyInventoryController::updateSupply/$1');
$routes->get('/supply/deleteSupply/(:num)', 'SupplyInventoryController::deleteSupply/$1');

$routes->get('/admin/laundry-services', 'LaundryServicesController::index');
$routes->post('/laundry-service/storeLaundryService', 'LaundryServicesController::storeLaundryService');
$routes->get('/laundry-service/deleteLaundryService/(:num)', 'LaundryServicesController::deleteLaundryService/$1');

$routes->get('/admin/new-laundry', 'TransactionController::index');
$routes->get('/laundry/laundry-transaction/(:num)', 'TransactionController::laundryTransaction/$1');
$routes->post('/laundry-transaction/storeLaundryTransaction/(:num)', 'TransactionController::storeLaundryTransaction/$1');




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
