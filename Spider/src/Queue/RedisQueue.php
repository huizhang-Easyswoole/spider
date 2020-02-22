<?php
/**
 * @CreateTime:   2020/2/22 下午2:55
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:  基于redis-pool
 */
namespace Spider\Queue;

use EasySwoole\RedisPool\Redis;
use Spider\Hole\QueueInterface;

class RedisQueue implements QueueInterface
{

    public function push($key, $value)
    {
        // TODO: Implement push() method.
        $redis = Redis::defer('redis');
        $redis->lPush($key, $value);
    }

    public function pop($key)
    {
        // TODO: Implement pop() method.
        $redis = Redis::defer('redis');
        return $redis->lPop($key);
    }

}
