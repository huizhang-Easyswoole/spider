<?php
/**
 * @CreateTime:   2020/2/16 下午11:37
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:
 */
namespace Spider;

interface QueueInterface
{
    public function push($key, $value);

    public function pop($key);

    public function reset();
}
