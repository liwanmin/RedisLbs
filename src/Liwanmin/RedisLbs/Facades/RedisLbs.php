<?php

namespace Liwanmin\RedisLbs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @property bool $error
 * @property string $response
 * @method static \Liwanmin\RedisLbs\RedisLbs add($member, $longitude, $latitude, $key = null)
 * @method static \Liwanmin\RedisLbs\RedisLbs del($name, $key = null)
 * @method static \Liwanmin\RedisLbs\RedisLbs search($longitude, $latitude, $radius, $unit, $key = null)
 * @method static \Liwanmin\RedisLbs\RedisLbs searchByMembers($name, $radius, $unit, $key = null)
 * @method static \Liwanmin\RedisLbs\RedisLbs geoEncode($longitude, $latitude)
 * @method static \Liwanmin\RedisLbs\RedisLbs geoDecode($hash)
 * @method static \Liwanmin\RedisLbs\RedisLbs list($key, $start = 0, $end = -1)
 *
 * @see \Liwanmin\RedisLbs\RedisLbs
 */
class RedisLbs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'redis-lbs';
    }
}