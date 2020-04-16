<?php
use PHPUnit\Framework\TestCase;
use extas\components\plugins\PluginRepository;
use extas\components\plugins\Plugin;
use extas\interfaces\stages\IStageExtasPlayerCurrent;
use extas\components\players\Current;

/**
 * Class CurrentTest
 *
 * @author jeyroik@gmail.com
 */
class CurrentTest extends TestCase
{
    /**
     * @var IRepository|null
     */
    protected ?PluginRepository $pluginRepo = null;

    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();

        $this->pluginRepo = new PluginRepository;
    }

    public function testAttachUserByPlugin()
    {
        $this->pluginRepo->create(new Plugin([
            Plugin::FIELD__CLASS => 'tests\\TestUser',
            Plugin::FIELD__STAGE => IStageExtasPlayerCurrent::NAME
        ]));

        $this->assertEquals('test', Current::player()->getName());
        $this->pluginRepo->delete([Plugin::FIELD__CLASS => 'tests\\TestUser']);
    }
}
