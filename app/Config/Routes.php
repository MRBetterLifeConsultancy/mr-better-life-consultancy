<?php
namespace Config;
// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) 
{
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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ["filter" => "user-auth"]);
$routes->get('', 'Home::index', ["filter" => "user-auth"]);

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) 
{
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

// creating groups of urls
$routes->group("h", ["filter" => "user-auth"], function ($routes)
{
    $routes->get("", "Home::index");
    $routes->get("login", "Home::login");
    $routes->get("login/(:any)", "Home::login/$1");
    $routes->post("login/(:any)", "Home::login/$1");

    $routes->get("admin_login", "Home::admin_login");
    $routes->get("admin_login/(:any)", "Home::admin_login/$1");
    $routes->post("admin_login/(:any)", "Home::admin_login/$1");

    $routes->get("view_all_regions", "Home::view_all_regions");
    $routes->get("view_all_regions/(:any)", "Home::view_all_regions/$1");
    $routes->post("view_all_regions/(:any)", "Home::view_all_regions/$1");

    // $routes->get("view_region", "Home::view_region");
    $routes->get("view_region/(:any)", "Home::view_region/$1");
    $routes->post("view_region/(:any)", "Home::view_region/$1");

    $routes->get("view_all_services", "Home::view_service");
    $routes->get("view_service/(:any)", "Home::view_service/$1");
    $routes->post("view_service/(:any)", "Home::view_service/$1");

    $routes->get("universities", "Home::universities");
    $routes->get("universities/(:any)", "Home::universities/$1");
    $routes->post("universities/(:any)", "Home::universities/$1");

    $routes->get("view_university", "Home::view_university");
    $routes->get("view_university/(:any)", "Home::view_university/$1");
    $routes->post("view_university/(:any)", "Home::view_university/$1");

    $routes->get("view_loans", "Home::view_loans");
    $routes->get("view_loans/(:any)", "Home::view_loans/$1");
    $routes->post("view_loans/(:any)", "Home::view_loans/$1");
    
    $routes->get("create_prospect", "Home::create_prospect");
    $routes->get("create_prospect/(:any)", "Home::create_prospect/$1");
    $routes->post("create_prospect/(:any)", "Home::create_prospect/$1");

    $routes->get("contact", "Home::contact");
    $routes->get("contact/(:any)", "Home::contact/$1");
    $routes->post("contact/(:any)", "Home::contact/$1");

    $routes->get("about", "Home::about");
    $routes->get("about/(:any)", "Home::about/$1");
    $routes->post("about/(:any)", "Home::about/$1");

    $routes->get("login", "Home::login");
    $routes->get("login/(:any)", "Home::login/$1");
    $routes->post("login/(:any)", "Home::login/$1");

    $routes->get("register", "Home::register");
    $routes->get("register/(:any)", "Home::register/$1");
    $routes->post("register/(:any)", "Home::register/$1");

    $routes->post("ajax_request", "Home::ajax_request");
    $routes->post("ajax_request/(:any)", "Home::ajax_request/$1");
});

$routes->group("u", ["filter" => "login-auth"], function ($routes)
{
    // Home page
    $routes->get("", "User::index");
    $routes->get("home", "User::index");

    // User dashboard
    $routes->get("", "User::index");
    $routes->get("dashboard", "User::dashboard");
    $routes->get("dashboard/(:any)", "User::dashboard/$1");

    $routes->get("view_region", "User::view_region");
    $routes->get("view_region/(:any)", "User::view_region/$1");
    $routes->post("view_region/(:any)", "User::view_region/$1");

    $routes->get("view_all_services", "User::view_service");
    $routes->get("view_service/(:any)", "User::view_service/$1");
    $routes->post("view_service/(:any)", "User::view_service/$1");

    $routes->get("universities", "User::universities");
    $routes->get("universities/(:any)", "User::universities/$1");
    $routes->post("universities/(:any)", "User::universities/$1");

    $routes->get("view_university", "User::view_university");
    $routes->get("view_university/(:any)", "User::view_university/$1");
    $routes->post("view_university/(:any)", "User::view_university/$1");

    $routes->get("view_loans", "User::view_loans");
    $routes->get("view_loans/(:any)", "User::view_loans/$1");
    $routes->post("view_loans/(:any)", "User::view_loans/$1");
    
    $routes->get("about", "User::about");
    $routes->get("about/(:any)", "User::about/$1");
    $routes->post("about/(:any)", "User::about/$1");

    $routes->get("contact", "User::contact");
    $routes->get("contact/(:any)", "User::contact/$1");
    $routes->post("contact/(:any)", "User::contact/$1");

    $routes->get("create_prospect", "Home::create_prospect");
    $routes->get("create_prospect/(:any)", "Home::create_prospect/$1");
    $routes->post("create_prospect/(:any)", "Home::create_prospect/$1");

    // user profile routes
    $routes->get("profile", "User::profile");
    $routes->get("profile/(:any)", "User::profile/$1");
    $routes->post("profile/(:any)", "User::profile/$1");

    // routes for user to logout
    $routes->get("logout", "User::logout");
    $routes->get("logout/(:any)", "User::logout/$1");

    // ajax request routes
    $routes->post("ajax_request", "User::ajax_request");
    $routes->post("ajax_request/(:any)", "User::ajax_request/$1");
});

$routes->group("a", ["filter" => "login-auth"], function ($routes)
{
    $routes->get("", "Admin::index");
    $routes->get("dashboard", "Admin::dashboard");
    $routes->get("dashboard/(:any)", "Admin::dashboard/$1");

    $routes->get("profile", "Admin::profile");
    $routes->get("profile/(:any)", "Admin::profile/$1");
    $routes->post("profile/(:any)", "Admin::profile/$1");

    // Routes to prospect pages
    $routes->get("create_prospect", "Admin::create_prospect");
    $routes->get("create_prospect/(:any)", "Admin::create_prospect/$1");
    $routes->post("create_prospect/(:any)", "Admin::create_prospect/$1");
    $routes->get("view_edit_prospects", "Admin::view_edit_prospects");
    $routes->get("view_edit_prospects/(:any)", "Admin::view_edit_prospects/$1");
    $routes->post("view_edit_prospects/(:any)", "Admin::view_edit_prospects/$1");
    $routes->get("deleted_prospects", "Admin::deleted_prospects");
    $routes->get("deleted_prospects/(:any)", "Admin::deleted_prospects/$1");
    $routes->post("deleted_prospects/(:any)", "Admin::deleted_prospects/$1");

    // Routes to user management pages
    $routes->get("create_user", "Admin::create_user");
    $routes->get("create_user/(:any)", "Admin::create_user/$1");
    $routes->post("create_user/(:any)", "Admin::create_user/$1");
    $routes->get("view_edit_users", "Admin::view_edit_users");
    $routes->get("view_edit_users/(:any)", "Admin::view_edit_users/$1");
    $routes->post("view_edit_users/(:any)", "Admin::view_edit_users/$1");
    $routes->get("deleted_users", "Admin::deleted_users");
    $routes->get("deleted_users/(:any)", "Admin::deleted_users/$1");
    $routes->post("deleted_users/(:any)", "Admin::deleted_users/$1");

    // Routes to region management pages
    $routes->get("create_region", "Admin::create_region");
    $routes->get("create_region/(:any)", "Admin::create_region/$1");
    $routes->post("create_region/(:any)", "Admin::create_region/$1");
    $routes->get("view_edit_regions", "Admin::view_edit_regions");
    $routes->get("view_edit_regions/(:any)", "Admin::view_edit_regions/$1");
    $routes->post("view_edit_regions/(:any)", "Admin::view_edit_regions/$1");
    $routes->get("deleted_regions", "Admin::deleted_regions");
    $routes->get("deleted_regions/(:any)", "Admin::deleted_regions/$1");
    $routes->post("deleted_regions/(:any)", "Admin::deleted_regions/$1");

    // Routes to university management pages
    $routes->get("create_university", "Admin::create_university");
    $routes->get("create_university/(:any)", "Admin::create_university/$1");
    $routes->post("create_university/(:any)", "Admin::create_university/$1");
    $routes->get("view_edit_universities", "Admin::view_edit_universities");
    $routes->get("view_edit_universities/(:any)", "Admin::view_edit_universities/$1");
    $routes->post("view_edit_universities/(:any)", "Admin::view_edit_universities/$1");
    $routes->get("deleted_universities", "Admin::deleted_universities");
    $routes->get("deleted_universities/(:any)", "Admin::deleted_universities/$1");
    $routes->post("deleted_universities/(:any)", "Admin::deleted_universities/$1");

    // Routes to university course management pages
    $routes->get("create_university_course", "Admin::create_university_course");
    $routes->get("create_university_course/(:any)", "Admin::create_university_course/$1");
    $routes->post("create_university_course/(:any)", "Admin::create_university_course/$1");
    $routes->get("view_edit_university_courses", "Admin::view_edit_university_courses");
    $routes->get("view_edit_university_courses/(:any)", "Admin::view_edit_university_courses/$1");
    $routes->post("view_edit_university_courses/(:any)", "Admin::view_edit_university_courses/$1");
    $routes->get("deleted_university_courses", "Admin::deleted_university_courses");
    $routes->get("deleted_university_courses/(:any)", "Admin::deleted_university_courses/$1");
    $routes->post("deleted_university_courses/(:any)", "Admin::deleted_university_courses/$1");

    // Routes to testimonial management pages
    $routes->get("create_testimonial", "Admin::create_testimonial");
    $routes->get("create_testimonial/(:any)", "Admin::create_testimonial/$1");
    $routes->post("create_testimonial/(:any)", "Admin::create_testimonial/$1");
    $routes->get("view_edit_testimonials", "Admin::view_edit_testimonials");
    $routes->get("view_edit_testimonials/(:any)", "Admin::view_edit_testimonials/$1");
    $routes->post("view_edit_testimonials/(:any)", "Admin::view_edit_testimonials/$1");
    $routes->get("deleted_testimonials", "Admin::deleted_testimonials");
    $routes->get("deleted_testimonials/(:any)", "Admin::deleted_testimonials/$1");
    $routes->post("deleted_testimonials/(:any)", "Admin::deleted_testimonials/$1");

    $routes->get("logout", "Admin::logout");
    $routes->get("logout/(:any)", "Admin::logout/$1");
    $routes->post("ajax_request", "Admin::ajax_request");
    $routes->post("ajax_request/(:any)", "Admin::ajax_request/$1");
});