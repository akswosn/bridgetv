<?php
namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Models\FileModel;
class FileController extends Controller 
{
    public static $FILE_UP_PATH = "D:\app\bridgetv\public\upload"; 
    //운영 : /icanpr/www/bridgetv/public/upload
    //로컬 : D:\app\bridgetv\public\upload

	 public function __construct()
    {
    }
    public static function upload(Request $request){
        try{
            $data = $request->all();
            
            $file = $data['fileupload'];
            
            if($file == 'undefined'){
                return response() ->json( array('err'=>'파일을 선택해 주세요'), 500);
            }
            $dir = self::$FILE_UP_PATH .'/'.$data['type'];
           
            if (!is_dir($dir)) {
                mkdir($dir);         
            }
            
            $new_filename = $data['type'].'_'.date("YmdHis").'.'.$file->getClientOriginalExtension();
            
            $fileName = $file->getClientOriginalName();

            
            $file->move($dir,$new_filename);
            
            $file_id = FileModel::insert(array('file_path'=>'/upload/'.$data['type'],'file_name'=>$new_filename,'org_file_name'=>$fileName ));
            
            $result = array('file_id'=>$file_id);
            return response() ->json($result, 200);
        }
        catch(Exception $e){
            if ($e instanceof \Illuminate\Session\TokenMismatchException){ //token error
                
            }
        }
    }

}