<?php 
namespace App\Http\Models;
use App\Http\Models\Model;
use DB;

class FileModel extends Model{


    public static function select($param, $filter){
        return  Model::selectBuild("file", $param, $filter);
    }

    public static function insert($param){
        return  Model::insertBuild("file", $param);
    }

    public static function update($param, $filter){
        return Model::updateBuild("file", $param, $filter);
    }

    public static function delete($param){
        return Model::deleteBuild("file", $sql, $param);
    }
}   
?>