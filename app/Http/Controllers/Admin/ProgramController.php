<?php
namespace App\Http\Controllers\admin;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Models\ProgramModel;
use App\Http\Models\ProgramSectionModel;
use App\Http\Models\FileModel;
use App\Http\Models\ConfigModel;

class ProgramController extends Controller 
{
	 public function __construct()
    {
    }


    public static function list(Request $request, $page = 1){

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


            $program = ProgramModel::select(array("del"=>"N")
                , array("order"=>"id desc","start"=>$start, "end"=>$listCount));


            $sectionCount = array();
            if(!empty($program)){
                foreach($program as $value){
                    $section = ProgramSectionModel::selectCount(array("del"=>"N", 'p_id'=>$value->id));
                    $sectionCount[$value->id] = $section->count;
                }
            }

            $programCount = ProgramModel::selectCount(array("del"=>"N"));
            $pn =  Controller::getPageNavi('/_admin/account',$page, $listCount, $programCount->count, array());  


            return view('admin.program.list', array('program'=>$program, 'sectionCount'=> $sectionCount
                                        , 'count'=>$programCount->count
                                        , 'page'=>$page
                                        , 'listCount'=>$listCount
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

    public static function regist(Request $request){

        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }
            return view('admin.program.regist');
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
//registAction

    public static function registAction(Request $request){

        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }

            $validator = Validator::make($request->all(), [
                'name'=>'required'   
            ]);

            $param = $request->all();
            // var_dump($param); exit;
            if ($validator->fails()) {
                return redirect('/_admin/program/regist')
                ->withInput()
                ->withErrors($validator);;
            }

            $insertparam = array();
            $insertparam ['name'] = $param['name'];
            $insertparam ['type'] = $param['type'];
            $insertparam ['planning'] = $param['planning'];
            $insertparam ['genre'] = $param['genre'];
            $insertparam ['playtime'] = $param['playtime'];
            $insertparam ['cast'] = $param['cast'];
            if(!empty($param['file_id'])){
                $insertparam ['file_id'] = $param['file_id'];
            }
 
            ProgramModel::insert($insertparam);


            return redirect('/_admin/program/list')->with('success','등록되었습니다.');
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
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }


            $param = $request->all();
            

            $program = ProgramModel::select(array("id"=>$id)
                , array());
            $programSection = ProgramSectionModel::select(array("p_id"=>$id, 'del'=>'N')
                , array('order'=>'section asc'));
            
            $file = FileModel::select(array('id'=>$program[0]->file_id), array());

            return view('admin.program.uform', array('program'=> $program[0], 'programSection'=>$programSection, 'file'=>$file[0]));
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

    public static function updateAction(Request $request){
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }
            $validator = Validator::make($request->all(), [
                'name'=>'required'   
            ]);

            $param = $request->all();
            //var_dump($param);        
            
            if ($validator->fails()) {
                return redirect('/_admin/program/detail/'.$param['id'])
                ->withInput()
                ->withErrors($validator);;
            }
            
            $update = array();
            $update ['name'] = $param['name'];
            $update ['type'] = $param['type'];
            $update ['planning'] = $param['planning'];
            $update ['genre'] = $param['genre'];
            $update ['playtime'] = $param['playtime'];
            $update ['cast'] = $param['cast'];
            if(!empty($param['file_id'])){
                $update ['file_id'] = $param['file_id'];
            }
 
            ProgramModel::update($update, array('id'=>$param['id']));

            $cnt = $param['sectionCnt'];
           
            for($i = 1; $i <= $cnt ;$i++){
                $section = array(
                    'section'=>$param['section_'.$i]
                    , 'title'=>$param['title_'.$i]
                    , 'movie_link'=>$param['movie_link_'.$i]
                    ,'p_id'=>$param['id']
                    
                );
               
                if(empty($param['id_'.$i])){
                    ProgramSectionModel::insert($section);
                }
                else {
                    $section['updatedate']='now()';
                    ProgramSectionModel::update($section, array('id'=>$param['id_'.$i]));
                }
            }


            return redirect('/_admin/program/list')->with('success','수정되었습니다.');
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

    public static function secDelete(Request $request, $id = 0){
        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }

            ProgramSectionModel::update(array('del'=>'Y'), array('id'=>$id));

            return response() ->json(array('result'=>true), 200);
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

            ProgramModel::update(array('del'=>'Y'), array('id'=>$id));
            return redirect('/_admin/program/list')->with('success','삭제되었습니다.');
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


    public static function config(Request $request){

        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }

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
            $files = array();
            foreach($program as $value){
                $file = FileModel::select(array('id'=>$value->file_id), array());
                if(!empty($file)){

                    $files[$value->id] = $file[0];
                }
            }
           

            return view('admin.program.config', array('config'=>$config, 'type'=>$type, 'program'=> $program, 'file'=>$files ));
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
    public static function configAction(Request $request){

        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }

            $param = $request->all();

          

            if($param['id'] == 0){//insert
                ConfigModel::insert(array('type'=>$param['type']
                                            , 'option'=>$param['option']
                                            , 'name'=>'program'
                                        ));
            }
            else {//update
                ConfigModel::update(array('type'=>$param['type']
                                            , 'option'=>$param['option']
                                            
                                        ),
                                    array('id'=>$param['id']));
            }
           

            return redirect('/_admin/program/config')->with('success','저장되었습니다.');
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

    public static function programSearch(Request $request, $keyword=''){

        try{
            if(Controller::isLogin() === false){
                return redirect('/_admin/login')
                        ->withErrors([
                            'message' => '로그인 후 이용가능합니다.',
                        ]);
            }

            $param = $request->all();

            $program = ProgramModel::select(array("del"=>"N",  'like|name'=>'%'.$keyword.'%')
                , array("start"=>0, "end"=>4));

            return response() ->json($program, 200);
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