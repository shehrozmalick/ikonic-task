<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as Req;
use App\Models\User;
use App\Models\Connection;
use Auth;
use DB;

class HomeController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $currentUserId = Auth::user()->id;

        $suggestions = User::where('id', '!=', $currentUserId)
            ->whereDoesntHave('connections', function ($query) use ($currentUserId) {
                $query->where(function ($q) use ($currentUserId) {
                    $q->where('user_id', $currentUserId)
                        ->whereColumn('connected_user_id', 'users.id');
                })->orWhere(function ($q) use ($currentUserId) {
                    $q->where('user_id', 'users.id')
                        ->where('connected_user_id', $currentUserId);
                });
            })
            ->whereDoesntHave('requests', function ($query) use ($currentUserId) {
                $query->where('receiver_id', 'users.id')
                    ->where('sender_id', $currentUserId)
                    ->where('status', 'pending');
            })
            ->orderBy('id', 'desc')
            ->count();

        $sentRequests = Req::where('sender_id', $currentUserId)->count();
        $receivedRequests = Req::where('receiver_id', $currentUserId)->count();

        $connections = Connection::where(function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId)
                ->orWhere('connected_user_id', $currentUserId);
        })->count();

        $data = [
            'suggestions' => $suggestions,
            'requests' => $sentRequests,
            'received' => $receivedRequests,
            'connections' => $connections,
        ];

        return view('home', compact('data'));
    }

    public function getContent()
    {
        $limit = isset($_GET['limit']) && !empty($_GET['limit']) ? $_GET['limit'] : 10;
        $currentUserId = Auth::user()->id;

        $user = User::where('id', '!=', $currentUserId)
            ->whereDoesntHave('connections', function ($query) use ($currentUserId) {
                $query->where(function ($q) use ($currentUserId) {
                    $q->where('user_id', $currentUserId)
                        ->whereColumn('connected_user_id', 'users.id');
                })->orWhere(function ($q) use ($currentUserId) {
                    $q->where('user_id', 'users.id')
                        ->where('connected_user_id', $currentUserId);
                });
            })
            ->whereDoesntHave('requests', function ($query) use ($currentUserId) {
                $query->where('receiver_id', 'users.id')
                    ->where('sender_id', $currentUserId)
                    ->where('status', 'pending');
            })
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();

        return view('components.suggestion', compact('user'));
    }

}
