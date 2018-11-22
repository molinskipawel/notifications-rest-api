<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 11:29
 */

namespace App\Repository;


use App\Notification\Notification;

interface NotificationRepository
{
    public function add(Notification $notification);

    public function getAll();
}