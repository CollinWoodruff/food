<?php
/**
 * Created by PhpStorm.
 * User: Collin Woodruff
 * Date: 1/14/2019
 * Time: 10:10 AM
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload
require_once('vendor/autoload.php');

//Create an instance of the Base Class
$f3 = Base::instance();

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//Define a default route
$f3->route('GET /', function() {
    echo '<h1>My Fav Foods!</h1>';

    $view = new View;
    echo $view->render('views/home.html');
});

//Define a breakfast route
$f3->route('GET /breakfast', function() {
    $view = new View();
    echo $view->render('views/breakfast.html');
});

//Define a lunch route
$f3->route('GET /lunch', function() {
    $view = new View();
    echo $view->render('views/lunch.html');
});

//Define a lunch route
$f3->route('GET /dinner', function() {
    $view = new View();
    echo $view->render('views/dinner.html');
});

//Define a lunch route
$f3->route('GET /tacos', function() {
    $view = new View();
    echo $view->render('views/tacos.html');
});

//Define a lunch route
$f3->route('GET /sushi', function() {
    $view = new View();
    echo $view->render('views/sushi.html');
});

//Define a lunch route
$f3->route('GET /chicken', function() {
    $view = new View();
    echo $view->render('views/chicken.html');
});

//Define a route with multiple parameters
$f3->route('GET /@meal', function($f3, $params) {
    print_r($params);
    echo "<h3>I like " . $params['food'] . "!";
});

//Define a route with multiple parameters
$f3->route('GET /@meal/@food', function($f3, $params) {
    print_r($params);
    echo "<h3>I like " . $params['food'] . " for " . $params['meal'] . "!";
});

//Define a lunch route
$f3->route('GET /order', function() {
    $view = new View();
    echo $view->render('views/form.html');
});

//Define a lunch route
$f3->route('POST /order-process', function($f3) {
    print_r($_POST);

    $food = $_POST['food'];
    echo "You like $food";

    if($food =="tacos") {
        $f3->reroute("tacos");
    }
    else if($food == 'sushi') {
        $f3->reroute("sushi");
    }
    else if($food == 'chicken') {
        $f3->reroute('chicken');
    }
    else {
        $f3->reroute("");

        //display a 404 error
        $f3->error(404);
    }
});

//Run fat free
$f3->run();