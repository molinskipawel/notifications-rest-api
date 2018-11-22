<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 11:20
 */

namespace App\Command;


use App\Entity\NewMessageFromSystem;

class NewMessageFromSystemCommand implements Command
{
    /**
     * @var NewMessageFromSystem
     */
    private $newMessageFromSystem;

    /**
     * NewMessageFromUserCommand constructor.
     * @param NewMessageFromSystem $newMessageFromSystem
     */
    public function __construct(NewMessageFromSystem $newMessageFromSystem)
    {
        $this->newMessageFromSystem = $newMessageFromSystem;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }


}