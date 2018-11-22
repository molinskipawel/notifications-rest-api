<?php
/**
 * User: Paweł Moliński
 * E-mail: molinski.pawel@gmail.com
 * Date: 22.11.2018
 * Time: 11:20
 */

namespace App\Command;


use App\Entity\NewMessageFromUser;

class NewMessageFromUserCommand implements Command
{
    /**
     * @var NewMessageFromUser
     */
    private $newMessageFromUser;

    /**
     * NewMessageFromUserCommand constructor.
     * @param NewMessageFromUser $newMessageFromUser
     */
    public function __construct(NewMessageFromUser $newMessageFromUser)
    {
        $this->newMessageFromUser = $newMessageFromUser;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }


}