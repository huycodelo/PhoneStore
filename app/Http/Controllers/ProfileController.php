<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user = null)
    {
        // Kiểm tra nếu chưa đăng nhập
        if (!Auth::check()) {
            return view('frontend.profile.show', ['user' => null, 'profile' => null]);
        }
    
        $user = Auth::user();
        $profile = $user->profile;
    
        return view('frontend.profile.show', compact('user', 'profile'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
    
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để cập nhật hồ sơ!');
        }
    
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'birthplace' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'phone_number' => 'nullable|string|max:20',
        ]);
    
        // Kiểm tra và tạo profile nếu chưa có
        $profile = $user->profile()->firstOrCreate(['user_id' => $user->id]);
    
        // Xử lý ngày sinh
        $birthdate = $request->input('birthdate') ? Carbon::parse($request->input('birthdate')) : null;
    
        // Cập nhật thông tin profile
        $profile->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'birthplace' => $request->input('birthplace'),
            'birthdate' => $birthdate,
            'phone_number' => $request->input('phone_number'),
        ]);
    
        return redirect()->route('frontend.profile.show')->with('success', 'Cập nhật hồ sơ thành công!');
    }
    
    
    

}
