<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryProduct extends Controller
{
    public function add_category_product(Request $request)
    {
        $validatedData = $request->validate([
            'category_product_name' => 'required|string|max:255',
            'category_product_desc' => 'required|string',
            'category_product_status' => 'required|boolean',
        ]);

        try {
            $data = [
                'category_name' => $validatedData['category_product_name'],
                'category_desc' => $validatedData['category_product_desc'],
                'category_status' => $validatedData['category_product_status'],
            ];
            DB::table('tbl_category_product')->insert($data);
            return response()->json(['message' => 'Thêm danh mục sản phẩm thành công'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi khi thêm danh mục sản phẩm'], 500);
        }
    }

    public function all_category_product()
    {
        $all_category_product = DB::table('tbl_category_product')->get();
        return response()->json($all_category_product);
    }

    public function unactive_category_product($category_product_id)
    {
        DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->update(['category_status' => 0]);

        $updatedData = DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->first();
        return $updatedData;
    }
    public function active_category_product($category_product_id)
    {
        DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->update(['category_status' => 1]);

        $updatedData = DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->first();
        return $updatedData;
    }

    public function edit_category_product($category_product_id)
    {
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->first();
        return $edit_category_product;
    }
    public function update_category_product(Request $request, $category_product_id)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        $result = DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);

        if ($result) {
            return response()->json(['message' => 'Cập nhật danh mục sản phẩm thành công'], 200);
        } else {
            return response()->json(['message' => 'Không thể cập nhật danh mục sản phẩm'], 500);
        }
    }

    public function delete_category_product($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        return response()->json(['message' => 'Xóa danh mục sản phẩm thành công'], 200);
    }
}
