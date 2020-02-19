<?php
/**
 * @CreateTime:   2020/2/16 下午11:39
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:
 */
namespace Spider;

use EasySwoole\FastCache\Cache;

class FastCacheQueue implements QueueInterface
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

    public function reset()
    {
        // TODO: Implement reset() method.
    }
}
