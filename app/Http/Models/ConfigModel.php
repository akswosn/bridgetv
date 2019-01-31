<?php 
namespace App\Http\Models;
use App\Http\Models\Model;
use DB;

class ConfigModel extends Model{


    public static function select($param, $filter){
        return  Model::selectBuild("config", $param, $filter);
    }

    public static function insert($param){
        return  Model::insertBuild("config", $param);
    }

    public static function update($param, $filter){
        return Model::updateBuild("config", $param, $filter);
    }

    public static function delete($param){
        return Model::deleteBuild("config", $sql, $param);
    }
}   
?>