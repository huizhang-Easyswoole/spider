<?php
/**
 * @CreateTime:   2020/2/16 下午10:44
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:  生产者自定义进程
 */
namespace Spider;

use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\HttpClient\HttpClient;
use Swoole\Coroutine;

class ProductProcess extends AbstractProcess
{

    public const ES_SPIDER_PRODUCT_QUEUE='ES_SPIDER_PRODUCT_QUEUE';

    protected function run($arg)
    {
        // TODO: Implement run() method.
        go(function (){

            $config = Config::getInstance();
            // 将开始地址放入队列
            $config->getQueue()->push(self::ES_SPIDER_PRODUCT_QUEUE, $config->getStartUrl());

            // 根据配置开启协程数量
            for ($i=0;$i<$config->getProductCoroutineNum();$i++) {
                go(function () use ($config){
                    while (true) {

                        // 从队列中pop出地址
                        $url = $config->getQueue()->pop(self::ES_SPIDER_PRODUCT_QUEUE);
                        if (empty($url)) {
                            Coroutine::sleep(1);
                            continue;
                        }

                        // 通过http协程客户端拿到地址内容
                        $httpClient = new HttpClient($url);
                        $body = $httpClient->get()->getBody();
                        if (empty($body)) {
                            Coroutine::sleep(1);
                            continue;
                        }

                        // 开始生产
                        [$nextUrl, $data] = $config->getProduct()->product($body);

                        Config::getInstance()->getQueue()->push(self::ES_SPIDER_PRODUCT_QUEUE, $nextUrl);
                        Config::getInstance()->getQueue()
                            ->push(ConsumeProcess::ES_SPIDER_CONSUME_QUEUE, json_encode($data, JSON_UNESCAPED_UNICODE));

                        Coroutine::sleep($config->getProductTime());
                    }
                });
            }

        });
    }
}
