<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Get notifications from database, ordered by newest first
        $notifications = Notification::orderBy('created_at', 'desc')
            ->limit(50)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'time_ago' => $notification->time_ago,
                    'read_at' => $notification->read_at,
                    'color' => $notification->color,
                    'icon' => $notification->icon,
                    'action_url' => $notification->action_url,
                    'created_at' => $notification->created_at
                ];
            });

        // Count unread notifications
        $unreadCount = Notification::unread()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    public function show()
    {
        // Get all notifications with pagination for the notifications page
        $notifications = Notification::orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total' => Notification::count(),
            'unread' => Notification::unread()->count(),
            'today' => Notification::whereDate('created_at', today())->count(),
            'this_week' => Notification::recent(7)->count(),
        ];

        return view('admin.notifications.index', compact('notifications', 'stats'));
    }

    public function markAsRead(Request $request, $notificationId)
    {
        $notification = Notification::find($notificationId);
        
        if ($notification) {
            $notification->markAsRead();
            
            return response()->json([
                'success' => true,
                'message' => 'Notification marked as read'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Notification not found'
        ], 404);
    }

    public function markAllAsRead(Request $request)
    {
        Notification::unread()->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read'
        ]);
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->route('admin.notifications.show')
            ->with('success', 'Notification deleted successfully');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:mark_read,mark_unread,delete',
            'notification_ids' => 'required|array',
            'notification_ids.*' => 'exists:notifications,id'
        ]);

        $notifications = Notification::whereIn('id', $request->notification_ids);

        switch ($request->action) {
            case 'mark_read':
                $notifications->update(['read_at' => now()]);
                $message = 'Selected notifications marked as read';
                break;
            case 'mark_unread':
                $notifications->update(['read_at' => null]);
                $message = 'Selected notifications marked as unread';
                break;
            case 'delete':
                $notifications->delete();
                $message = 'Selected notifications deleted';
                break;
        }

        return redirect()->route('admin.notifications.show')
            ->with('success', $message);
    }
} 