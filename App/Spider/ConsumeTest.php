<?php
/**
 * @CreateTime:   2020/2/17 上午9:18
 * @Author:       huizhang  <tuzisir@163.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:
 */
namespace App\Spider;

use Spider\Hole\ConsumeInterface;

class ConsumeTest implements ConsumeInterface
{

    public function consume($data)
    {
        // TODO: Implement consume() method.
        $urls = '';
        foreach ($data as $item) {
            if (!empty($item)) {
                $urls .= $item."\n";
            }
        }
        file_put_contents('斗图.txt', $urls);
    }
}
