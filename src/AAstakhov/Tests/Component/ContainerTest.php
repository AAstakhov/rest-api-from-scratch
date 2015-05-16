<?php

namespace AAstakhov\Tests\Component;

use AAstakhov\Component\Container;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetService()
    {
        $container = new Container();

        $container->add('service1', function () {
            return new Service1();
        });
        $container->add('service2', function () use ($container) {
            return new Service2($container->get('service1'));
        });

        $service = $container->get('service2');
        $this->assertEquals('I am Service2. See who is here: I am Service1', $service->test());
    }

    /**
     * @expectedException \AAstakhov\Component\Exceptions\ServiceNotFoundException
     * @expectedExceptionMessage Service service-that-does-not-exist is not registered in the container.
     */
    public function testGetMissingService()
    {
        $container = new Container();
        $container->get('service-that-does-not-exist');
    }
}

class Service1
{
    public function test()
    {
        return 'I am Service1';
    }
}

class Service2
{
    /**
     * @var Service1
     */
    private $service1;

    public function __construct(Service1 $service1)
    {
        $this->service1 = $service1;
    }

    public function test()
    {
        return 'I am Service2. See who is here: '.$this->service1->test();
    }
}