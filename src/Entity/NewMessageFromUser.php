<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 09:26
 */

namespace App\Entity;


use App\Notification\Notification;
use App\ValueObject\MessageId;
use App\ValueObject\UniqueId;
use App\ValueObject\UserId;

class NewMessageFromUser extends BaseNotification implements Notification
{
    /**
     * NewMessageFromUser constructor.
     * @param UniqueId $id
     * @param string $title
     * @param string $description
     * @param UserId $sender
     * @param UserId[] $recipients
     * @param MessageId $message
     * @param string $status
     */
    public function __construct(UniqueId $id, string $title, string $description, UserId $sender, array $recipients, MessageId $message, string $status = self::UNREAD)
    {
        parent::__construct($id, $title, $description, $recipients, $message, $status);

        $this->sender = $sender;
    }
}