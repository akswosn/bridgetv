<?php 
namespace App\Http\Models;
use App\Http\Models\Model;
use DB;

class BannerModel extends Model{


    public static function select($param, $filter){
        return  Model::selectBuild("banner", $param, $filter);
    }

    public static function insert($param){
        return  Model::insertBuild("banner", $param);
    }

    public static function update($param, $filter){
        return Model::updateBuild("banner", $param, $filter);
    }

    public static function delete($param){
        return Model::deleteBuild("banner", $sql, $param);
    }
}   
?>