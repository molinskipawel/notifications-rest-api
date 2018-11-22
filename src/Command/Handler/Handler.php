<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 12:01
 */

namespace App\Command\Handler;


use App\Command\Command;

interface Handler
{
    public function handle(Command $command);
}