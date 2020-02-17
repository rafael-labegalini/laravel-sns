<?php

namespace Solpac\Sns;

use InvalidArgumentException;

class Manager
{
    protected $topics = [];
    /**
     * @var array
     */
    private $handlers;

    /**
     * Manager constructor.
     * @param array $topics
     * @param array $handlers
     */
    public function __construct(array $topics, array $handlers)
    {
        $this->topics = $topics;
        $this->handlers = $handlers;
    }

    public function topic(string $key): Topic
    {
        if (!array_key_exists($key, $this->topics)) {
            throw new InvalidArgumentException('Invalid topic key provided');
        }

        $configs = $this->topics[$key];

        return new Topic($configs);
    }
}