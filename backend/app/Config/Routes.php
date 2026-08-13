<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('sitemap.xml', 'Sitemap::index');

$routes->group('api', static function (RouteCollection $routes) {
    $routes->post('contact', 'Api\Contact::store');
    $routes->post('tickets', 'Api\Tickets::store');
    $routes->get('tickets/lookup', 'Api\Tickets::lookup');
    $routes->post('chatbot/message', 'Api\Chatbot::message');

    $routes->get('services', 'Api\Content::services');
    $routes->get('portfolio', 'Api\Content::portfolio');
    $routes->get('partners', 'Api\Content::partners');
    $routes->get('partners/(:segment)', 'Api\Content::partner/$1');
    $routes->get('settings', 'Api\Content::settings');
    $routes->get('process', 'Api\Content::process');
    $routes->get('faqs', 'Api\Content::faqs');
    $routes->get('legal/(:segment)', 'Api\Content::legalPage/$1');
});

$routes->group('admin', static function (RouteCollection $routes) {
    $routes->get('login', 'Admin\AuthController::login');
    $routes->post('login', 'Admin\AuthController::attempt');
    $routes->post('logout', 'Admin\AuthController::logout');

    $routes->get('/', 'Admin\DashboardController::index');

    $routes->get('messages', 'Admin\MessagesController::index');
    $routes->post('messages/(:num)/delete', 'Admin\MessagesController::delete/$1');

    $routes->get('services', 'Admin\ServicesController::index');
    $routes->get('services/create', 'Admin\ServicesController::create');
    $routes->post('services', 'Admin\ServicesController::store');
    $routes->get('services/(:num)/edit', 'Admin\ServicesController::edit/$1');
    $routes->post('services/(:num)/update', 'Admin\ServicesController::update/$1');
    $routes->post('services/(:num)/delete', 'Admin\ServicesController::delete/$1');

    $routes->get('portfolio', 'Admin\PortfolioController::index');
    $routes->get('portfolio/create', 'Admin\PortfolioController::create');
    $routes->post('portfolio', 'Admin\PortfolioController::store');
    $routes->get('portfolio/(:num)/edit', 'Admin\PortfolioController::edit/$1');
    $routes->post('portfolio/(:num)/update', 'Admin\PortfolioController::update/$1');
    $routes->post('portfolio/(:num)/delete', 'Admin\PortfolioController::delete/$1');

    $routes->get('partners', 'Admin\PartnersController::index');
    $routes->get('partners/create', 'Admin\PartnersController::create');
    $routes->post('partners', 'Admin\PartnersController::store');
    $routes->get('partners/(:num)/edit', 'Admin\PartnersController::edit/$1');
    $routes->post('partners/(:num)/update', 'Admin\PartnersController::update/$1');
    $routes->post('partners/(:num)/delete', 'Admin\PartnersController::delete/$1');

    $routes->get('settings', 'Admin\SettingsController::index');
    $routes->post('settings', 'Admin\SettingsController::update');

    $routes->get('process', 'Admin\ProcessController::index');
    $routes->get('process/create', 'Admin\ProcessController::create');
    $routes->post('process', 'Admin\ProcessController::store');
    $routes->get('process/(:num)/edit', 'Admin\ProcessController::edit/$1');
    $routes->post('process/(:num)/update', 'Admin\ProcessController::update/$1');
    $routes->post('process/(:num)/delete', 'Admin\ProcessController::delete/$1');

    $routes->get('faqs', 'Admin\FaqController::index');
    $routes->get('faqs/create', 'Admin\FaqController::create');
    $routes->post('faqs', 'Admin\FaqController::store');
    $routes->get('faqs/(:num)/edit', 'Admin\FaqController::edit/$1');
    $routes->post('faqs/(:num)/update', 'Admin\FaqController::update/$1');
    $routes->post('faqs/(:num)/delete', 'Admin\FaqController::delete/$1');

    $routes->get('legal/(:segment)', 'Admin\LegalController::edit/$1');
    $routes->post('legal/(:segment)', 'Admin\LegalController::update/$1');

    $routes->get('tickets', 'Admin\TicketsController::index');
    $routes->get('tickets/(:num)', 'Admin\TicketsController::show/$1');
    $routes->post('tickets/(:num)/update', 'Admin\TicketsController::update/$1');

    $routes->get('account', 'Admin\AccountController::index');
    $routes->post('account', 'Admin\AccountController::updateProfile');
    $routes->post('account/password', 'Admin\AccountController::updatePassword');
});

// Catch-all so client-side routing (if you add it) keeps working on refresh.
$routes->get('(:any)', 'Home::index');
