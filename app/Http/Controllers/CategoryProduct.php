<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryProduct extends Controller
{
    public function add_category_product(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'category_product_name' => 'required|string|max:255',
            'category_product_desc' => 'required|string',
            'category_product_status' => 'required|boolean',
        ]);

        try {
            // Tạo một mảng dữ liệu từ dữ liệu đầu vào
            $data = [
                'category_name' => $validatedData['category_product_name'],
                'category_desc' => $validatedData['category_product_desc'],
                'category_status' => $validatedData['category_product_status'],
            ];

            // Thêm dữ liệu vào cơ sở dữ liệu
            DB::table('tbl_category_product')->insert($data);

            // Trả về phản hồi thành công nếu mọi thứ diễn ra đúng
            return response()->json(['message' => 'Thêm danh mục sản phẩm thành công'], 200);
        } catch (\Exception $e) {
            // Xử lý lỗi và trả về phản hồi lỗi nếu có vấn đề xảy ra
            return response()->json(['error' => 'Đã xảy ra lỗi khi thêm danh mục sản phẩm'], 500);
        }
    }
}
