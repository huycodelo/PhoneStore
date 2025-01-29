<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Hiển thị danh sách tất cả danh mục
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Hiển thị form tạo danh mục mới
    public function create()
    {
        return view('admin.categories.create')->with('success','Tạo danh mục thành công!');
    }

    // Lưu danh mục mới
    public function store(Request $request)
    {
        // Xác thực đầu vào
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',  // Kiểm tra tên danh mục không trùng
            'description' => 'nullable|string|max:1000',  // Mô tả có thể bỏ trống
        ]);

        // Tạo danh mục mới
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Quay lại trang danh sách các danh mục với thông báo thành công
        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được tạo thành công!');
    }

    // Hiển thị thông tin chi tiết của danh mục
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Cập nhật thông tin danh mục
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index');
    }

    // Xóa danh mục
    public function destroy($id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    // Chuyển hướng với thông báo thành công
    return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được xóa thành công!');
}
}
