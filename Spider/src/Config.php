<?php
/**
 * @CreateTime:   2020/2/16 下午10:28
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:
 */
namespace Spider;

use EasySwoole\Component\Singleton;
use Spider\ProductInterface;

class Config
{

    use Singleton;

    protected $startUrl;

    protected $product;

    protected $consume;

    protected $productTime=1;

    protected $consumeTime=1;

    protected $queueType=1;

    protected $queue;

    protected $productCoroutineNum=3;

    protected $consumeCoroutineNum=3;

    public const QUEUE_TYPE_FAST_CACHE = 1;
    public const QUEUE_TYPE_REDIS = 2;

    /**
     * @return mixed
     */
    public function getStartUrl()
    {
        return $this->startUrl;
    }

    /**
     * @param mixed $startUrl
     * @return Config
     */
    public function setStartUrl($startUrl): Config
    {
        $this->startUrl = $startUrl;
        return $this;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct():ProductInterface
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     * @return Config
     */
    public function setProduct(ProductInterface $product): Config
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return ConsumeInterface
     */
    public function getConsume():ConsumeInterface
    {
        return $this->consume;
    }

    /**
     * @param ConsumeInterface $consume
     * @return Config
     */
    public function setConsume(ConsumeInterface $consume): Config
    {
        $this->consume = $consume;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductTime()
    {
        return $this->productTime;
    }

    /**
     * @param mixed $productTime
     * @return Config
     */
    public function setProductTime($productTime): Config
    {
        $this->productTime = $productTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConsumeTime()
    {
        return $this->consumeTime;
    }

    /**
     * @param mixed $consumeTime
     * @return Config
     */
    public function setConsumeTime($consumeTime): Config
    {
        $this->consumeTime = $consumeTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQueueType()
    {
        return $this->queueType;
    }

    /**
     * @param mixed $queueType
     * @return Config
     */
    public function setQueueType($queueType): Config
    {
        $this->queueType = $queueType;
        return $this;
    }

    /**
     * @return QueueInterface
     */
    public function getQueue():QueueInterface
    {
        return $this->queue;
    }

    /**
     * @param mixed $queue
     * @return Config
     */
    public function setQueue($queue): Config
    {
        $this->queue = $queue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductCoroutineNum()
    {
        return $this->productCoroutineNum;
    }

    /**
     * @param mixed $productCoroutineNum
     * @return Config
     */
    public function setProductCoroutineNum($productCoroutineNum): Config
    {
        $this->productCoroutineNum = $productCoroutineNum;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConsumeCoroutineNum()
    {
        return $this->consumeCoroutineNum;
    }

    /**
     * @param mixed $consumeCoroutineNum
     * @return Config
     */
    public function setConsumeCoroutineNum($consumeCoroutineNum): Config
    {
        $this->consumeCoroutineNum = $consumeCoroutineNum;
        return $this;
    }

}
