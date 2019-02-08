<?php
namespace App\Http\Controllers\admin;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Models\AccountModel;

class AdminController extends Controller 
{
	 public function __construct()
    {
    }

    //로그인 뷰
    public static function login(Request $request){
        return view('admin.login');
    }

    //로그인 Action 시작
    public static function main(Request $request){

        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }
            return view('admin.main');
        }
        catch(Exception $e){
            if ($e instanceof \Illuminate\Session\TokenMismatchException){ //token error
                return redirect('/_admin/login')
                    ->withErrors([
                        'message' => 'Validation Token was expired. Please try again',
                        'message-type' => 'danger']);
            }
        }
        
    }


}