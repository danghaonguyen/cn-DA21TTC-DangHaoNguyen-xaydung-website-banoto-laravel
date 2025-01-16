<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm() // Hiển thị trang đăng nhập login.blade.php
    {
        return view('auth.login');
    }

    public function login(Request $request) // Xử lý đăng nhập - phân quyền admin/user
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) { // Kiểm tra email và passowrd trong csdl

            $user = Auth::user(); // Gọi Auth::user để lấy thông tin người dùng trong csdl

            return redirect()->intended($user->role === 'admin' ? '/admin' : '/'); 
            // Kiểm tra người dùng có phải là admin hay không
            // Nếu là người dùng có vai trò admin thì điều hướng đến trang admin và ngược lại thì vào trang cho user 
        }
        
        return redirect()->back()->withErrors(['login_error' => 'Tên email hoặc mật khẩu không đúng']);
        // Nếu đăng nhập thất bại thì sẽ thông báo lỗi
    }
    
    public function showRegisterForm() // Hiển thị trang đăng ký register.blade.php
    {
        return view('auth.register');
    }

    public function register(Request $request) // Xử lý đăng ký 
    {
        $request->validate([
            'name' => 'required|unique:users,name|max:255',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'user',
        ]);

        Auth::login($user);
        return redirect('/');
    }
    

    public function logout()    // Xử lý đăng xuất
    {
        Auth::logout();
        return redirect('/');
    }

    public function profile()
    {
        Auth::profile();
        return redirect('/');

        /*
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        return view('profile', compact('user')); // Trả về view profile với dữ liệu người dùng
        */
    }
}

