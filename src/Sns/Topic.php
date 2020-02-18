<?php

namespace Solpac\Sns;

use Aws\Laravel\AwsFacade;
use Aws\Result;
use Aws\Sns\SnsClient;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class Topic
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var SnsClient
     */
    protected $client = null;

    /**
     * Topic constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $validator = Validator::make($config, [
            'TopicArn' => 'required|string',
            'Subject' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException('Invalid parameters provides to Topic');
        }

        $this->config = $validator->validated();
        $this->client = AwsFacade::createClient('sns');
    }

    public function subject(string $subject): Topic
    {
        $this->config['subject'] = $subject;
        return $this;
    }

    /**
     * @param array $data
     * @return Result
     */
    public function publish(array $data)
    {
        $this->config['Message'] = json_encode($data);
        return $this->client->publish($this->config);
    }
}