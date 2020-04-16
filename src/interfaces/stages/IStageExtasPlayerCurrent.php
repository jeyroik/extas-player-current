<?php
namespace extas\interfaces\stages;

use extas\interfaces\players\IPlayer;

/**
 * Interface IStageExtasPlayerCurrent
 *
 * @package extas\interfaces\stages
 * @author jeyroik@gmail.com
 */
interface IStageExtasPlayerCurrent
{
    public const NAME = 'extas.player.current';

    /**
     * @param IPlayer $player
     */
    public function __invoke(IPlayer &$player): void;
}
