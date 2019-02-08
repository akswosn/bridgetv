<?php 
namespace App\Http\Models;
use App\Http\Models\Model;
use DB;

class ProgramSectionModel extends Model{


    public static function select($param, $filter){
        return  Model::selectBuild("program_section", $param, $filter);
    }

    public static function insert($param){
        return  Model::insertBuild("program_section", $param);
    }

    public static function update($param, $filter){
        return Model::updateBuild("program_section", $param, $filter);
    }

    public static function delete($param){
        return Model::deleteBuild("program_section", $sql, $param);
    }

    public static function selectCount($param){
        return  Model::selectCountBuild("program_section", $param);
    }
}   
?>