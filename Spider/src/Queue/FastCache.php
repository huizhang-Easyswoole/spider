<?php
/**
 * @CreateTime:   2020/2/22 下午2:55
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:
 */
namespace Spider\Queue;

use EasySwoole\FastCache\Cache;
use Spider\Hole\QueueInterface;

class FastCache implements QueueInterface
{

    public function push($key, $value)
    {
        // TODO: Implement push() method.
        Cache::getInstance()->enQueue($key,$value);
    }

    public function pop($key)
    {
        // TODO: Implement pop() method.
        return Cache::getInstance()->deQueue($key);
    }

}
