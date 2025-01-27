<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Tests\Proxy;

use PHPUnit\Framework\TestCase;
use Psr\EventDispatcher\EventDispatcherInterface;
use Yiisoft\Yii\Debug\Collector\EventCollectorInterface;
use Yiisoft\Yii\Debug\Proxy\EventDispatcherInterfaceProxy;

final class EventDispatcherProxyTest extends TestCase
{
    public function testDispatch(): void
    {
        $event = new \stdClass();
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $collector = $this->createMock(EventCollectorInterface::class);

        $eventDispatcher->method('dispatch')->willReturn($event);
        $collector
            ->expects($this->once())
            ->method('collect')
            ->with($event, __FILE__ . ':28');

        $proxy = new EventDispatcherInterfaceProxy($eventDispatcher, $collector);

        $proxy->dispatch($event);
    }
}
