<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 11:47
 */

namespace App\Tests\Repository\InMemory;

use App\Notification\Notification;
use App\Repository\InMemory\NotificationRepository;
use PHPUnit\Framework\TestCase;

class NotificationRepositoryTest extends TestCase
{

    public function testGetAll()
    {
        $notificationRepository = new NotificationRepository();
        $notification1 = $this->createMock(Notification::class);
        $notification2 = $this->createMock(Notification::class);

        $notificationRepository->add($notification1);
        $notificationRepository->add($notification2);

        $this->assertCount(2, $notificationRepository->getAll());
    }

    public function testAdd()
    {
        $notificationRepository = new NotificationRepository();

        $this->assertCount(0, $notificationRepository->getAll());

        $notification = $this->createMock(Notification::class);

        $notificationRepository->add($notification);

        $this->assertCount(1, $notificationRepository->getAll());
    }
}
