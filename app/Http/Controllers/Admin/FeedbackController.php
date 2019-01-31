<?php
namespace App\Http\Controllers\admin;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Models\FeedbackModel;

class FeedbackController extends Controller 
{
	 public function __construct()
    {
    }



    public static function index(Request $request, $page=1){

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


            $feedback = FeedbackModel::select(array("del"=>"N")
                , array("order"=>"id desc","start"=>$start, "end"=>$end));

            $feedbackCount = FeedbackModel::selectCount(array("del"=>"N"));

            return view('admin.feedback.index', 
                array('feedback'=>$feedback, 'count'=>$feedbackCount, 'page'=>$page, 'listCount'=>$listCount));
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
            $feedback = FeedbackModel::select(array("id"=>$id)
                , array());

            
            
            return view('admin.feedback.detail', array('feedback'=>$feedback[0]));
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