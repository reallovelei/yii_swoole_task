<?php
// 队列里每种类型执行的进程个数
return array(
    'task' => array(
        'Email' => 2,   // 邮件处理进程数量
        'Common' => 3,  // 公共进程数量
        'Retry' => 3,  // 公共进程数量
    ),
    // 特殊类型需要按 参数里的某个key进行取模 以达到同一个参数在同一个task进程里处理的目的(如同一个pid 都在一个task进程里)
    'key' => array(
        'Buy' => 'pid',
    ),
    'worker_num' => 3,
);
