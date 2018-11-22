<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 09:27
 */

namespace App\Entity;


use App\Exception\MessageNoSendException;
use App\Exception\ShortTitleException;
use App\Exception\ToLongDescriptionException;
use App\Notification\Notification;
use App\ValueObject\MessageId;
use App\ValueObject\UniqueId;
use App\ValueObject\UserId;

abstract class BaseNotification implements Notification
{
    const READ = 'read';
    const UNREAD = 'unread';
    const PORTAL_UUID = 'c4e1268c-6d00-4e1e-b3dc-8a403c335b76';

    /**
     * @var UniqueId
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \DateTime
     */
    protected $sendDateTime = null;

    /**
     * @var UserId
     */
    protected $sender;

    /**
     * @var UserId[]
     */
    protected $recipients = array();

    /**
     * @var MessageId
     */
    protected $message;

    /**
     * @var string
     */
    protected $status = self::UNREAD;

    /**
     * BaseNotification constructor.
     * @param UniqueId $id
     * @param string $title
     * @param string $description
     * @param UserId[] $recipients
     * @param MessageId $message
     * @param string $status
     */
    public function __construct(UniqueId $id, string $title, string $description, array $recipients, MessageId $message, string $status = self::UNREAD)
    {
        $this->id = $id;
        if (strlen($title) >= 3) {
            $this->title = $this;
        } else {
            throw new ShortTitleException('Title length minimum 3 characters');
        }
        if (strlen($description) <= 100) {
            $this->description = $description;
        } else {
            throw new ToLongDescriptionException('Description is to long. Maximum 100 characters');
        }
        $this->recipients = $recipients;
        $this->message = $message;
        $this->status = $status;
    }

    public function markAsRead()
    {
        $this->status = self::READ;
    }

    public function markAsUnread()
    {
        $this->status = self::UNREAD;
    }

    public function send()
    {
        $this->sendDateTime = new \DateTime();
    }

    /**
     * @return UniqueId
     */
    public function getId(): UniqueId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return \DateTime
     * @throws MessageNoSendException
     */
    public function getSendDateTime(): \DateTime
    {
        if(null === $this->sendDateTime) {
            throw new MessageNoSendException('No date send notification, because notification no send.');
        }
        return $this->sendDateTime;
    }

    /**
     * @return UserId
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return array
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }



}