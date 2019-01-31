<?php
namespace App\Http\Controllers\admin;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Models\AccountModel;

class AccountController extends Controller 
{
	 public function __construct()
    {
    }

    public static function list(Request $request, $page=1){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'msg' => '로그인 후 이용가능합니다.',
                        ]);
            }
            $param = $request->all();
            $listCount = 10;

            
            $start = ($page-1) * $listCount;
            $end = $page * $listCount;


            $user = AccountModel::select(array("del"=>"N")
                , array("order"=>"id desc","start"=>$start, "end"=>$end));

            $userCount = AccountModel::selectCount(array("del"=>"N"));
            
            return view('admin.account.index', array('account'=>$user, 'count'=>$userCount, 'page'=>$page, 'listCount'=>$listCount));
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

   
    public static function detail(Request $request, $id=0){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'msg' => '로그인 후 이용가능합니다.',
                        ]);
            }
            $param = $request->all();
            
           ;
            $user = AccountModel::select(array("id"=>$id)
                , array());

            
            
            return view('admin.account.uForm', array('account'=>$user[0]));
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

    public static function reg(Request $request){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'msg' => '로그인 후 이용가능합니다.',
                        ]);
            }
            
            
            return view('admin.account.form');
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

    public static function regAction(Request $request){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'msg' => '로그인 후 이용가능합니다.',
                        ]);
            }
            
            $param = $request->all();
            


            
            $account = array(
                'userid'=>$param['userid'],
                'password'=>$param['password'],
                'name'=>$param['name'],
                'type'=>$param['type']
            );
            AccountModel::insert($account);

            return redirect('/_admin/account');
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


    public static function updateAction(Request $request, $id=0){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'msg' => '로그인 후 이용가능합니다.',
                        ]);
            }
            
            $param = $request->all();

            $account = array(
                'userid'=>$param['userid'],
                'password'=>$param['password_pre'],
            );
            $user = AccountModel::select($account, array());
            
            if(count($user) == 0){
                //로그인 실패
                return redirect('/_admin/account/detail/'.$id)
                ->withErrors([
                    'msg' => '이전비밀번호 오류',
                ]);
            }


            
            $account = array(
                'userid'=>$param['userid'],
                'name'=>$param['name'],
                'type'=>$param['type']
            );
            if($param['password'] != ''){
                $account['password'] = $param['password'];
            }

            AccountModel::update($account, array('id'=>$id));

            return redirect('/_admin/account');
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
    public static function deleteAction(Request $request, $id=0){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'msg' => '로그인 후 이용가능합니다.',
                        ]);
            }
            
            $param = $request->all();
            
            $account = array(
                'del'=>'Y'
            );
            AccountModel::update($account, array('id'=>$id));

            return redirect('/_admin/account');
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