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

namespace Horde\Skeleton\Driver;

use Horde_Core_Factory_Injector;
use Horde\Injector\Injector;
use Horde\Exception\HordeException;
use Horde\Skeleton\SkeletonException;
use Horde\Util\HordeString;

/**
 * Skeleton_Driver factory.
 *
 * @author    Your Name <you@example.com>
 * @category  Horde
 * @copyright 2010-2021 Horde LLC
 * @license   http://www.horde.org/licenses/gpl GPL
 * @package   Skeleton
 */
class DriverFactory extends Horde_Core_Factory_Injector
{
    /**
     * @var array
     */
    private $instances = [];

    /**
     * Return an Skeleton\Driver instance.
     *
     * @return Driver
     */
    public function create(Injector $injector): Driver
    {
        $params = [];
        $driver = HordeString::ucfirst($GLOBALS['conf']['storage']['driver']);
        $signature = serialize([$driver, $GLOBALS['conf']['storage']['params']['driverconfig']]);
        if (empty($this->instances[$signature])) {
            switch ($driver) {
            case 'Sql':
                try {
                    if ($GLOBALS['conf']['storage']['params']['driverconfig'] == 'horde') {
                        $db = $injector->get('Horde_Db_Adapter');
                    } else {
                        $db = $injector->get('Horde_Core_Factory_Db')
                            ->create('skeleton', 'storage');
                    }
                } catch (HordeException $e) {
                    throw new SkeletonException($e);
                }
                $params = ['db' => $db];
                break;
            case 'Ldap':
                try {
                    $params = ['ldap' => $injector->get('Horde_Core_Factory_Ldap')->create('skeleton', 'storage')];
                } catch (HordeException $e) {
                    throw new SkeletonException($e);
                }
                break;
            }
            $class = 'Skeleton_Driver_' . $driver;
            $this->instances[$signature] = new $class($params);
        }

        return $this->instances[$signature];
    }
}
