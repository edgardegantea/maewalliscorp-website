<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->group('api', static function (RouteCollection $routes) {
    $routes->post('contact', 'Api\Contact::store');
    // $routes->post('support/tickets', 'Api\Support::store');
    $routes->post('chatbot/message', 'Api\Chatbot::message');
});

// Catch-all so client-side routing (if you add it) keeps working on refresh.
$routes->get('(:any)', 'Home::index');
