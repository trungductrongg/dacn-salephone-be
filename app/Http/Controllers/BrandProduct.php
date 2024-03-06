<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandProduct extends Controller
{
    public function add_brand_product(Request $request)
    {
        $validatedData = $request->validate([
            'brand_product_name' => 'required|string|max:255',
            'brand_product_desc' => 'required|string',
            'brand_product_status' => 'required|boolean',
        ]);

        try {
            $data = [
                'brand_name' => $validatedData['brand_product_name'],
                'brand_desc' => $validatedData['brand_product_desc'],
                'brand_status' => $validatedData['brand_product_status'],
            ];
            DB::table('tbl_brand')->insert($data);
            return response()->json(['message' => 'Thêm thương hiệu sản phẩm thành công'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi khi thêm thương hiệu sản phẩm'], 500);
        }
    }

    public function all_brand_product()
    {
        $all_brand_product = DB::table('tbl_brand')->get();
        return response()->json($all_brand_product);
    }

    public function unactive_brand_product($brand_product_id)
    {
        DB::table('tbl_brand')
            ->where('brand_id', $brand_product_id)
            ->update(['brand_status' => 0]);

        $updatedData = DB::table('tbl_brand')
            ->where('brand_id', $brand_product_id)
            ->first();
        return $updatedData;
    }
    public function active_brand_product($brand_product_id)
    {
        DB::table('tbl_brand')
            ->where('brand_id', $brand_product_id)
            ->update(['brand_status' => 1]);

        $updatedData = DB::table('tbl_brand')
            ->where('brand_id', $brand_product_id)
            ->first();
        return $updatedData;
    }

    public function edit_brand_product($brand_product_id)
    {
        $edit_brand_product = DB::table('tbl_brand')->where('brand_id', $brand_product_id)->first();
        return $edit_brand_product;
    }

    public function update_brand_product(Request $request, $brand_product_id)
    {
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        $result = DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update($data);

        if ($result) {
            return response()->json(['message' => 'Cập nhật danh mục sản phẩm thành công'], 200);
        } else {
            return response()->json(['message' => 'Không thể cập nhật danh mục sản phẩm'], 500);
        }
    }

    public function delete_brand_product($brand_product_id)
    {
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        return response()->json(['message' => 'Xóa danh mục sản phẩm thành công'], 200);
    }
}
