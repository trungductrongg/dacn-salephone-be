<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $admin_email = $request->input('admin_email');
        $admin_password = $request->input('admin_password');

        $admin = DB::table('tbl_admin')->where('admin_email', $admin_email)->first();

        if ($admin && $admin->admin_password === md5($admin_password)) {
            // Đăng nhập thành công
            return response()->json(["admin_id" => $admin], 200);
        } else {
            // Đăng nhập thất bại
            return response()->json(['message' => 'Tài khoản hoặc mật khẩu không đúng'], 401);
        }
    }

    public function log_out()
    {
    }
}
