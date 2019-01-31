<?php 
namespace App\Http\Models;
use App\Http\Models\Model;
use DB;

class ProgramModel extends Model{


    public static function select($param, $filter){
        return  Model::selectBuild("program", $param, $filter);
    }

    public static function insert($param){
        return  Model::insertBuild("program", $param);
    }

    public static function update($param, $filter){
        return Model::updateBuild("program", $param, $filter);
    }

    public static function delete($param){
        return Model::deleteBuild("program", $sql, $param);
    }
}   
?>