<?php


namespace Solpac\Sns;


use Illuminate\Support\Facades\Facade;

/**
 * Class Sns
 * @package Solpac\Sns
 *
 * @method static Topic topic(string $key)
 */
class Sns extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Manager::class;
    }
}