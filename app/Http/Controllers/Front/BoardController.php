<?php
namespace App\Http\Controllers\front;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Http\Models\NoticeModel;
use App\Http\Models\PairingModel;
use App\Http\Models\FileModel;
use App\Http\Models\FeedbackModel;

class BoardController extends Controller 
{
	 public function __construct()
    {
    }

    
    public static function noticeList(Request $request, $page=1){

        try{
            $param = $request->all();
            

            $listCount = 10;

            
            $start = ($page-1) * $listCount;
            $end = $page * $listCount;


            $notice = NoticeModel::select(array("del"=>"N")
                , array("order"=>"id desc","start"=>$start, "end"=>$listCount));

            $count = NoticeModel::selectCount(array("del"=>"N"));

            $pn =  Controller::getPageNavi('/board/notice',$page, $listCount, $count->count, array());  

            return view('front.board.notice', 
                    array('notice'=>$notice
                        , 'count'=>$count
                        , 'page'=>$page
                        , 'listCount'=>$count->count
                        , 'pageNavigator'=>$pn));
        }
        catch(Exception $e){
            if ($e instanceof \Illuminate\Session\TokenMismatchException){ //token error
                return redirect('/')
                    ->withErrors([
                        'message' => 'Validation Token was expired. Please try again',
                        'message-type' => 'danger']);
            }
        }
        
    }

    public static function noticeDetail(Request $request, $id = 0){

        try{
            $param = $request->all();


            $notice = NoticeModel::select(array("id"=>$id)
                , array())[0]; 

            //hit update
            NoticeModel::update(array('hit'=> $notice->hit+1), array('id'=>$id));
            $data = NoticeModel::selectPrevNextId($id); 
            $preNotice = null;
            $nextNotice = null;
            if(!empty($data->prev)){
                $preNotice = NoticeModel::select(array("id"=>$data->prev)
                    , array())[0];
            }

            
            if(!empty($data->next)){
                $nextNotice = NoticeModel::select(array("id"=>$data->next)
                    , array())[0];
            }

            return view('front.board.noticeDetail', array('notice'=>$notice,'pre'=>$preNotice, 'next'=>$nextNotice));
        }
        catch(Exception $e){
            if ($e instanceof \Illuminate\Session\TokenMismatchException){ //token error
                return redirect('/')
                    ->withErrors([
                        'message' => 'Validation Token was expired. Please try again',
                        'message-type' => 'danger']);
            }
        }
        
    }

  
    public static function pairing(Request $request){

        try{

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
            return view('front.board.pairing', array('pairing'=>$pairing,'file'=>$file));
        }
        catch(Exception $e){
            if ($e instanceof \Illuminate\Session\TokenMismatchException){ //token error
                return redirect('/')
                    ->withErrors([
                        'message' => 'Validation Token was expired. Please try again',
                        'message-type' => 'danger']);
            }
        }
        
    }

    public static function feedback(Request $request){

        try{
            $validator = Validator::make($request->all(), [
                'name'=> 'required' ,
                'email'=>'required|email' ,
                'phone'=> 'required',
                'content'=>'required' 
            ]);
            $param = $request->all();
               
            
            if ($validator->fails()) {
                return redirect('/board/feedback')
                ->withInput()
                ->withErrors($validator);;
            }

            

            FeedbackModel::insert(array(
                'name'=>$param['name'],
                'email'=>$param['email'],
                'phone'=>$param['phone'],
                'content'=>$param['content'],
            ));
            return redirect('/board/feedback') ->with('success','시청자 의견이 등록 되었습니다.');;
        }
        catch(Exception $e){
            if ($e instanceof \Illuminate\Session\TokenMismatchException){ //token error
                return redirect('/')
                    ->withErrors([
                        'message' => 'Validation Token was expired. Please try again',
                        'message-type' => 'danger']);
            }
        }
        
    }

}