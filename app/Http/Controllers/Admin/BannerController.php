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
    public static function index(Request $request,$page=1){

        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }

            $listCount = 4;

            
            $start = ($page-1) * $listCount;
            $end = $page * $listCount;

            $banner1 = BannerModel::select(array("del"=>"N", "open"=>0)
            , array("order"=>'id desc',"start"=>$start, "end"=>$listCount));

            $banner2 = BannerModel::select(array("del"=>"N", "not|open"=>0)
            , array("order"=>'open asc',"start"=>$start, "end"=>$listCount));

            $count = BannerModel::selectCount(array("del"=>"N"));
            $pn =  Controller::getPageNavi('/_admin/banner',$page, $listCount, $count->count, array());  
                
            $files = array();
            if(!empty($banner1)){
                foreach($banner1 as $key => $value){

                    $file = FileModel::select(array('id'=>$value->file_id), array());
                    if(!empty($file)){

                        $files[$value->id] = $file[0];
                    }
                }
            }
            if(!empty($banner2)){
                foreach($banner2 as $key => $value){

                    $file = FileModel::select(array('id'=>$value->file_id), array());
                    if(!empty($file)){

                        $files[$value->id] = $file[0];
                    }
                }
            }
// var_dump($files);
            return view('admin.banner.index', array('lib_banner'=>$banner1,'main_banner'=>$banner2
                ,'files'=>$files
                , 'count'=>$count->count
                , 'page'=>$page
                , 'listCount'=>$listCount
                , 'pageNavigator'=>$pn
            ));
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
            
            return redirect('/_admin/banner')->with('success','정상 반영되었습니다.');
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

    public static function delete(Request $request, $id = 0){
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }

            BannerModel::update(array('del'=>'Y'), array('id'=>$id));

            return redirect('/_admin/banner')->with('success','삭제되었습니다.');
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

    public static function addMain(Request $request, $id = 0){
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }

            $max = BannerModel::selectOpenMax();

            BannerModel::update(array('open'=>$max->open), array('id'=>$id));

            return redirect('/_admin/banner')->with('success','메인에 등록되었습니다.');
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

    public static function deleteMain(Request $request, $id = 0){
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }

            BannerModel::update(array('open'=>0), array('id'=>$id));

            return redirect('/_admin/banner')->with('success','메인에서 삭제되었습니다.');
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