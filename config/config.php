<?php
return [
    'redis'         => env('LBS_REDIS','default'),

    //集合名
    'geo_set_name'  => env('GEO_SET_NAME', 'LBS'),

    //搜寻定义的一些参数
    'radium_option' => ['WITHDIST'],
    'allow_unit'    => ['m', 'km', 'ft', 'mi']
];