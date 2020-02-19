<?php
/**
 * @CreateTime:   2020/2/16 下午10:45
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:
 */
namespace Spider;

use EasySwoole\Component\Process\AbstractProcess;
use Swoole\Coroutine;

class ConsumeProcess extends AbstractProcess
{
    public const ES_SPIDER_CONSUME_QUEUE='ES_SPIDER_CONSUME_QUEUE';

    protected function run($arg)
    {
        // TODO: Implement run() method.
        $config = Config::getInstance();
        for ($i=0;$i<$config->getConsumeCoroutineNum();$i++) {
            go(function () use ($config){
                while (true) {
                    $data = $config->getQueue()->pop(self::ES_SPIDER_CONSUME_QUEUE);
                    if (empty($data)) {
                        Coroutine::sleep(1);
                        continue;
                    }
                    $config->getConsume()->consume(json_decode($data, true));
                }
            });
        }

    }
}
