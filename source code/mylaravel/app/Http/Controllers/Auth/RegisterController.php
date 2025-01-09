<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');  // Trả về view đăng ký
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required', // "confirmed" để xác nhận mật khẩu
        ]);
        /* Lưu trữ thông tin người dùng vào csdl
        $user = new User();
        $user->username = $request->username;
        $user->password = $request->password;  // Lưu mật khẩu thô
        $user->save();*/

        // Tạo người dùng mới trong cơ sở dữ liệu
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Đăng nhập người dùng ngay sau khi đăng ký thành công
        Auth::login($user);

        // Thông báo đăng ký thành công và chuyển hướng về trang đăng nhập
        return redirect()->route('login')->with('success', 'Đăng ký thành công, bạn đã đăng nhập!');
    }
}
