<?php 
namespace App\Http\Models;
use App\Http\Models\Model;
use DB;

class FeedbackModel extends Model{


    public static function select($param, $filter){
        return  Model::selectBuild("feedback", $param, $filter);
    }
    public static function selectCount($param){
        return  Model::selectCountBuild("feedback", $param);
    }
    public static function insert($param){
        return  Model::insertBuild("feedback", $param);
    }

    public static function update($param, $filter){
        return Model::updateBuild("feedback", $param, $filter);
    }

    public static function delete($param){
        return Model::deleteBuild("feedback", $sql, $param);
    }
}   
?>