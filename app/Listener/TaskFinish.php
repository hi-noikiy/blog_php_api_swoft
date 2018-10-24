<?php

namespace App\Listener;

use Swoft\Bean\Annotation\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Task\Event\TaskEvent;

/**
 * Task finish handler
 *
 * @Listener(TaskEvent::FINISH_TASK)
 */
class TaskFinish implements EventHandlerInterface
{
    private $count = 0;
    private $time = 0;

    /**
     * @param \Swoft\Event\EventInterface $event
     */
    public function handle(EventInterface $event)
    {
//        var_dum
//        $params = current($event->getParams());
//        $this->count += $params['count'];
//        $this->time += $params['time'];
//
//        var_dump($this->count, $this->time);
    }
}