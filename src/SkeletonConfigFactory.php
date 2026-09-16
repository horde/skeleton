<?php

declare(strict_types=1);
/**
 * Skeleton configuration class factory
 *
 * Creates instances of the SkeletonConfig class.
 *
 * Old pattern: globals $conf; $somethingDetail = $conf['something']['detail']; *
 * New pattern: $config = $injector->get(SkeletonConfig::class); $somethingDetail = $config->get('something.detail');
 *
 * Prefer DI over instantiating $config in your code.
 */

namespace Horde\Skeleton;

use Horde\Core\Config\ConfigLoader;
use Horde\Injector\Injector;

class SkeletonConfigFactory
{
    public function __construct(private Injector $injector) {}

    public function create(): SkeletonConfig
    {
        $state = $this->injector->get(ConfigLoader::class)->load('skeleton');
        return new SkeletonConfig($state->toArray());
    }
}
