<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 12:01
 */

namespace App\Command\Handler;


use App\Command\Command;
use App\Command\NewMessageFromSystemCommand;

class NewMessageFromSystemHandler implements Handler
{
    /**
     * @var NewMessageFromSystemCommand
     */
    private $newMessageFromSystemCommand;

    /**
     * NewMessageFromSystemHandler constructor.
     * @param NewMessageFromSystemCommand $newMessageFromSystemCommand
     */
    public function __construct(NewMessageFromSystemCommand $newMessageFromSystemCommand)
    {
        $this->newMessageFromSystemCommand = $newMessageFromSystemCommand;
    }

    public function handle(Command $command)
    {
        // TODO: Implement handle() method.
    }


}