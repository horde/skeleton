<?php
/**
 * Copyright 2007-2021 Horde LLC (http://www.horde.org/)
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

/**
 * AbstractDriver defines an API for implementing storage backends for
 * Skeleton.
 *
 * @author    Your Name <you@example.com>
 * @category  Horde
 * @copyright 2007-2021 Horde LLC
 * @license   http://www.horde.org/licenses/gpl GPL
 * @package   Skeleton
 */
class AbstractDriver implements Driver
{
    /**
     * Hash containing connection parameters.
     *
     * @var array
     */
    protected $_params = [];

    /**
     * Array holding the current foo list. Each array entry is a hash
     * describing a foo. The array is indexed by the IDs.
     *
     * @var array
     */
    protected $_foos = [];

    /**
     * Constructor.
     *
     * @param array $params  A hash containing connection parameters.
     */
    public function __construct($params = [])
    {
        $this->_params = $params;
    }

    /**
     * Lists all foos.
     *
     * @return array  Returns a list of all foos.
     */
    public function listFoos(): array
    {
        return $this->_foos;
    }
}
