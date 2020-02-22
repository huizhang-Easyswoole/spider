<?php
/**
 * @CreateTime:   2020/2/16 下午10:24
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:
 */
namespace Spider;

use EasySwoole\Component\Singleton;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\FastCache\Cache;
use EasySwoole\Redis\Config\RedisConfig;
use EasySwoole\RedisPool\Redis;
use Spider\Config\Config;
use Spider\Process\ConsumeProcess;
use Spider\Process\ProductProcess;
use Spider\Queue\FastCacheQueue;
use Spider\Queue\RedisQueue;

class Spider
{

    use Singleton;

    /**
     * @var $config Config
     */
    private $config;

    /**
     * 设置配置
     *
     * @param Config $config
     * CreateTime: 2020/2/22 下午3:46
     * @return Spider
     */
    public function setConfig(Config $config) : Spider
    {
        $this->config = $config;
        return $this;
    }

    /**
     * 将进程绑定到swooleserver
     *
     * @param null|\swoole_server|\swoole_server_port|\swoole_websocket_server|\swoole_http_server $swooleServer
     * CreateTime: 2020/2/22 下午2:45
     * @return Spider
     */
    public function attachProcess($swooleServer)
    {

        // 队列
        try {
            switch ($this->config->getQueueType()) {
                case Config::QUEUE_TYPE_FAST_CACHE:
                    Cache::getInstance()
                        ->setTempDir(EASYSWOOLE_TEMP_DIR)
                        ->attachToServer($swooleServer);
                    $this->config->setQueue(new FastCacheQueue());
                    break;
                case Config::QUEUE_TYPE_REDIS:
                    $queueConfig =  $this->config->getQueueConfig();
                    if (empty($config)) {
                        $queueConfig = new RedisConfig();
                    }
                    Redis::getInstance()->register(RedisQueue::REDIS_ALIAS, $queueConfig);
                    $this->config->setQueue(new RedisQueue());
                    break;
                case Config::QUEUE_TYPE_RABBITMQ:

                    break;
                case Config::QUEUE_TYPE_KAFKA:

                    break;
                default:
            }
        } catch (\Exception $e) {

        }

        // 生产者进程
        $swooleServer->addProcess((new ProductProcess())->getProcess());

        // 消费者进程
        $swooleServer->addProcess((new ConsumeProcess())->getProcess());

    }

}

