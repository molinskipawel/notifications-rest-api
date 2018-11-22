<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 16.11.2018
 * Time: 13:04
 */

namespace App\Tests\ValueObject;

use App\ValueObject\UniqueId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UniqueIdTest extends TestCase
{
    public function testSetUuid()
    {
        $uuid = Uuid::uuid4();
        $uuid_2 = Uuid::uuid4();

        $uniqueId = new UniqueId($uuid);

        $this->assertInstanceOf(UuidInterface::class, $uniqueId->id());
        $this->assertTrue($uniqueId->isEquals($uuid));
        $this->assertFalse($uniqueId->isEquals($uuid_2));
    }
}
