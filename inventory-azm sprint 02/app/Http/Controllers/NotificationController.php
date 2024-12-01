<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        try {
            $notification = auth()->user()->notifications()->findOrFail($id);
            $notification->markAsRead();
            
            \Log::info('Notifikasi ditandai sebagai dibaca: ' . $id);
            return back()->with('success', 'Notifikasi ditandai sebagai telah dibaca');
        } catch (\Exception $e) {
            \Log::error('Error saat menandai notifikasi: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menandai notifikasi');
        }
    }

    public function markAllAsRead()
    {
        try {
            auth()->user()->unreadNotifications->markAsRead();
            
            \Log::info('Semua notifikasi ditandai sebagai dibaca untuk user: ' . auth()->id());
            return back()->with('success', 'Semua notifikasi ditandai sebagai telah dibaca');
        } catch (\Exception $e) {
            \Log::error('Error saat menandai semua notifikasi: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menandai notifikasi');
        }
    }
}