<?php


namespace Solpac\Sns;


use Aws\Sns\Message;
use Illuminate\Support\Facades\Facade;

/**
 * Class Sns
 * @package Solpac\Sns
 *
 * @method static Topic topic(string $key)
 * @method static void handle(Message $message)
 */
class Sns extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Manager::class;
    }
}