<?php
/**
 * @CreateTime:   2020/2/16 下午11:11
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:
 */
namespace App\Spider;

use QL\QueryList;
use Spider\Config;
use Spider\ProductInterface;
use Spider\Spider;

class ProductTest implements ProductInterface
{

    public function product($body)
    {
        // TODO: Implement product() method.
        $ql = QueryList::html($body);
        $data = $ql->find('.artile_des img')->attrs('src');
        $nextUrl = $ql->find('.pic-footer .pic-page a')->attr('href');
        return [$nextUrl, $data];
    }
}
