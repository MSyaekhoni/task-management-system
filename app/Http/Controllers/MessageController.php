<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('task', 'creator')->latest()->paginate(5);
        $totalMessages = Message::count();

        return view('messages', compact('messages', 'totalMessages'));
    }

    public function destroy(Request $request, Message $message)
    {
        // Tangkap halaman saat ini
        $currentPage = $request->query('page', 1);

        // Hapus message
        // $message = Message::findOrFail($id);
        $message->delete();

        // Hitung ulang message setelah dihapus
        $totalMessages = Message::count();
        $messagePerPage = 5;

        // Hitung halaman terakhir yang tersedia
        $lastPage = ceil($totalMessages / $messagePerPage);

        // Redirect ke Halaman yang valid (Jika halaman terakhir kosong kembali ke halaman awal)
        $redirectPage = min($currentPage, $lastPage);

        return redirect()->route('messages.index', ['page' => $redirectPage])->with('success', 'message deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $currentPage = request('page', 1); // Ambil halaman saat ini

        $request->validate([
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:messages,id'
        ]);

        Message::whereIn('id', $request->message_ids)->delete();

        // Cek apakah halaman masih ada data setelah delete
        $remainingMessages = Message::paginate(5);

        // Jika tidak ada pesan di halaman saat ini, redirect ke halaman sebelumnya
        if ($remainingMessages->isEmpty() && $currentPage > 1) {
            $currentPage--; // Turun ke halaman sebelumnya jika kosong
        }

        return redirect()->route('messages.index', ['page' => $currentPage])->with('success', 'Selected messages deleted successfully.');
    }
}
