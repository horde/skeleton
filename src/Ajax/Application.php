<?php
/**
 * Copyright 2012-2021 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.
 *
 * @author   Your Name <you@example.com>
 * @category Horde
 * @license  http://www.horde.org/licenses/gpl GPL
 * @package  Skeleton
 */
declare(strict_types=1);

namespace Horde\Skeleton\Ajax;

use Horde_Core_Ajax_Application;
use Horde_Core_Ajax_Application_Handler_Noop  as NoopHandler;

/**
 * Skeleton AJAX application API.
 *
 * This file defines the AJAX actions provided by this module. The primary
 * AJAX endpoint is represented by horde/services/ajax.php but that handler
 * will call the module specific actions defined in this class.
 *
 * @author    Your Name <you@example.com>
 * @category  Horde
 * @copyright 2012-2021 Horde LLC
 * @license   http://www.horde.org/licenses/gpl GPL
 * @package   Skeleton
 */
class Application extends Horde_Core_Ajax_Application
{
    /**
     * Application specific initialization tasks should be done in here.
     */
    protected function _init(): void
    {
        // This adds the 'noop' action to the current application.
        $this->addHandler(NoopHandler::class);
    }
}
