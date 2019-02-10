<?php
namespace App\Http\Controllers\front;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;



class ProgramController extends Controller 
{
	 public function __construct()
    {
    }

    //로그인 Action 시작
    public static function main(Request $request){

        try{
            $param = $request->all();
            
            


            return view('front.main', array(
                
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