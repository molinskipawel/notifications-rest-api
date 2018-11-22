<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 11:32
 */

namespace App\Repository\InMemory;


use App\Notification\Notification;

class NotificationRepository implements \App\Repository\NotificationRepository
{
    /**
     * @var Notification[]
     */
    private $notifications = array();

    public function add(Notification $notification)
    {
        $this->notifications[] = $notification;
    }

    public function getAll()
    {
        return $this->notifications;
    }

}