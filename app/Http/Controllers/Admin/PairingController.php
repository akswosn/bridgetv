<?php
namespace App\Http\Controllers\admin;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Models\PairingModel;
use App\Http\Models\FileModel;

class PairingController extends Controller 
{
	 public function __construct()
    {
    }

    //로그인 Action 시작
    public static function index(Request $request){

        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }

            $pairing = PairingModel::select(array("del"=>"N")
                , array());

            if(!empty($pairing)){
                $pairing = $pairing[0];
            }

            $pairing = PairingModel::select(array('del'=>'N'), array());
            $file = null;
            if(!empty($pairing)){
                $pairing = $pairing[0]; 
                $file = FileModel::select(array('id'=>$pairing->file_id), array());
                if(!empty($file)){
                    $file = $file[0];
                }
                else {
                    $file = null;
                }
                
            }
   
           

            return view('admin.pairing.index', array('pairing'=>$pairing,'file'=>$file));
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

    public static function update(Request $request){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }
            
            $param = $request->all();
            
            if($param['id'] == 0){
                PairingModel::insert(array('file_id'=>$param['file_id']));
            }
            else {
                PairingModel::update(array('file_id'=>$param['file_id']), array('id'=>$param['id']));
            }
            
            return redirect('/_admin/pairing')->with('success','등록되었습니다.');
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