<?php
namespace App\Http\Controllers\front;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Http\Models\BannerModel;
use App\Http\Models\FileModel;
use App\Http\Models\ConfigModel;
use App\Http\Models\ProgramModel;
use App\Http\Models\NoticeModel;

class MainController extends Controller 
{
	 public function __construct()
    {
    }

    //로그인 Action 시작
    public static function main(Request $request){

        try{
            $param = $request->all();
            
            //Banner
            $banners = BannerModel::select(array("del"=>"N", "not|open"=>0)
                , array("order"=>'open asc'));  
                
            $banners_files = array();
            if(!empty($banners)){
                foreach($banners as $key => $value){

                    $file = FileModel::select(array('id'=>$value->file_id), array());
                    if(!empty($file)){

                        $banners_files[$value->id] = $file[0];
                    }
                }
            }
            //end banner

            //program
            $config = ConfigModel::select(array('del'=>'N', 'name'=>'program'), array());
            $type = null;
            if(!empty($config)){
                $config = $config[0];
                $type = $config->type;
            }
            else {
                $config = new \stdclass;
                $config->id = 0;
                $config->option = '';
            }
            
            //program
            $selecter = array();
            $filter = array();
            $filter['start'] = 0;
            $filter['end'] = 4;
            if(empty($type) || $type == 'orderby'){
                $selecter['del'] = 'N';
                $filter['order'] = 'id desc';
            }
            else if( $type == 'hit'){
                $selecter['del'] = 'N';
                $filter['order'] = 'hit desc';
            }
            else if( $type == 'custom'){
                $selecter['del'] = 'N';
                $selecter['in|id'] = explode(',',$config->option);
            }

            $program =  ProgramModel::select($selecter, $filter);
            $program_files = array();
            foreach($program as $value){
                $file = FileModel::select(array('id'=>$value->file_id), array());
                if(!empty($file)){

                    $program_files[$value->id] = $file[0];
                }
            }
            //end program

            //notice
            $notice = NoticeModel::select(array("del"=>"N")
                , array("order"=>"id desc","start"=>0, "end"=>1));
            if(!empty($notice)){
                $notice = $notice[0];
            }
            //end notice


            return view('front.main', array(
                'banners' => $banners, 'banners_files'=>$banners_files,
                'programs'=> $program, 'programs_files'=>$program_files,
                'notice'=>$notice
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