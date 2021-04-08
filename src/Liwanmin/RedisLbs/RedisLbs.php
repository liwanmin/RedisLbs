<?php

namespace Liwanmin\RedisLbs;

use Illuminate\Support\Facades\Redis;

class RedisLbs
{
    protected $redis;

    protected $geo_set_name;

    protected $allow_unit;

    protected $radium_option;

    public function __construct(array $config)
    {
        $this->redis = Redis::connection($config['redis'])->client();
        $this->geo_set_name = $config['geo_set_name'];
        $this->allow_unit = $config['allow_unit'];
        $this->radium_option = $config['radium_option'];
    }

    /**
     * 集合中新加一个坐标
     *
     * @param $member
     * @param $longitude
     * @param $latitude
     * @param null $key
     * @return int
     */
    public function add($member, $longitude, $latitude, $key = null)
    {
        $key = is_null($key) ? $this->geo_set_name : $key;
        return $this->redis->geoadd($key, $longitude, $latitude, $member);
    }

    /**
     * 删除集合中指定元素
     *
     * @param $member
     * @param null $key
     * @return int
     */
    public function del($member, $key = null)
    {
        $key = is_null($key) ? $this->geo_set_name : $key;
        return $this->redis->zrem($key, $member);
    }

    /**
     * 根据坐标查询范围内元素。
     *
     * @param $longitude
     * @param $latitude
     * @param float $radius
     * @param $unit
     * @param null $key
     * @return mixed
     */
    public function search($longitude, $latitude, float $radius, $unit, $key = null)
    {
        $key = is_null($key) ? $this->geo_set_name : $key;
        $unit = in_array($unit, $this->allow_unit) ? $unit : 'm';
        return $this->redis->georadius($key, $longitude, $latitude, $radius, $unit, $this->radium_option);
    }

    /**
     * 根据集合中的元素查询范围内元素。
     *
     * @param $member
     * @param $radius
     * @param $unit
     * @param null $key
     * @return mixed
     */
    public function searchByMembers($member, int $radius, $unit, $key = null)
    {
        $key = is_null($key) ? $this->geo_set_name : $key;
        $unit = in_array($unit, $this->allow_unit) ? $unit : 'm';
        return $this->redis->georadiusbymember($key, $member, $radius, $unit, $this->radium_option);
    }

    /**
     * 列出集合中的内容
     *
     * @param $key
     * @param int $start
     * @param int $end
     * @return array
     */
    public function list($key, $start = 0, $end = -1)
    {
        return $this->redis->zrange($key, $start, $end);
    }
}

