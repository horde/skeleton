<?php
declare(strict_types=1);
namespace Horde\Coronado\Test;
use Horde\Test\TestCase;
use Horde\Skeleton\SkeletonException;
use \Skeleton_Exception;
/**
 * @author     Ralf Lang <lang@b1-systems.de>
 * @license    http://www.horde.org/licenses/gpl GPL
 * @category   Horde
 * @package    Skeleton
 * @subpackage UnitTests
 */
class WrapperClassTest extends TestCase
{
    public function setUp(): void
    {
    }

    public function testException()
    {
        $this->expectException(SkeletonException::class);
        throw new SkeletonException();
    }
    public function testWrappedException()
    {
        $this->expectException(SkeletonException::class);
        throw new Skeleton_Exception();
    }

    public function tearDown(): void
    {
    }
}
