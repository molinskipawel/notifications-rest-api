<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 16.11.2018
 * Time: 12:08
 */

namespace App\ValueObject;


use Ramsey\Uuid\Uuid;

final class MessageId extends UniqueId
{
    public static function getUuidFromString(string $uuid)
    {
        return new self(Uuid::fromString($uuid));
    }


}