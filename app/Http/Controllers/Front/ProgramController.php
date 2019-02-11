<?php
namespace App\Http\Controllers\front;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Models\FileModel;
use App\Http\Models\ProgramModel;


class ProgramController extends Controller 
{
	 public function __construct()
    {
    }

    public static function current(Request $request, $order=1,$page=1){

        try{
            $param = $request->all();
            $listCount = 4;

            
            $start = ($page-1) * $listCount;
            $end = $page * $listCount;
            $orderText = '';
            if($order == 1){
                $orderText = 'id desc';
            }
            else {
                $orderText = 'name asc';
            }

            $program = ProgramModel::select(array("del"=>"N", 'type'=>1)
                , array("order"=>$orderText,"start"=>$start, "end"=>$listCount));


            $files = array();
            if(!empty($program)){
                foreach($program as $key => $value){

                    $file = FileModel::select(array('id'=>$value->file_id), array());
                    if(!empty($file)){

                        $files[$value->id] = $file[0];
                    }
                }
            }
            

            $programCount = ProgramModel::selectCount(array("del"=>"N", 'type'=>1));
            $pn =  Controller::getPageNavi('/program/current/'.$order,$page, $listCount, $programCount->count, array());  
            

            return view('front.program.current', array(
                'order'=>$order
                , 'count'=>$programCount->count
                , 'page'=>$page
                , 'listCount'=>$listCount
                , 'pageNavigator'=>$pn
                , 'program'=>$program
                , 'files'=>$files
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

    public static function end(Request $request, $order='1',$page=1){

        try{
            $param = $request->all();
            $listCount = 4;

            
            $start = ($page-1) * $listCount;
            $end = $page * $listCount;
            $orderText = '';
            if($order == 1){
                $orderText = 'id desc';
            }
            else {
                $orderText = 'name asc';
            }

            $program = ProgramModel::select(array("del"=>"N", 'type'=>0)
                , array("order"=>$orderText,"start"=>$start, "end"=>$listCount));


            $files = array();
            if(!empty($program)){
                foreach($program as $key => $value){

                    $file = FileModel::select(array('id'=>$value->file_id), array());
                    if(!empty($file)){

                        $files[$value->id] = $file[0];
                    }
                }
            }
            

            $programCount = ProgramModel::selectCount(array("del"=>"N", 'type'=>0));
            $pn =  Controller::getPageNavi('/program/end/'.$order,$page, $listCount, $programCount->count, array());  
            

            return view('front.program.end', array(
                'order'=>$order
                , 'count'=>$programCount->count
                , 'page'=>$page
                , 'listCount'=>$listCount
                , 'pageNavigator'=>$pn
                , 'program'=>$program
                , 'files'=>$files
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

    public static function all(Request $request, $order='1',$page=1){

        try{
            $param = $request->all();
            $listCount = 4;

            
            $start = ($page-1) * $listCount;
            $end = $page * $listCount;
            $orderText = '';
            if($order == 1){
                $orderText = 'id desc';
            }
            else {
                $orderText = 'name asc';
            }

            $program = ProgramModel::select(array("del"=>"N")
                , array("order"=>$orderText,"start"=>$start, "end"=>$listCount));


            $files = array();
            if(!empty($program)){
                foreach($program as $key => $value){

                    $file = FileModel::select(array('id'=>$value->file_id), array());
                    if(!empty($file)){

                        $files[$value->id] = $file[0];
                    }
                }
            }
            

            $programCount = ProgramModel::selectCount(array("del"=>"N"));
            $pn =  Controller::getPageNavi('/program/all/'.$order,$page, $listCount, $programCount->count, array());  
            

            return view('front.program.all', array(
                'order'=>$order
                , 'count'=>$programCount->count
                , 'page'=>$page
                , 'listCount'=>$listCount
                , 'pageNavigator'=>$pn
                , 'program'=>$program
                , 'files'=>$files
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

    public static function detail(Request $request, $id = 0){
        try{
            $param = $request->all();

            $program = ProgramModel::select(array("id"=>$id), array());
            if(!empty($program)){
                $program = $program[0];
            }
            $file = FileModel::select(array('id'=>$program->file_id), array());
            $section = FileModel::select(array('p_id'=>$id, 'del'=>'N'), array("order"=>'section asc'));
            return view('front.program.detail', array(
                'program'=>$program , 'file'=>$file 
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
}