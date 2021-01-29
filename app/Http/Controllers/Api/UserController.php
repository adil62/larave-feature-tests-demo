<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request) {
        try { 
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'message' => 'success',
                'user' => $user
            ]);
        } catch(\Throwable $e) {
            report($e);
            return response()->json([
                'message' => 'failed creating user.'
            ], 400);
        }
    }

    public function update(Request $request, $userId) {
        try { 
            $user = User::find($userId);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'message' => 'success',
                'user' => $user
            ]);
        } catch(\Throwable $e) {
            report($e);
            return response()->json([
                'message' => 'failed creating user.'
            ], 400);
        }
    }
    
    public function delete($userId) {
        try {
            User::find($userId)->delete();

            return response()->json([
                'message' => 'successfully deleted user'
            ]);
        } catch(\Throwable $e) {
            report($e);
            dump($e);
            return response()->json([
                'message' => 'failed deleting user.'
            ], 400);
        }
    }
    
    public function show($userId) {
        return response()->json(User::find($userId));
    }
    
    public function index(Request $request) {
        return response()->json(User::all());
     }
}
