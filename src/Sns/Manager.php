<?php

namespace Solpac\Sns;

use Aws\Sns\Message;
use InvalidArgumentException;

class Manager
{
    protected $topics = [];
    /**
     * @var array
     */
    private $handlers = [];

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

    public function handle(Message $message)
    {
        $subject = $message['Subject'];

        if (!array_key_exists($subject, $this->handlers)) {
            return;
        }

        $handler = resolve($this->handlers[$subject]);

        if (method_exists($handler, 'handle')) {
            $handler->handle($message);
        }
    }
}