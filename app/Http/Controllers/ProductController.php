<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function showJson(Product $product)
    {
        return response()->json($product); // Trả về sản phẩm dưới dạng JSON
    }
    public function index()
    {
        $products = Product::all();  // Lấy tất cả sản phẩm từ cơ sở dữ liệu
        return view('admin.products.index', compact('products')); // Chuyển biến products vào view
    }


    // Hiển thị form tạo sản phẩm mới
    public function edit(Product $product)
    {
        $categories = Category::all();  // Lấy tất cả các danh mục
        return view('admin.products.edit', compact('product', 'categories'))->with('success', 'Sản phẩm đã được chỉnh sửa thành công!');
    }

    // Lưu sản phẩm mới
        public function store(Request $request)
        {
            // Validate dữ liệu đầu vào
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'description' => 'nullable|string|max:500',
                'detail' => 'nullable|string',
                'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate cho nhiều ảnh
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            // Tạo mới sản phẩm
            $product = new Product();
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->quantity = $request->input('quantity');
            $product->category_id = $request->input('category_id');
            $product->description = $request->input('description');
            $product->detail = $request->input('detail');
        
            // Xử lý ảnh đại diện (img)
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);
                $product->img = 'uploads/' . $imageName;
            }
        

            // Xử lý thư viện ảnh (gallery)
            if ($request->hasFile('gallery')) {
                $galleryImages = []; // Tạo mảng lưu trữ đường dẫn
                foreach ($request->file('gallery') as $galleryImage) {
                    // Kiểm tra nếu file hợp lệ
                    if ($galleryImage->isValid()) {
                        $galleryImageName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                        $galleryImage->move(public_path('uploads/gallery'), $galleryImageName);
                        $galleryImages[] = 'uploads/gallery/' . $galleryImageName; // Lưu đường dẫn vào mảng
                    }
                }
                $product->gallery = json_encode($galleryImages); // Lưu mảng JSON vào database
            }


        
            // Lưu sản phẩm vào cơ sở dữ liệu
            $product->save();
        
            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo thành công!');
        }
        
        
        
        
        
        
        

    // Hiển thị chi tiết sản phẩm
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
        
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function create()
{
    $categories = Category::all();  // Lấy tất cả các danh mục
    return view('admin.products.create', compact('categories'));
}
public function detail(Product $product)
{
        // Lấy các sản phẩm liên quan dựa trên cùng danh mục, loại trừ sản phẩm hiện tại
        $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(8) // Giới hạn số sản phẩm liên quan (ví dụ: 8 sản phẩm)
        ->get();

return view('frontend.shop.details', compact('product', 'relatedProducts'));
    return view('frontend.shop.details', compact('product'));
}


// Cập nhật sản phẩm
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // Validate dữ liệu đầu vào
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string',
        'detail' => 'nullable|string',
        'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate cho ảnh thư viện
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate cho ảnh chính
    ]);

    // Cập nhật thông tin sản phẩm
    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->quantity = $request->input('quantity');
    $product->category_id = $request->input('category_id');
    $product->description = $request->input('description');
    $product->detail = $request->input('detail');

    // Cập nhật ảnh đại diện (img)
    if ($request->hasFile('img')) {
        // Xóa ảnh cũ nếu có
        if ($product->img) {
            File::delete(public_path($product->img)); // Xóa ảnh cũ
        }

        $image = $request->file('img');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);
        $product->img = 'uploads/' . $imageName;
    }

    // Xử lý thư viện ảnh (gallery)
    if ($request->hasFile('gallery')) {
        $galleryImages = []; // Mảng lưu trữ các đường dẫn ảnh trong thư viện
        foreach ($request->file('gallery') as $galleryImage) {
            // Kiểm tra nếu file hợp lệ
            if ($galleryImage->isValid()) {
                $galleryImageName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('uploads/gallery'), $galleryImageName);
                $galleryImages[] = 'uploads/gallery/' . $galleryImageName; // Thêm đường dẫn vào mảng
            }
        }

        // Lưu mảng JSON vào cơ sở dữ liệu
        $product->gallery = json_encode($galleryImages);
    }

    // Lưu sản phẩm vào cơ sở dữ liệu
    $product->save();

    return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
}

    
    
    
    
    
    
    

    // Xóa sản phẩm
    // Xóa sản phẩm
    public function destroy(Product $product)
    {
        // Xóa ảnh đại diện nếu có
        if ($product->img && File::exists(public_path($product->img))) {
            File::delete(public_path($product->img));
        }
    
        // Xóa các hình ảnh trong thư viện ảnh (gallery) nếu có
        if ($product->gallery) {
            $galleryImages = json_decode($product->gallery);
            foreach ($galleryImages as $image) {
                if (File::exists(public_path($image))) {
                    File::delete(public_path($image));
                }
            }
        }
    
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }
    
}
