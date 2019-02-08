<?php
namespace App\Http\Controllers\admin;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Models\BannerModel;
use App\Http\Models\FileModel;

class BannerController extends Controller 
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

            $banner = BannerModel::select(array("del"=>"N")
                , array());

            
                
            $files = array();
            if(!empty($banner)){
                foreach($banner as $key => $value){

                    $file = FileModel::select(array('id'=>$value->file_id), array());
                    if(!empty($file)){

                        $files[$value->id] = $file[0];
                    }
                }
            }

            return view('admin.banner.index', array('banner'=>$banner,'files'=>$files));
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
                BannerModel::insert(array('file_id'=>$param['file_id']));
            }
            else {
                BannerModel::update(array('file_id'=>$param['file_id']), array('id'=>$param['id']));
            }
            
            return redirect('/_admin/banner')->with('success','정상 반영되었습니다.');;
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