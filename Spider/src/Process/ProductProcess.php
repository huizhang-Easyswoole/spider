<?php
/**
 * @CreateTime:   2020/2/16 下午10:44
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:  生产者自定义进程
 */
namespace Spider\Process;

use EasySwoole\Component\Process\AbstractProcess;
use Spider\Config\Config;
use Spider\Process\ConsumeProcess;

class ProductProcess extends AbstractProcess
{

    public const ES_SPIDER_PRODUCT_QUEUE='ES_SPIDER_PRODUCT_QUEUE';

    protected function run($arg)
    {
        // TODO: Implement run() method.
        go(function (){

            $config = Config::getInstance();

            $config->getQueue()->push(self::ES_SPIDER_PRODUCT_QUEUE, $config->getStartUrl());

            for ($i=0;$i<$config->getProductCoroutineNum();$i++) {
                go(function () use ($config){
                    while (true) {

                        $url = $config->getQueue()->pop(self::ES_SPIDER_PRODUCT_QUEUE);
                        if (empty($url)) {
                            continue;
                        }

                        [$nextUrl, $data] = $config->getProduct()->product($url);

                        Config::getInstance()->getQueue()->push(self::ES_SPIDER_PRODUCT_QUEUE, $nextUrl);
                        Config::getInstance()->getQueue()
                            ->push(ConsumeProcess::ES_SPIDER_CONSUME_QUEUE, json_encode($data, JSON_UNESCAPED_UNICODE));
                    }
                });
            }

        });
    }
}
