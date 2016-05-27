<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/27/2016
 * Time: 10:53
 */
class Money
{
    /**
     * BÀI TOÁN CHIA TIỀN
     * Đề bài: Có các tờ tiền mệnh giá 500K - 200K - 100K - 50K - 20K - 10K - 5K - 2K - 1K.
     * Viết thuật toán để nhập vào số tiền bất kỳ sẽ trả ra số tờ tiền từng mệnh giá
     */
    function splitMoney($withdrawn) {
        $withdrawn = (int) $withdrawn;
//    Nếu số tiền nhập vào không chia hết cho 1K
        if($withdrawn % 1000 != 0) {
            return false;
        }
        $item_cash = array();
        $array_money = array(
            '500k' => 500000,
            '200k' => 200000,
            '100k' => 100000,
            '50k'  => 50000,
            '20k'  => 20000,
            '10k'  => 10000,
            '5k'   => 5000,
            '2k'   => 2000,
            '1k'   => 1000
        );
        foreach ($array_money as $k => $v) {
//        Lấy phần nguyên của phép chia
            $item_cash[$k] = floor($withdrawn / $v);
//        Gán lại withdrawn bằng phần dư của phép chia
            $withdrawn = $withdrawn % $v;
//            echo $withdrawn.'<br />';
        }
        return $item_cash;
    }
}