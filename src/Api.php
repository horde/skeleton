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

namespace Horde\Skeleton;

use Horde_Registry_Api;

/**
 * Skeleton external API.
 *
 * This file defines Skeleton's external API interface. Other applications can
 * interact with Skeleton through this API.
 *
 * @author    Your Name <you@example.com>
 * @category  Horde
 * @copyright 2010-2021 Horde LLC
 * @license   http://www.horde.org/licenses/gpl GPL
 * @package   Skeleton
 */
class Api extends Horde_Registry_Api
{
    /**
     * Example API method.
     * 
     * The default configuration presented in doc/registry.d/app-skeleton.php
     * exposes skeleton's API as the fooitemapi.
     * 
     * Consumers can call into this API via registry
     * 
     * $registry->call('fooitemapi/getFoo') would return an array.
     * $registry->fooitemapi->getFoo() would do the same.
     * 
     * The registry is case sensitive.
     * 
     * Registry API methods are by default also available
     * through the XMLRPC and json-rpc interfaces and also SOAP
     *
     * @return string[]
     */
    public function getFoo(): array
    {
        return ['foo', 'bar'];
    }
}
