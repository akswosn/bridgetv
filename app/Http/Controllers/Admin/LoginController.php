<?php
namespace App\Http\Controllers\admin;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Models\AccountModel;

class LoginController extends Controller 
{
	 public function __construct()
    {
    }

    //로그인 뷰
    public static function login(Request $request){
        return view('admin.login');
    }

    //로그인 Action 시작
    public static function loginAction(Request $request){

        try{
            $param = $request->all();
        
            //회원 추가 TEST
            // $account = array(
            //     'userid'=>$param['userid'],
            //     'password'=>$param['password'],
            //     'name'=>'조영두',
            //     'type'=>1
            // );
            // AccountModel::insert($account);
            //var_dump($param);
            $account = array(
                'userid'=>$param['userid'],
                'password'=>$param['password'],
            );
            $user = AccountModel::select($account, array());
            
            if(count($user) == 0){
                //로그인 실패


                return redirect('/_admin/login')
                ->withErrors([
                    'msg' => '로그인실패',
                ]);
            }
            else{
                //로그인성공
                //세션저장
                session(['user' => $user[0]]);
                var_dump($user[0]->id);
                //로그인시간 업데이트
                AccountModel::update(array('logindate'=>''), array('id'=>$user[0]->id));

            }
                    

            return redirect('/_admin');
        }
        catch(Exception $e){
            if ($e instanceof \Illuminate\Session\TokenMismatchException){ //token error
                return redirect('/_admin/login')
                    ->withErrors([
                        'msg' => 'Validation Token was expired. Please try again',
                        'message-type' => 'danger']);
            }
        }
        
    }


}