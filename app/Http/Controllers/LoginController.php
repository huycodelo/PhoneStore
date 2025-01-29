<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('login.login'); // Trỏ đến view login
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Validate input (Bỏ kiểm tra định dạng email)
        $request->validate([
            'email' => 'required|string', // Không kiểm tra định dạng email
            'password' => 'required',
        ]);

        // Lấy thông tin từ request
        $email = $request->email;
        $password = $request->password;

        // Thực hiện đăng nhập
        $status = Auth::attempt(['email' => $email, 'password' => $password], $request->has('rememberMe'));

        if ($status) {
            // Lấy thông tin user
            $user = Auth::user();

            // Kiểm tra role
            if ($user->role === 'admin') {
                return redirect()->route('admin.users.index'); // Role admin
            }

            // Người dùng với role khác
            return redirect()->route('shop.store');
        }

        // Trả về nếu đăng nhập thất bại
        return back()->with('msg', 'Email hoặc mật khẩu không đúng.');
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('login.register'); // Trỏ đến view register
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        // Validate dữ liệu đầu vào khi đăng ký (Bỏ kiểm tra định dạng email)
        $request->validate([
            'name' => 'required|string|max:255', // Kiểm tra tên
            'email' => 'required|string|unique:users,email', // Không kiểm tra định dạng email
            'password' => 'required|min:6|confirmed', // Kiểm tra mật khẩu và xác nhận mật khẩu
            'role' => 'required|in:user,admin', // Xác thực role
        ]);

        // Tạo người dùng mới trong cơ sở dữ liệu
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu trước khi lưu
            'role' => $request->role, // Lưu role
        ]);

        // Đăng nhập ngay sau khi đăng ký
        Auth::login($user);
        $request->session()->regenerate();

        // Chuyển hướng đến trang đăng nhập hoặc trang khác
        return redirect()->route('login');
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        // Đăng xuất người dùng
        Auth::logout();

        // Hủy phiên làm việc của người dùng
        $request->session()->invalidate();

        // Tái tạo session để bảo mật
        $request->session()->regenerateToken();

        // Chuyển hướng đến trang đăng nhập sau khi đăng xuất
        return redirect()->route('login');
    }
}
