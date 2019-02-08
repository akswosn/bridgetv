<?php
namespace App\Http\Controllers\admin;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Models\NoticeModel;
use App\Http\Models\FileModel;
class NoticeController extends Controller 
{
	 public function __construct()
    {
    }

    public static function index(Request $request, $page=1){ 
       
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


            $notice = NoticeModel::select(array("del"=>"N")
                , array("order"=>"id desc","start"=>$start, "end"=>$listCount));

            $count = NoticeModel::selectCount(array("del"=>"N"));

            $pn =  Controller::getPageNavi('/_admin/notice',$page, $listCount, $count->count, array());  

            return view('admin.notice.index', 
                array('notice'=>$notice
                        , 'count'=>$count
                        , 'page'=>$page
                        , 'listCount'=>$count->count
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

    public static function reg(Request $request){
        
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }
            
            return view('admin.notice.form');

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
                'title'=>'required',
               
             ]);
            
            $param = $request->all();

            if ($validator->fails()) {
                return redirect('/_admin/notice/reg')
                ->withInput()
                ->withErrors($validator);;
            }
        

            $insertparam = array();
            $insertparam ['title'] = $param['title'];
            $insertparam ['content'] = $param['content'];
            if(!empty($param['ordering'])){
                $insertparam ['ordering'] = $param['ordering'];
            }
            if(!empty($param['file_id'])){
                $insertparam ['file_id'] = $param['file_id'];
            }
 
            NoticeModel::insert($insertparam);

            return redirect('/_admin/notice')->with('success','등록되었습니다.');
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
            

            $notice = NoticeModel::select(array("id"=>$id)
                , array())[0];
            if($notice->file_id > 0){
                $file = FileModel::select(array('id'=>$notice->file_id), array())[0];
            }
            else {
                $file = null;
            }
            

            return view('admin.notice.uForm', array('notice'=>$notice, 'file'=>$file));
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
                'title'=>'required',
               
             ]);
            
            $param = $request->all();

            if ($validator->fails()) {
                return redirect('/_admin/notice/detail/'.$id)
                ->withInput()
                ->withErrors($validator);;
            }
            $updateparam = array();
            $updateparam ['title'] = $param['title'];
            $updateparam ['content'] = $param['content'];
            if(!empty($param['ordering'])){
                $updateparam ['ordering'] = $param['ordering'];
            }
            if(!empty($param['file_id'])){
                $updateparam ['file_id'] = $param['file_id'];
            }
            
            NoticeModel::update($updateparam, array('id'=>$id));

            return redirect('/_admin/notice')->with('success','수정되었습니다.');
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
            NoticeModel::update($account, array('id'=>$id));

            return redirect('/_admin/notice')->with('success','삭제되었습니다.');
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