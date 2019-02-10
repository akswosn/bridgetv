<?php
namespace App\Http\Controllers\front;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Http\Models\NoticeModel;

class BoardController extends Controller 
{
	 public function __construct()
    {
    }

    
    public static function list(Request $request){

        try{
            $param = $request->all();
            
            

            return view('front.main',array());
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
                return redirect('/_admin/login')
                    ->withErrors([
                        'message' => 'Validation Token was expired. Please try again',
                        'message-type' => 'danger']);
            }
        }
        
    }
}