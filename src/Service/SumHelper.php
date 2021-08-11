<?php

namespace App\Service;

class SumHelper
{
    public function orderSum($productOrderLists)
    {
        /* $total is 1, because shipping is hardcodded to 1 */
        $total = 1;
        foreach ($productOrderLists as $productOrderList) {
            $total += $productOrderList->getTotal();
        }
        return $total;
    }
}