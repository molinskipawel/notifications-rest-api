<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 16.11.2018
 * Time: 10:24
 */

namespace App\ValueObject;


use Ramsey\Uuid\Uuid;

final class NotificationId extends UniqueId
{
    public static function getUuidFromString(string $uuid)
    {
        return new self(Uuid::fromString($uuid));
    }


}