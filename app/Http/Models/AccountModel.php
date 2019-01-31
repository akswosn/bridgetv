<?php 
namespace App\Http\Models;
use App\Http\Models\Model;
use DB;

class AccountModel extends Model{


    public static function select($param, $filter){
        return  Model::selectBuild("account", $param, $filter);
    }

    public static function selectCount($param){
        return  Model::selectCountBuild("account", $param);
    }

    public static function insert($param){
        return  Model::insertBuild("account", $param);
    }

    public static function update($set, $where){
        return Model::updateBuild("account", $set, $where);
    }

    public static function delete($param){
        return Model::deleteBuild("account", $sql, $param);
    }
}   
?>