<?php


namespace Brera\Lib\Queue\Tests\Unit;


use Brera\Lib\Queue\MessageInterface;

abstract class MessageTestAbstract extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MessageInterface
     */
    protected $message;

    protected $testChannelName = 'test-channel';
    protected $testIdentifier = array('id' => 'dummy');
    protected $testPayload = 'test-payload';

    /**
     * @test
     * @covers Brera\Lib\Queue\AbstractMessage::getIdentifier
     */
    public function itShouldReturnTheMessageIdentifier()
    {
        $this->assertEquals($this->testIdentifier, $this->message->getIdentifier());
    }

    /**
     * @test
     * @covers Brera\Lib\Queue\AbstractMessage::getPayload
     */
    public function itShouldReturnThePayload()
    {
        $this->assertEquals($this->testPayload, $this->message->getPayload());
    }

    /**
     * @test
     * @covers Brera\Lib\Queue\AbstractMessage::getChannel
     */
    public function itShouldReturnTheChannelName()
    {
        $this->assertEquals($this->testChannelName, $this->message->getChannel());
    }
} 