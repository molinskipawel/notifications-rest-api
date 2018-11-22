<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 16.11.2018
 * Time: 12:20
 */

namespace App\ValueObject;


use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UniqueId
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * UniqueId constructor.
     * @param UuidInterface $uuid
     */
    public function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function getUuidFromString(string $uuid)
    {
        return new self(Uuid::fromString($uuid));
    }

    public function isEquals(UuidInterface $uuid)
    {
        return $this->uuid->equals($uuid);
    }

    public function id()
    {
        return $this->uuid;
    }

}