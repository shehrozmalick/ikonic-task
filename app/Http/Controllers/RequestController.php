<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\User;
use App\Models\Connection;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class RequestController extends Controller
{
    public function storeSentRequests($id): JsonResponse
    {
        Request::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $id,
        ]);

        return response()->json(['message' => 'Sent request successfully.']);
    }

    public function getSentRequests(): View
    {
        $sentRequests = Request::where('sender_id', auth()->user()->id)->get();
        return view('components.request', compact('sentRequests'));
    }

    public function withdrawRequest($id): JsonResponse
    {
        $request = Request::find($id);
        if ($request) {
            $receiverId = $request->receiver_id;
            $request->delete();

            // Add the suggestion back to suggestions list
            User::where('id', $receiverId)->update(['type' => 'suggestions']);

            return response()->json(['message' => 'Request withdrawn successfully.']);
        } else {
            return response()->json(['message' => 'Request not found.'], 404);
        }
    }

    public function getReceivedRequests(): View
    {
        $sentRequests = Request::where('receiver_id', auth()->user()->id)->get();
        return view('components.request', compact('sentRequests'));
    }

    public function acceptRequest($id): JsonResponse
    {
        $request = Request::find($id);
        if ($request) {
            // Create a connection between the sender and receiver
            Connection::create([
                'user_id' => $request->sender_id,
                'connected_user_id' => $request->receiver_id,
            ]);

            // Remove the suggestion from suggestions list
            User::where('id', $request->sender_id)->update(['type' => '']);

            $request->delete();
            return response()->json(['message' => 'Request accepted successfully.']);
        } else {
            return response()->json(['message' => 'Request not found.'], 404);
        }
    }
}
