<?php
declare(strict_types=1);
namespace Horde\Skeleton\Test;
use Horde\Test\TestCase;
use Horde\Skeleton\SkeletonException;
use \Skeleton_Exception;
/**
 * @author     Ralf Lang <ralf.lang@ralf-lang.de>
 * @license    http://www.horde.org/licenses/gpl GPL
 * @category   Horde
 * @package    Skeleton
 * @subpackage UnitTests
 */
class ExceptionTest extends TestCase
{
    public function setUp(): void
    {
    }

    public function testException()
    {
        $this->expectException(SkeletonException::class);
        throw new SkeletonException();
    }

    public function tearDown(): void
    {
    }
}
