<?php
/**
 * This is an illustrational example on how to convert
 * traditional page files outside the /lib or /src path to
 * controllers behind routes.
 *
 * The namespace Ui has no code-by-convention or
 * other specific benefit. It could also be "App", "Controller",
 * "Middleware" or, by the presentation type, "Ui" or it could all
 * go to the main namespace.
 *
 * When starting from scratch, you might not want to follow
 * this example to the letter.
 *
 * This example will be changed when Core libraries get upgraded
 * to natively support Controllers.
 *
 * I chose the MiddlewareInterface over the HandlerInterface
 * because the handler does not have any intrinsic benefits and
 * it is simpler to just go with ony type for both controllers and
 * middlewares/filters.
 *
 * The framework understands MiddlewareInterface, HandlerInterface and
 * traditional Horde_Controller in the 'controller' attribute and it also
 * works fine omitting the controller attribute altogether and just putting
 * everything in the middleware list. However, this would remove any default
 * middleware stack, including authentication.
 */
declare(strict_types=1);

namespace Horde\Skeleton\Ui;

/**
 * Any use of the injector inside the controller should be questioned
 *
 * This is a sign of imperfect design or need for further refactoring
 * of the framework.
 */
use Horde\Injector\Injector;

/**
 * The standard PSR-7/PSR-15/PSR-17 fare.
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * I doubt we should rely on the Horde:: shortcuts going forward
 */
use Horde;
use Horde\Skeleton\SkeletonException;

/**
 * PageOutput should not echo by default but return strings or streams.
 * It should be up to the caller to decide where output goes.
 * Also, it makes many assumptions on context, mandatory JS, etc.
 *
 * However, it is central to the theme handling logic and other central parts
 * like the topbar generation which need to be broken into separate classes.
 */
use Horde_PageOutput;
/**
 * The traditional registry has too much carryover from pre-autoloader days,
 * solves bootstrapping chicken/egg problems and does littles bit of everything,
 * including management of the currently authenticated user, the session,
 * the locale, bits of page access control... and with very liberal interfaces.
 */
use Horde_Registry;

/**
 *
 */
use Horde_Session;
/**
 * Traditional use of Horde_View is very liberal, using undeclared properties
 * all over the place. This allows for rapid development but the downside is
 * limited potential for type or tool-assisted bug prevention.
 */
use Horde_View;
use Horde_View_Base;
use Horde_Log_Logger;
use Horde\Log\Logger;
use Horde_Notification;
use Horde_Notification_Handler;
use Psr\Http\Message\StreamInterface;

/**
 * Controller class for List Items UI
 *
 * This is the equivalent of the H5 skeleton's skeleton/list.php page file
 * We could not name it List as this is a forbidden class name and
 * we did not want to append Middleware, Controller, Page etc by choice
 * and to demonstrate there is no magic behind - you may feel different
 */
class ListItems implements MiddlewareInterface
{
    protected ResponseFactoryInterface $responseFactory;
    protected StreamFactoryInterface $streamFactory;
    protected Injector $injector;
    protected Horde_Session $session;
    protected Horde_Registry $registry;
    protected Horde_PageOutput $page_output;
    protected Horde_View $view;
    protected Horde_Notification_Handler $notification;
    protected Horde_Log_Logger $logger;

    /**
     * Constructor.
     *
     * This should be reusable for a lot of UI cases.
     * Maybe it could be factored out to a trait or base class.
     *
     * @param ResponseFactoryInterface $responseFactory
     * @param StreamFactoryInterface $streamFactory
     * @param Injector $injector
     * @param Horde_Registry $registry
     * @param Horde_Session $session
     * @param Horde_PageOutput $page_output
     * @param Horde_View $view
     * @param Horde_Log_Logger $logger
     */
    public function __construct(
        ResponseFactoryInterface $responseFactory,
        StreamFactoryInterface $streamFactory,
        Injector $injector,
        Horde_Registry $registry,
        Horde_Session $session,
        Horde_PageOutput $page_output,
        Horde_View_Base $view,
//        Horde_Notification_Handler $notification,
        Horde_Log_Logger $logger
    ) {
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
        $this->injector = $injector;
        $this->registry = $registry;
        $this->session = $session;
        $this->page_output = $page_output;
        $this->view = $view;
        $this->logger = $logger;
  //      $this->notification = $notification;
    }

    /**
     * Process the incoming request.
     *
     *
     *
     * @see \Psr\Http\Server\MiddlewareInterface for concept
     * @param ServerRequestInterface $request The request might be amended or modified
     *                                        by previous middlewares
     * @param RequestHandlerInterface $handler We might refuse to deliver and ask the handler
     *                                         to either process the request himself or delegate
     *                                         to the next middleware (or a child handler).
     *                                         This might be useful to connect multiple presentations
     *                                         to the same route and let the presentation decide if it is
     *                                         responsible or not (Traditional/Dynamic/Mobile)
     *
     * @return ResponseInterface The response will bubble up through the chain
     *                           of previous middleware before being sent
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /* Naive approach. We will always return either a stream and return code 200,
         * an application-native exception and returncode 500 (this may be customized further)
         * or let other exceptions pass for other layers to process
         *
         */
        $returnCode = 200;
        $stream = null;

        try {
            $stream = $this->buildResponseStream($request);
        } catch (SkeletonException $e) {
            $stream = $this->handleNativeException($e, $request);
            // Manipulate return code and body for application-level exceptions
            // Everything else will just bubble up to an error handler middleware
            // and need not be handled here.
            $returnCode = 500;
        } finally {
            // Stop the output buffer
            ob_end_clean();
            if (!$stream) {
                return $handler->handle($request);
            }
        }
        return $this->responseFactory->createResponse($returnCode)->withBody($stream);
    }

    protected function buildResponseStream(ServerRequestInterface $request): ?StreamInterface
    {
        // This is literally the list.php content, only adopted as needed

        // Capture any output. This allows us to use the legacy Page_Output
        // Also, we prevent leaking any unintended output before the headers are sent
        ob_start();
        // This is literally the list.php content, only adopted as needed
        $page_output = $this->page_output;
        $view = $this->view;
        $view->header = _("Header");
        $view->content = _("Some Content");
        $view->list = [
            ['One', 'Foo'],
            ['Two', 'Bar'],
        ];

        /* Load JavaScript for sortable table. */
        $page_output->addScriptFile('tables.js', 'horde');

        /* Here starts the actual page output. First we output the complete HTML
            * header, CSS files, the topbar menu, and the sidebar menu. */
        $page_output->header([
            'title' => _("List"),
        ]);

        /* Next we output any notification messages. This is not done automatically
            * because on some pages you might not want to have notifications. */
//        $this->notification->notify(['listeners' => 'status']);

        /* Here goes the actual content of your application's page. This could be
            * Horde_View output, a rendered Horde_Form, or any other arbitrary HTML
            * output. */
        echo $view->render('list');

        /* Finally the HTML content is closed and JavaScript files are loaded. */
        $page_output->footer();
        $content = ob_get_contents();
        if ($content) {
            return $this->streamFactory->createStream($content);
        }
        throw new SkeletonException('Could not render page');
    }

    protected function handleNativeException(SkeletonException $e, $request): ?StreamInterface
    {
        return $this->streamFactory->createStream('An error occured: ');
    }
}
