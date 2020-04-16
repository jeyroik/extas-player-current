<?php
namespace tests;

use extas\components\plugins\Plugin;
use extas\interfaces\players\IPlayer;
use extas\interfaces\stages\IStageExtasPlayerCurrent;

/**
 * Class TestUser
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class TestUser extends Plugin implements IStageExtasPlayerCurrent
{
    public function __invoke(IPlayer &$player): void
    {
        $player->setName('test');
    }
}
