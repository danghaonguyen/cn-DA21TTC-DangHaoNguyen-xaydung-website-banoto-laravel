<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
  // Để sử dụng chức năng đăng nhập của Laravel

class LoginController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login'); // Trả về view login
    }

    public function login(Request $request)
{
    // Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Tìm người dùng theo tên đăng nhập
    $user = User::where('email', $request->email)->first();

    // Kiểm tra mật khẩu 
    if ($user && $user->password == $request->password) {
        // Đăng nhập người dùng
        Auth::login($user);

       // session()->flash('success', 'Đăng nhập thành công!');

        // Phân quyền dựa trên role
        if ($user->role == 'admin') {
            // Nếu là admin, chuyển hướng đến dashboard
            return redirect()->route('admin.home-dashboard');
            
        } else {
            // Nếu không phải admin, chuyển hướng đến home
            return redirect()->route('home');
        }
    }

    // Nếu không hợp lệ, trả về lỗi
    return back()->withErrors([
        'email' => 'Tên email hoặc mật khẩu không đúng.',
    ]);
    }

    // Đăng xuất người dùng
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }

    public function profile()
    {
        Auth::profile();
        return redirect()->route('login.form');
    }
}



