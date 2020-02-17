<?php

namespace Solpac\Sns;

use InvalidArgumentException;

class Manager
{
    protected $topics = [];

    /**
     * Manager constructor.
     * @param array $topics
     */
    public function __construct(array $topics)
    {
        $this->topics = $topics;
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