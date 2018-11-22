<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 12:03
 */

namespace App\Command\Handler;


use App\Command\Command;
use App\Command\NewMessageFromUserCommand;

class NewMessageFromUserHandler implements Handler
{
    /**
     * @var NewMessageFromUserCommand
     */
    private $newMessageFromUserCommnad;

    /**
     * NewMessageFromUserHandler constructor.
     * @param NewMessageFromUserCommand $newMessageFromUserCommnad
     */
    public function __construct(NewMessageFromUserCommand $newMessageFromUserCommnad)
    {
        $this->newMessageFromUserCommnad = $newMessageFromUserCommnad;
    }

    public function handle(Command $command)
    {
        // TODO: Implement handle() method.
    }


}