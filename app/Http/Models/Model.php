<?php
namespace App\Http\Models;
use DB;

class Model{
	protected function __construct(){
	}
	
	 public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }
        return $instance;
    }
	
		
	 /**
     * *싱글턴* 인스턴스를 복제할 수 없도록 복제 메소드를 private
     * 으로 제한한다.
     *
     * @return void
     */
    private function __clone()
    {
    }
    /**
     * *싱글턴* 인스턴스를 unserialize 하지 못하게 private 으로 제한한다.
     *
     * @return void
     */
    private function __wakeup()
    {
    }

    /**
     * Detault Querys
     */
    public static function selectBuild($table, $param, $filter){

        $sql = "SELECT * FROM  ".$table;

        if(count($param) > 0){
            $sql .= ' '.Model::selectWhereBuild($param);
        }
        $selectParam = Model::commonParam($param);

        if(array_key_exists('order', $filter) ){
            $sql .= ' order by '.$filter['order'];
        }

        if(array_key_exists('start', $filter)  && array_key_exists('end', $filter) ){
            $sql = "select @RNUM := @RNUM + 1 AS rownum,
                    a.* from ( ".$sql." ) a 
                    , ( SELECT @RNUM := 0 ) R
                LIMIT ?, ? ";
            $selectParam[] = $filter['start'];
            $selectParam[] = $filter['end'];
        }
        return  DB::select($sql, $selectParam);
    }

    public static function selectCountBuild($table, $param){
        $sql = "SELECT count(*) as count FROM  ".$table;

        if(count($param) > 0){
            $sql .= ' '.Model::selectWhereBuild($param);
        }
        $selectParam = Model::commonParam($param);
        return  DB::select($sql, $selectParam)[0];
    }

    public static function insertBuild($table, $param){
        $pdo = DB::connection()->getPdo();
        if(count($param) == 0){
            return null;
        }
    
        $sql = " insert into ".$table." ( ".Model::insertKeyBuild($param)." ) ";
        $sql .= " values( ".Model::insertValueBuild($param)." ) ";
        $insertParam = Model::commonParam($param);
        $result = DB::insert($sql, $insertParam);

        if ( $result )  {
            $rowId = $pdo->lastInsertId();
        }
        return $rowId;	
    }

    public static function updateBuild($table, $set, $where){ 

       // var_dump($set);  
       //var_dump($where);
        $param = array();
        $setSql = "";
        foreach ($set as $key => $value) {
            $K=$key;
            $V ='';

            if($key == 'password'){
                $v = 'password( ? )';
                $param [] = $value;
            }
            else if($key == 'updatedate' || $key == 'logindate'){
                $v = 'now()';
                
            }
            else {
                $v = '?';
                $param [] = $value;
            }
            
            if($setSql == ''){
                $setSql .= $K.'='.$v;
            }
            else {
                $setSql .= ', '.$K.'='.$v;
            }
        }

        $whereSql = '';
        $v = '';
        $k = '';
        foreach ($where as $key => $value) {
            $k = $key;
            
            if($key == 'password'){
                $v = 'password( ? )';
            }
            else {
                $v = '?';
            }
            $param[] = $value;
            
            if($whereSql == ''){
                $whereSql .= $k.'='.$v;
            }
            else {
                $whereSql .= ' and '.$k.'='.$v;
            }
        }



        $sql = "update ".$table." set ".$setSql; 
        if($whereSql != ''){
            $sql .= " where ".$whereSql;
        }
      
        return DB::update($sql, $param);
    }

    public static function deleteBuild($table, $param){
        $sql = "delete from ".$table." where ";

        return DB::delete($sql, $param);
    }

   

    /**
     * QUERY BUILD
     */
    public static function commonParam($array){
        $result = array();
        foreach ($array as $key => $value) {
            $result[] =  $value;
        }

        return  $result;
    }

    public static function insertKeyBuild($array){
        $result = array_keys($array);
        return join(', ', $result).", createDate";
    }

    public static function insertValueBuild($array){
        $result = "";
        foreach ($array as $key => $value) {

            $t = '?';
            if($key == 'password'){//password func
                $t = 'password( ? )';
            }

            if($result == ''){
                
                $result .= ' '.$t;
                
            }
            else {
                $result .= ', '.$t;
            }
        }
        $result .= ", now()";
        
        return $result;
    }

    public static function selectWhereBuild($array){
        $result = "";
        foreach ($array as $key => $value) {
            $t = '?';
            if($key == 'password'){//password func
                $t = 'password( ? )';
            }


            if($result == ''){
                $result .= ' '.$key.' = '.$t;
            }
            else {
                $result .= ' and '.$key.' = '.$t;
            }
        }
        return 'where '.$result ;
    }

}
?>