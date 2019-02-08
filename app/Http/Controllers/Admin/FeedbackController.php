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
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }

            $param = $request->all();
            $listCount = 10;

            
            $start = ($page-1) * $listCount;
            $end = $page * $listCount;


            $feedback = FeedbackModel::select(array("del"=>"N")
                , array("order"=>"id desc","start"=>$start, "end"=>$listCount));
            //var_dump($feedback);
            $feedbackCount = FeedbackModel::selectCount(array("del"=>"N"));

            $pn =  Controller::getPageNavi('/_admin/feedback',$page, $listCount, $feedbackCount->count, array());  

            return view('admin.feedback.index', 
                array('feedback'=>$feedback, 'count'=>$feedbackCount->count, 'page'=>$page, 'listCount'=>$listCount, 'pageNavigator'=>$pn));
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
            
            //update           
            FeedbackModel::update(array("hit_id"=>'|'.session('user')->id.'|'), array('id'=>$id));


            $data = FeedbackModel::selectPrevNextId($id); 
            

            $feedback = FeedbackModel::select(array("id"=>$id)
                , array());

            $preFeedback = null; $nextFeedback = null;

            if(!empty($data->prev)){
                $preFeedback = FeedbackModel::select(array("id"=>$data->prev)
                    , array())[0];
            }

            
            if(!empty($data->next)){
                $nextFeedback = FeedbackModel::select(array("id"=>$data->next)
                    , array())[0];
            }
           
            
            return view('admin.feedback.detail', array('feedback'=>$feedback[0] ,'pre'=>$preFeedback, 'next'=>$nextFeedback));
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