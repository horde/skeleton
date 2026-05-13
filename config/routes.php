<?php
namespace Horde\Skeleton;

use Horde\Core\Middleware\DefaultStack;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * This is the routes configuration file.
 *
 * You define URL patterns relative to your application's webroot
 * and how the application should react on them.
 *
 * Each route MUST declare its middleware stack explicitly:
 * - ->withMiddleware(DefaultStack::get()) for standard authenticated routes
 * - ->withMiddleware([...]) for custom stacks
 * - ->noMiddleware() for public routes that need no auth or error handling
 *
 * @see Horde\Routes\Mapper
 * @see Horde\Core\Middleware\DefaultStack
 */

$mapper->buildRoute(uri: '/list', name: 'ListUi')
    ->withController(Ui\ListItems::class)
    ->withMiddleware(DefaultStack::get())
    ->add();

// Default route — catch-all
$mapper->buildRoute(uri: '/*path', name: 'Index')
    ->withController(Ui\ListItems::class)
    ->withMiddleware(DefaultStack::get())
    ->add();
