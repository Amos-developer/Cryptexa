<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get all notifications for the authenticated user
     */
    public function index()
    {
        $user = Auth::user();

        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get()
            ->map(function ($notification) {
                return [
                    'id'        => $notification->id,
                    'type'      => $notification->type,
                    'title'     => $notification->title,
                    'message'   => $notification->message,
                    'icon_type' => $notification->icon_type,
                    'is_read'   => $notification->is_read,
                    'data'      => $notification->data,
                    'created_at' => $notification->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'notifications' => $notifications,
            'unread_count'  => Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->count(),
        ]);
    }

    /**
     * Get unread notification count
     */
    public function unreadCount()
    {
        $user = Auth::user();

        $count = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $count]);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        // Authorize the user
        if ($notification->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        $user = Auth::user();

        Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Delete notification
     */
    public function delete($id)
    {
        $notification = Notification::findOrFail($id);

        // Authorize the user
        if ($notification->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->delete();

        return response()->json(['success' => true]);
    }
}
