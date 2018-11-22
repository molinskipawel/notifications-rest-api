<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 09:26
 */

namespace App\Entity;


use App\Exception\InvalidPriorityException;
use App\Notification\Notification;
use App\ValueObject\MessageId;
use App\ValueObject\UniqueId;
use App\ValueObject\UserId;

class NewMessageFromSystem extends BaseNotification implements Notification
{
    const PRIORITY_MIN = 0;
    const PRIORITY_MAX = 255;

    /**
     * @var int
     */
    private $priority;

    /**
     * NewMessageFromUser constructor.
     * @param UniqueId $id
     * @param string $title
     * @param string $description
     * @param UserId[] $recipients
     * @param MessageId $message
     * @param int $priority
     * @param string $status
     */
    public function __construct(UniqueId $id, string $title, string $description, array $recipients, MessageId $message, int $priority, string $status = self::UNREAD)
    {
        parent::__construct($id, $title, $description, $recipients, $message, $status);

        $this->sender = UserId::getUuidFromString(self::PORTAL_UUID);

        if($priority > self::PRIORITY_MIN && $priority <= self::PRIORITY_MAX)
        {
            $this->priority = $priority;
        }else{
            throw new InvalidPriorityException(sprintf('Invalid priority argument. Range %d to %d', self::PRIORITY_MIN, self::PRIORITY_MAX));
        }
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }


}