<?php

declare(strict_types=1);
/**
 * Skeleton configuration class
 *
 * Provides access to the Skeleton configuration settings.
 *
 * Old pattern: globals $conf; $somethingDetail = $conf['something']['detail']; *
 * New pattern: $config = $injector->get(SkeletonConfig::class); $somethingDetail = $config->get('something.detail');
 *
 * Prefer DI over instantiating $config in your code.
 */

namespace Horde\Skeleton;

use Horde\Core\Config\State;
use Horde\Injector\Attribute\Factory;

#[Factory(factory: SkeletonConfigFactory::class, method: 'create')]
class SkeletonConfig extends State {}
