<?php
namespace EasySwoole\EasySwoole;


use App\Spider\ConsumeTest;
use App\Spider\ProductTest;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use Spider\Spider;
use Spider\Config;

class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
    }

    public static function mainServerCreate(EventRegister $register)
    {
        // TODO: Implement mainServerCreate() method.
        $config = Config::getInstance()
            ->setStartUrl('https://www.doutula.com/article/detail/6744607')
            ->setProduct(new ProductTest())
            ->setConsume(new ConsumeTest())
            ->setQueueType(Config::QUEUE_TYPE_FAST_CACHE)
            ->setProductCoroutineNum(1)
            ->setConsumeCoroutineNum(1);
        $spider = new Spider($config);
        $spider->run();
    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}
