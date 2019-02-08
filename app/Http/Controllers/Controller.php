<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected static function isLogin(){
		if (!session()->has('user')  ) {
		    return false;
		}
		return true;
	}

	protected static function getPageNavi($url, $page, $pageList, $total, $param){

		$totalPage = ceil($total / $pageList);
		
		
		$firstPage = 1+((ceil($page/10) -1)*10);
		$lastPage = $firstPage+9;
		
		if($lastPage > $totalPage){
			$lastPage = $totalPage;
		}
		
		if(!empty($param["page"])){
			unset($param["page"]);
		}
		
		return array(
			'url'=>$url,
			'page'=>$page,
			'pageList'=>$pageList,
			'totalList'=>$totalPage,
			'param'=>http_build_query($param),
			'first'=>$firstPage,
			'last'=>$lastPage
		);
	}
}
