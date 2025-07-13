<?php

namespace Modules\Gift\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * 用户登录并获取 Token
     */
    public function login(Request $request)
    {
        // 只取 email 和 password 进行验证
        $credentials = $request->only('name', 'password');

        try {
            // 验证账号密码是否正确，如果失败则返回错误
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => '账号或密码错误'], 401);
            }
        } catch (JWTException $e) {
            // 生成 token 出错时返回错误
            return response()->json(['error' => '无法生成 Token'], 500);
        }

        // 登录成功，返回 token
        return response()->json(compact('token'));
    }

    /**
     * 用户登出
     */
    public function logout()
    {
        auth()->logout(); // 使当前 token 失效

        return response()->json(['message' => '退出登录成功']);
    }
}