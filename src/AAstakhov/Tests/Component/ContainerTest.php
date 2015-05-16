<?php

namespace AAstakhov\Tests\Component;

use AAstakhov\Component\Container;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testAddService()
    {
        $container = new Container();

        $container->add('service1', function () {
            return new Service1();
        });
        $container->add('service2', function ($container) {
            return new Service2($container->get('service1'));
        });

        $service = $container->get('service2');
        $this->assertEquals('I am Service2. See who is here: I am Service1', $service->test());
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