<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $admin->createToken('admin-api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'admin' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'phone' => $admin->phone,
                'image' => $admin->image,
            ]
        ]);
    }

    // public function logout(Request $request)
    // {
    //     try {
    //         if (!$request->user()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'No authenticated user found'
    //             ], 401);
    //         }

    //         $request->user()->currentAccessToken()->delete();
            
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Logged out successfully'
    //         ]);
            
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Logout failed',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

}
