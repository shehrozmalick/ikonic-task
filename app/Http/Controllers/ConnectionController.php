<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Connection;
use App\Models\User;
use Auth;

class ConnectionController extends Controller
{
    public function getConnections()
    {
        $connections = Connection::where('user_id', auth()->user()->id)
            ->orWhere('connected_user_id', auth()->user()->id)
            ->get();
        return view('components.connection', compact('connections'));
    }

    public function removeConnection($id)
    {
        $connection = Connection::find($id);
        if ($connection) {
            $connection->delete();
            return response()->json(['message' => 'Connection removed successfully.']);
        } else {
            return response()->json(['message' => 'Connection not found.'], 404);
        }
    }

    public function getConnectionsInCommon($id)
    {
        
        $commonConnectionUsers = $this->getCommon($id);
        return view('components.connection_in_common', compact('commonConnectionUsers'));
    }

    public function getCommon($id)
    {
        $targetUserId = $id;
        $targetUserConnections = Connection::where('user_id', $targetUserId)
        ->orWhere('connected_user_id', $targetUserId)
        ->pluck('user_id', 'connected_user_id')
        ->toArray();
        
        // Retrieve the common connections
        $commonConnections = Connection::where(function ($query) use ($targetUserConnections, $targetUserId) {
            $query->whereIn('user_id', $targetUserConnections)
                ->orWhereIn('connected_user_id', $targetUserConnections)
                ->where('user_id', '!=', $targetUserId)
                ->where('connected_user_id', '!=', $targetUserId);
        })->pluck('user_id', 'connected_user_id')->toArray();
        
        // Merge the target user's connections and common connections
        $allConnections = $targetUserConnections + $commonConnections;
        
        // Retrieve the common connection users' details
      return  $commonConnectionUsers = User::whereIn('id', $allConnections)->get();
    }
}

