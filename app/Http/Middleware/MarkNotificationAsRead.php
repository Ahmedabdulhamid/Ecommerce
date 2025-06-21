<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Notifications\DatabaseNotification;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('admin')->check() && $request->query('notify-order')) {
            $notification = auth('admin')->user()
                ->unreadNotifications()
                ->where('id', $request->query('notify-order'))
                ->first();
            if ($notification) {
                $notification->markAsRead();
                logger('Notification marked as read: ' . $notification->id);
            } else {
                logger('No notification found with ID: ' . $request->query('notify-order'));
            }
        }

        if (auth('admin')->check() && $request->query('notify-contact')) {
           $notification = auth('admin')->user()->unreadNotifications()
                ->where('id', $request->query('notify-contact'))
                ->first();
            if ($notification) {
                $notification->markAsRead();
                logger('Notification marked as read: ' . $notification->id);
            } else {
                logger('No notification found with ID: ' . $request->query('notify-contact'));
            }
        }
        return $next($request);
    }
}
