<?php 
namespace App\Http\Models;
use App\Http\Models\Model;
use DB;

class PairingModel extends Model{


    public static function select($param, $filter){
        return  Model::selectBuild("pairing", $param, $filter);
    }

    public static function insert($param){
        return  Model::insertBuild("pairing", $param);
    }

    public static function update($param, $filter){
        return Model::updateBuild("pairing", $param, $filter);
    }

    public static function delete($param){
        return Model::deleteBuild("pairing", $sql, $param);
    }
}   
?>