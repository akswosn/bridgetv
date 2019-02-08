<?php 
namespace App\Http\Models;
use App\Http\Models\Model;
use DB;

class NoticeModel extends Model{


    public static function select($param, $filter){
        return  Model::selectBuild("notice", $param, $filter);
    }

    public static function insert($param){
        return  Model::insertBuild("notice", $param);
    }

    public static function update($param, $filter){
        return Model::updateBuild("notice", $param, $filter);
    }

    public static function delete($param){
        return Model::deleteBuild("notice", $sql, $param);
    }
    public static function selectCount($param){
        return  Model::selectCountBuild("notice", $param);
    }
}   
?>