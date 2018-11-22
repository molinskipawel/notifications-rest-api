<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 11:01
 */

namespace App\Tests\Entity;

use App\Entity\NewMessageFromSystem;
use App\Entity\NewMessageFromUser;
use App\Exception\InvalidPriorityException;
use App\Exception\MessageNoSendException;
use App\ValueObject\MessageId;
use App\ValueObject\UniqueId;
use App\ValueObject\UserId;
use PHPUnit\Framework\TestCase;

class NewMessageFromSystemTest extends TestCase
{
    const UNIQUE_ID_UUID_1 = '9e3f9b86-6ac0-4902-bd21-a04dff433da6';
    const TITLE_1 = 'Tytuł testowy';
    const DESCRIPTION_1 = 'Opis testowy';
    const SENDER_USER_ID_UUID_1 = '06fa4f8e-fd29-44bb-951b-2f6502de019e';
    const RECIPIENT_USER_ID_UUID_1 = '06fa4f8e-fd29-44bb-951b-2f6502de019e';
    const MESSAGE_ID_UUID_1 = '015f4ece-7b46-41c4-9895-811e33634edf';

    const PORTAL_UUID = 'c4e1268c-6d00-4e1e-b3dc-8a403c335b76';

    const UNIQUE_ID_UUID_2 = 'c9e2f2e5-0cae-43b9-97f4-a992115a2d3e';

    const USER_ID_UUID_1 = '06fa4f8e-fd29-44bb-951b-2f6502de019e';

    const NOTIFICATION_READ = 'read';
    const NOTIFICATION_UNREAD = 'unread';

    const NOTIFICATION_PRIORITY = 100;
    const NOTIFICATION_PRIORITY_MIN = 0;
    const NOTIFICATION_PRIORITY_MAX = 255;


    /**
     * @var NewMessageFromSystem
     */
    private $newMessageFromSystem;

    protected function setUp()
    {
        $id = UniqueId::getUuidFromString(self::UNIQUE_ID_UUID_1);
        $recipient = [
            UserId::getUuidFromString(self::USER_ID_UUID_1)
        ];
        $messageId = MessageId::getUuidFromString(self::MESSAGE_ID_UUID_1);

        $this->newMessageFromSystem = new NewMessageFromSystem($id, self::TITLE_1, self::DESCRIPTION_1, $recipient, $messageId, self::NOTIFICATION_PRIORITY);
    }

    public function testMarkAsUnread()
    {
        $this->newMessageFromSystem->markAsUnread();
        $this->assertEquals(self::NOTIFICATION_UNREAD, $this->newMessageFromSystem->getStatus());
    }

    public function testMarkAsRead()
    {
        $this->newMessageFromSystem->markAsRead();
        $this->assertEquals(self::NOTIFICATION_READ, $this->newMessageFromSystem->getStatus());
    }

    public function testSend()
    {
        $reflection = new \ReflectionClass($this->newMessageFromSystem);
        $property = $reflection->getProperty('sendDateTime');
        $property->setAccessible(true);
        $sendDateTime = $property->getValue($this->newMessageFromSystem);

        $this->assertNull($sendDateTime);

        $this->newMessageFromSystem->send();
        $this->assertInstanceOf('DateTime', $this->newMessageFromSystem->getSendDateTime());
    }

    public function testGetId()
    {
        $this->assertInstanceOf('App\ValueObject\UniqueId', $this->newMessageFromSystem->getId());
    }

    public function testGetMessage()
    {
        $this->assertInstanceOf('App\ValueObject\MessageId', $this->newMessageFromSystem->getMessage());
    }

    public function testGetTitle()
    {
        $this->assertEquals(self::UNIQUE_ID_UUID_1, $this->newMessageFromSystem->getId()->id()->toString());
    }

    public function testGetSendDateTime()
    {
        $reflection = new \ReflectionClass($this->newMessageFromSystem);
        $property = $reflection->getProperty('sendDateTime');
        $property->setAccessible(true);
        $sendDateTime = $property->getValue($this->newMessageFromSystem);

        $this->assertNull($sendDateTime);
    }

    public function testExceptionGetSendDateTime()
    {
        $this->expectException(MessageNoSendException::class);

        $this->newMessageFromSystem->getSendDateTime();
    }

    public function testGetDescription()
    {
        $this->assertEquals(self::DESCRIPTION_1, $this->newMessageFromSystem->getDescription());
    }

    public function testGetRecipients()
    {
        $recipients = $this->newMessageFromSystem->getRecipients();
        $this->assertCount(1, $recipients);
        $this->assertInstanceOf('App\ValueObject\UserId', $recipients[0]);
    }

    public function testGetSender()
    {
        $this->assertInstanceOf('App\ValueObject\UserId', $this->newMessageFromSystem->getSender());
        $this->assertEquals(self::PORTAL_UUID, $this->newMessageFromSystem->getSender()->id()->toString());
    }

    public function testGetStatus()
    {
        $this->assertEquals(self::NOTIFICATION_UNREAD, $this->newMessageFromSystem->getStatus());
    }

    public function testGetPriotity()
    {
        $this->assertEquals(self::NOTIFICATION_PRIORITY, $this->newMessageFromSystem->getPriority());
    }

    public function testInvalidPriority()
    {
        $id = UniqueId::getUuidFromString(self::UNIQUE_ID_UUID_1);
        $recipient = [
            UserId::getUuidFromString(self::USER_ID_UUID_1)
        ];
        $messageId = MessageId::getUuidFromString(self::MESSAGE_ID_UUID_1);

        $this->expectException(InvalidPriorityException::class);
        $this->expectExceptionMessage(sprintf('Invalid priority argument. Range %d to %d', self::NOTIFICATION_PRIORITY_MIN, self::NOTIFICATION_PRIORITY_MAX));

        $priority = self::NOTIFICATION_PRIORITY_MIN - 1;
        $test = new NewMessageFromSystem($id, self::TITLE_1, self::DESCRIPTION_1, $recipient, $messageId, $priority);
    }
}
