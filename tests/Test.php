<?php


namespace Liwanmin\RedisLbs\Tests;

use Liwanmin\RedisLbs\Facades\RedisLbs;
use Orchestra\Testbench\TestCase;

class Test extends TestCase
{
    public function testAdd()
    {
        RedisLbs::add('galaxy_soho', '116.4335788068771', '39.921372916981106');
        self::assertTrue(true);
    }

    public function testSearch()
    {
        RedisLbs::searchByMembers('galaxy_soho', 500, 'm');
        self::assertTrue(true);
    }

    public function testList()
    {
        RedisLbs::list('Lbs');
    }

    public function testDel()
    {
        RedisLbs::del('fesco');
        self::assertTrue(true);
    }

    protected function getPackageProviders($app)
    {
        return [
            'Liwanmin\\RedisLbs\\RedisLbsProvider',
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'RedisLbs' => 'Liwanmin\\RedisLbs\\Facades\\RedisLbs',
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.redis.client', 'predis');
    }
}