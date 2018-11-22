<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 10:05
 */

namespace App\Tests\Entity;

use App\Entity\NewMessageFromUser;
use App\Exception\MessageNoSendException;
use App\ValueObject\MessageId;
use App\ValueObject\UniqueId;
use App\ValueObject\UserId;
use PHPUnit\Framework\TestCase;

class NewMessageFromUserTest extends TestCase
{
    const UNIQUE_ID_UUID_1 = '9e3f9b86-6ac0-4902-bd21-a04dff433da6';
    const TITLE_1 = 'Tytuł testowy';
    const DESCRIPTION_1 = 'Opis testowy';
    const SENDER_USER_ID_UUID_1 = '06fa4f8e-fd29-44bb-951b-2f6502de019e';
    const RECIPIENT_USER_ID_UUID_1 = '06fa4f8e-fd29-44bb-951b-2f6502de019e';
    const MESSAGE_ID_UUID_1 = '015f4ece-7b46-41c4-9895-811e33634edf';

    const UNIQUE_ID_UUID_2 = 'c9e2f2e5-0cae-43b9-97f4-a992115a2d3e';

    const USER_ID_UUID_1 = '06fa4f8e-fd29-44bb-951b-2f6502de019e';

    const NOTIFICATION_READ = 'read';
    const NOTIFICATION_UNREAD = 'unread';

    /**
     * @var NewMessageFromUser
     */
    private $newMessageFromUser;

    protected function setUp()
    {
//        UniqueId $id, string $title, string $description, array $recipients, MessageId $message, string $status = self::UNREAD)
        $id = UniqueId::getUuidFromString(self::UNIQUE_ID_UUID_1);
        $sender = UserId::getUuidFromString(self::SENDER_USER_ID_UUID_1);
        $recipient = [
            UserId::getUuidFromString(self::USER_ID_UUID_1)
        ];
        $messageId = MessageId::getUuidFromString(self::MESSAGE_ID_UUID_1);

        $this->newMessageFromUser = new NewMessageFromUser($id, self::TITLE_1, self::DESCRIPTION_1, $sender, $recipient, $messageId);
    }

    public function testMarkAsUnread()
    {
        $this->newMessageFromUser->markAsUnread();
        $this->assertEquals(self::NOTIFICATION_UNREAD, $this->newMessageFromUser->getStatus());
    }

    public function testMarkAsRead()
    {
        $this->newMessageFromUser->markAsRead();
        $this->assertEquals(self::NOTIFICATION_READ, $this->newMessageFromUser->getStatus());
    }

    public function testSend()
    {
        $reflection = new \ReflectionClass($this->newMessageFromUser);
        $property = $reflection->getProperty('sendDateTime');
        $property->setAccessible(true);
        $sendDateTime = $property->getValue($this->newMessageFromUser);

        $this->assertNull($sendDateTime);

        $this->newMessageFromUser->send();
        $this->assertInstanceOf('DateTime', $this->newMessageFromUser->getSendDateTime());
    }

    public function testGetId()
    {
        $this->assertInstanceOf('App\ValueObject\UniqueId', $this->newMessageFromUser->getId());
    }

    public function testGetMessage()
    {
        $this->assertInstanceOf('App\ValueObject\MessageId', $this->newMessageFromUser->getMessage());
    }

    public function testGetTitle()
    {
        $this->assertEquals(self::UNIQUE_ID_UUID_1, $this->newMessageFromUser->getId()->id()->toString());
    }

    public function testGetSendDateTime()
    {
        $reflection = new \ReflectionClass($this->newMessageFromUser);
        $property = $reflection->getProperty('sendDateTime');
        $property->setAccessible(true);
        $sendDateTime = $property->getValue($this->newMessageFromUser);

        $this->assertNull($sendDateTime);
    }

    public function testExceptionGetSendDateTime()
    {
        $this->expectException(MessageNoSendException::class);

        $this->newMessageFromUser->getSendDateTime();
    }

    public function testGetDescription()
    {
        $this->assertEquals(self::DESCRIPTION_1, $this->newMessageFromUser->getDescription());
    }

    public function testGetRecipients()
    {
        $recipients = $this->newMessageFromUser->getRecipients();
        $this->assertCount(1, $recipients);
        $this->assertInstanceOf('App\ValueObject\UserId', $recipients[0]);
    }

    public function testGetSender()
    {
        $this->assertInstanceOf('App\ValueObject\UserId', $this->newMessageFromUser->getSender());
    }

    public function testGetStatus()
    {
        $this->assertEquals(self::NOTIFICATION_UNREAD, $this->newMessageFromUser->getStatus());
    }
}
