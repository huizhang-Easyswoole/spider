<?php
/**
 * @CreateTime:   2020/2/16 下午10:24
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:
 */
namespace Spider;

use EasySwoole\Component\Process\Exception;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\FastCache\Cache;
use EasySwoole\FastCache\Exception\RuntimeError;

class Spider
{

    /**
     * @var $config Config
     */
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function run()
    {

        // 队列
        try {
            switch ($this->config->getQueueType()) {
                case Config::QUEUE_TYPE_FAST_CACHE:
                    Cache::getInstance()
                        ->setTempDir(EASYSWOOLE_TEMP_DIR)
                        ->attachToServer(ServerManager::getInstance()->getSwooleServer());
                    $this->config->setQueue(new FastCacheQueue());
                    break;
                default:
            }
        } catch (\Exception $e) {

        }

        // 生产者进程
        ServerManager::getInstance()
            ->getSwooleServer()
            ->addProcess((new ProductProcess())->getProcess());

        // 消费者进程
        ServerManager::getInstance()
            ->getSwooleServer()
            ->addProcess((new ConsumeProcess())->getProcess());

    }

}

