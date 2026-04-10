<?php
// 读取客户数据：分号 (;) 分隔
function readCustomers($filename) {
    $customers = array();
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $data = explode(';', $line);
            if (count($data) > 1) { $customers[] = $data; }
        }
    }
    return $customers;
}

// 读取订单数据：逗号 (,) 分隔
function readOrders($customerID, $filename) {
    $orders = array();
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $data = explode(',', $line);
            if (isset($data[1]) && trim($data[1]) == trim($customerID)) {
                $orders[] = $data;
            }
        }
    }
    return $orders;
}
?>