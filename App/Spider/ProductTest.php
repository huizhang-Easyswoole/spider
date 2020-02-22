<?php
/**
 * @CreateTime:   2020/2/16 下午11:11
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:
 */
namespace App\Spider;

use EasySwoole\HttpClient\HttpClient;
use QL\QueryList;
use Spider\Config;
use Spider\Hole\ProductInterface;
use Spider\Spider;
use Swoole\Coroutine;

class ProductTest implements ProductInterface
{

    public function product($url)
    {
        // TODO: Implement product() method.
        // 通过http协程客户端拿到地址内容
        $httpClient = new HttpClient($url);
        $body = $httpClient->get()->getBody();
        $ql = QueryList::html($body);
        $data = $ql->find('.artile_des img')->attrs('src');
        $nextUrl = $ql->find('.pic-footer .pic-page a')->attr('href');
        return [$nextUrl, $data];
    }
}
