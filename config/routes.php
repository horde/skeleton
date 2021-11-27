<?php
namespace Horde\Skeleton;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
/**
 * This is the routes configuration file.
 * You can define URL patterns relative to your
 * application's webroot (likely: /skeleton/)
 * and how the application should react on it.
 * 
 * The first argument is optional but SHOULD be
 * present and MUST be a unique string.
 * This is the route name to re-use when generating URLs.
 * 
 * The second argument (or first, if name is missing) is the URL pattern.
 * This can be a literal string or can contain optional parts and placeholders.
 * 
 * The third argument is an array controlling what happens when the route matches.
 * 
 * You MUST supply either a controller name or a stack.
 * 
 * A controller may be either a RequestHandlerInterface, a MiddlewareInterface
 * or a Horde_Controller. The latter is NOT recommended.
 * 
 * The controller is always called last after any middlewares.
 * 
 * The stack is an array of MiddlewareInterface class names or strings that
 * produce a list of MiddlewareInterface from the global injector.
 * 
 * An explicit, empty stack array means you wish no middlewares.
 * Omitting the stack attribute altogether means you want default middlewares,
 * trying to get the authenticated user from the session token etc. 
 * 
 * You may overload a route with multiple controllers by designing them as 
 * middlewares and having them inspect the request and decide if they want to
 * handle or delegate the request.
 * 
 * @see Horde\Routes\Mapper
 * 
 * @todo If no controller is present, try the route name as a class name
 *       possibly by some convention.
 * @todo Provide a DefaultMiddlewareStack for the overload scenario
 */

// The former canonical name of that route
$mapper->connect(
    'ListUi',
    '/list',
    [
        'controller' => Ui\ListItems::class,
    ]
);

// This is the defautl route in our app
$mapper->connect(
    'Index',
    '/*path',
    [
        'controller' => Ui\ListItems::class,
    ]
);
