<?php
/**
 * @CreateTime:   2020/2/17 下午10:07
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:
 */
namespace App\JobQueue;

use JobQueue\AbstractJob;

class JobQueueTest extends AbstractJob{

    function exec(): bool
    {
        // TODO: Implement exec() method.
        echo 2;
    }

    function onException(\Throwable $throwable): bool
    {
        // TODO: Implement onException() method.
    }
}
