<?php
/**
 * Copyright 2010-2021 Horde LLC (http://www.horde.org/)
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
use Horde\Skeleton\Application;

 /* Determine the base directories. */
if (!defined('SKELETON_BASE')) {
    define('SKELETON_BASE', realpath(__DIR__ . '/..'));
}

if (!defined('HORDE_BASE')) {
    /* If Horde does not live directly under the app directory, the HORDE_BASE
     * constant should be defined in config/horde.local.php. */
    if (file_exists(SKELETON_BASE . '/config/horde.local.php')) {
        include SKELETON_BASE . '/config/horde.local.php';
    } else {
        define('HORDE_BASE', realpath(SKELETON_BASE . '/..'));
    }
}

/* Load the Horde Framework core (needed to autoload
 * Horde_Registry_Application::). */
require_once HORDE_BASE . '/lib/core.php';
/**
 * Skeleton Application Core under traditional location
 *
 * This class and the preceding conditional constant definitions are just
 * wrappers to ensure interop with older framework versions or with code
 * which does not know to call into the namespaced version directly.
 */
class Skeleton_Application extends Application
{
}
