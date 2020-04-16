<?php
namespace extas\components\players;

use extas\components\Item;
use extas\interfaces\players\IPlayer;
use extas\interfaces\stages\IStageExtasPlayerCurrent;

/**
 * Class Current
 *
 * @package extas\components\players
 * @author jeyroik@gmail.com
 */
class Current extends Item
{
    const STAGE__PLAYER_CURRENT = 'extas.player.current';

    /**
     * @var static
     */
    protected static $instance = null;

    /**
     * @var IPlayer
     */
    protected $player = null;

    /**
     * @return IPlayer
     */
    public static function player()
    {
        return static::getInstance()->__toPlayer();
    }

    /**
     * @return Current
     */
    protected static function getInstance()
    {
        return static::$instance ?: static::$instance = new static();
    }

    /**
     * Current constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->loadCurrentPlayer();
    }

    /**
     * @return IPlayer
     */
    public function __toPlayer()
    {
        return $this->player;
    }

    /**
     * @return $this
     */
    protected function loadCurrentPlayer()
    {
        $player = new Player();

        foreach ($this->getPluginsByStage(IStageExtasPlayerCurrent::NAME) as $plugin) {
            /**
             * @var IStageExtasPlayerCurrent $plugin
             */
            $plugin($player);
        }

        $this->player = $player;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.player.current';
    }
}
