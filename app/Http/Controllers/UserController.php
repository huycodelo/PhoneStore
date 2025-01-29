<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hiển thị danh sách tất cả người dùng
    public function index()
    {
        $users = User::all();  // Lấy tất cả người dùng
        return view('admin.users.index', compact('users'));
    }

    // Hiển thị form tạo người dùng mới
    public function create()
    {
        return view('admin.users.create');
    }

    // Lưu người dùng mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|string|confirmed',
            'role' => 'required|in:user,admin', // Xác thực role
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role, // Lưu role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được thêm thành công!');
    }

    // Hiển thị thông tin chi tiết của người dùng
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Hiển thị form chỉnh sửa thông tin người dùng
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' . $user->id, // Loại bỏ định dạng email
            'role' => 'required|in:user,admin', // Xác thực role
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // Cập nhật role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật thông tin người dùng thành công!');
    }

    // Xóa người dùng
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa thành công!');
    }
}
