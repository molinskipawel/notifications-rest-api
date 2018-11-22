<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 09:24
 */

namespace App\Notification;


interface Notification
{
    public function markAsRead();

    public function markAsUnread();

    public function send();
}