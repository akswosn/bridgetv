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
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }
            $param = $request->all();
            $listCount = 10;

            
            $start = ($page-1) * $listCount;
            $end = $page * $listCount;


            $user = AccountModel::select(array("del"=>"N")
                , array("order"=>"id desc","start"=>$start, "end"=>$listCount));

            $userCount = AccountModel::selectCount(array("del"=>"N"));
            $pn =  Controller::getPageNavi('/_admin/account',$page, $listCount, $userCount->count, array());  
            
            return view('admin.account.index', array('account'=>$user
                                                , 'count'=>$userCount->count
                                                , 'page'=>$page
                                                , 'listCount'=>$listCount
                                                , 'pageNavigator'=>$pn));
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
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }
            $param = $request->all();
            

            $user = AccountModel::select(array("id"=>$id)
                , array());
            
            return view('admin.account.uForm', array('account'=>$user[0]));
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

    public static function reg(Request $request){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }
            
            
            return view('admin.account.form');
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

    public static function regAction(Request $request){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }
            $validator = Validator::make($request->all(), [
                'type'=>'required',
                'name'=>'required',
                'userid'=>'required',
                'password'=>'required',
		        'password_confirm'=>'required|same:password',
             ]);
            
            $param = $request->all();

            if ($validator->fails()) {
                
                return redirect('/_admin/account/reg')
                ->withInput()
                ->withErrors($validator);
            }

            $check = array(
                'userid'=>$param['userid'],
                'del'=>'N'
            );

            $userCount = AccountModel::selectCount($check);
            if(!empty($userCount)){
                
                if($userCount->count > 0){
                    return redirect('/_admin/account/reg')->withInput()
                    ->withErrors([
                        'userid' => '중복된 아이디입니다.',
                    ]);
                }
            }


            $account = array(
                'userid'=>$param['userid'],
                'password'=>$param['password'],
                'name'=>$param['name'],
                'type'=>$param['type']
            );
            AccountModel::insert($account);

            return redirect('/_admin/account')
                ->with('success','등록되었습니다.');
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


    public static function updateAction(Request $request, $id=0){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }
            $validator = Validator::make($request->all(), [
                'type'=>'required',
                'name'=>'required',
                'userid'=>'required',
                'password_pre'=>'required|min:8',
                'password'=>'',
		        'password_confirm'=>'same:password',
             ]);

            $param = $request->all();

            if ($validator->fails()) {
                return redirect('/_admin/account/detail/'.$id)
                ->withInput()
                ->withErrors($validator);;
            }

            $account = array(
                'userid'=>$param['userid'],
                'password'=>$param['password_pre'],
            );
            $user = AccountModel::select($account, array());
            
            if(count($user) == 0){
                //로그인 실패
                return redirect('/_admin/account/detail/'.$id)
                ->withErrors([
                    'message' => '이전비밀번호 오류',
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

            return redirect('/_admin/account')->with('success','수정되었습니다.');
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
    public static function deleteAction(Request $request, $id=0){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }
            
            $param = $request->all();
            
            $account = array(
                'del'=>'Y'
            );
            AccountModel::update($account, array('id'=>$id));

            return redirect('/_admin/account')->with('success','삭제되었습니다.');
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