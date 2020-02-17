<?php

namespace App\Http\Middleware;

use Aws\Sns\Message;
use Aws\Sns\MessageValidator;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SnsSubscriptionConfirmationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $message = Message::fromRawPostData();
        $validator = new MessageValidator();

        if (!$validator->isValid($message)) {
            return response()->json(['status' => 'ValidationError'], 422);
        }

        if ($message['Type'] === 'SubscriptionConfirmation') {
            file_get_contents($message['SubscribeURL']);
            Log::debug('Subscription confirmed');

            return response()->json(['status' => 'SubscriptionConfirmed'], 200);
        } elseif ($message['Type'] === 'Notification') {
            return $next($request);
        }

        return response()->json(['status' => 'InvalidMessageType'], 500);
    }
}
