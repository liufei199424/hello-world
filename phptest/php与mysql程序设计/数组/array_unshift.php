<?php

    $stus = array(
        '1001' => 'fanghanwen',
        '1002' => 'liufei',
        '1003' => 'fangsuyi'
    );

    // echo "======从数组头添加元素=====\n";
    // print_r($stus);
    // array_unshift($stus, "fangshouzhen");
    // print_r($stus);
    //
    echo "\n======从数组头删除元素=====\n";
    print_r($stus);
    array_shift($stus);
    print_r($stus);
    //
    // echo "\n======从数组尾添加元素=====\n";
    // print_r($stus);
    // array_push($stus, "fangcailing");
    // print_r($stus);

    echo "\n======从数组尾删除元素=====\n";
    print_r($stus);
    array_pop($stus);
    print_r($stus);

?>
