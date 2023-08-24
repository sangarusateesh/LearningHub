<?php 
if(isset($_SERVER['REMOTE_ADDR'])){
    require_once "db.php";
}else{
    require_once "/home/bnkgrouprealesta/public_html/classes/db.php";
}
class Cls extends Db
{
    public $con;
    public function __construct() { $this->con = $this->getConnection(); }
    public function logError($sql) { error_log( $sql."\n #" . mysqli_errno($this->con) .' - '. mysqli_error($this->con)); die(); }
    public function get_table_columns($data) {
        $table = !empty($data['table']) ? TABLE_PREFIX.$data['table'] : '';
        if(empty($table)){return false;}
        $sql = "SHOW COLUMNS FROM $table ";
        $result = mysqli_query($this->con, $sql) or $this->logError($sql."\n". __FILE__." on line ".__LINE__);
        if($result && mysqli_num_rows($result) > 0) { while($row = mysqli_fetch_assoc($result)){$arr[]=$row['Field']; } return $arr;}
    }     
    public function get_found_rows() {
        $sql = "SELECT FOUND_ROWS() as total";
        $result = mysqli_query($this->con, $sql) or $this->logError($sql."\n". __FILE__." on line ".__LINE__);
        if($result && mysqli_num_rows($result)>0) { $rec = mysqli_fetch_assoc($result); return $rec['total'];}
    } 
    public function get_total_rows($data) {
        $table = !empty($data['table']) ? TABLE_PREFIX.$data['table'] : ''; if(empty($table)){return false;}        
        $where = !empty($data['where']) ? " where ".$data['where'] : '';
        $filed = !empty($data['field']) ? $data['field'] : '*';
        $sql = "SELECT count($filed) as total from $table $where ";
        $result = mysqli_query($this->con, $sql) or $this->logError($sql."\n". __FILE__." on line ".__LINE__);
        if($result && mysqli_num_rows($result)>0) { $rec = mysqli_fetch_assoc($result); return $rec['total'];}
    }    
    public function reset_auto_increment_id($table) {
        if(empty($table)){return false;}
        $sql = "UPDATE ".TABLE_PREFIX."$table, (SELECT @id := 0) dm SET id = (@id := @id + 1);";
        $result = mysqli_query($this->con, $sql) or $this->logError($sql."\n". __FILE__." on line ".__LINE__);
        $sql = "ALTER TABLE ".TABLE_PREFIX."$table AUTO_INCREMENT = 1";
        $result = mysqli_query($this->con, $sql) or $this->logError($sql."\n". __FILE__." on line ".__LINE__);
        if($result && mysqli_affected_rows($this->con) > 0) { return true;}
    } 
    public function insert_data($data){ //print_r($data);exit;
        $table = !empty($data['table']) ? $data['table'] : ''; if(empty($table)){return false;} //echo $table;exit;
        $fileds=$values='';
        foreach($data['data'] as $filed=>$value){
            $fileds .= $filed.",";
            $values .= "'".$value."',";
        }
        $sql = "insert into $table (".rtrim($fileds,',').") values (".rtrim($values,',').")";//echo $sql;exit;
        $result = mysqli_query($this->con, $sql) or $this->logError($sql."\n". __FILE__." on line ".__LINE__);
        if($result && mysqli_affected_rows($this->con)) { return mysqli_insert_id($this->con);}
    }
    public function update_data($data){ 
        $table = !empty($data['table']) ? $data['table'] : ''; if(empty($table)){return false;}        
        $where = !empty($data['where']) ? " where ".$data['where'] : ''; if(empty($where)){return false;}
        $fileds='';
        if(!empty($data['data'])){
            foreach($data['data'] as $filed=>$value){
                $fileds .= $filed."='$value',";
            }
        }
        if(empty($fileds)){return false;}
        $sql = "update $table set ".rtrim($fileds,',')." $where ";
        $result = mysqli_query($this->con, $sql) or $this->logError($sql."\n". __FILE__." on line ".__LINE__);
        if($result && mysqli_affected_rows($this->con) > 0) { return true;}
    }
    public function get_record($data) { 
        $table = !empty($data['table']) ? $data['table'] : ''; if(empty($table)){return false;}        
        $where = !empty($data['where']) ? " where ".$data['where'] : '';
        $fields = !empty($data['fields']) ? implode(',',$data['fields']) : '*';
        $order = !empty($data['order']) ? " order by ".$data['order'] : '';
        $limit = "limit 0,1";        
        $sql = "select SQL_CALC_FOUND_ROWS $fields from $table $where $order $limit";//error_log($sql);
        $result = mysqli_query($this->con, $sql) or $this->logError($sql."\n". __FILE__." on line ".__LINE__);
        if($result && mysqli_num_rows($result) > 0) { return mysqli_fetch_assoc($result);}
    }
    public function get_records($data) { 
        $table = !empty($data['table']) ? $data['table'] : ''; if(empty($table)){return false;}
        $where = !empty($data['where']) ? " where ".$data['where'] : '';
        $fields = !empty($data['fields']) ? implode(',',$data['fields']) : '*';
        $group = !empty($data['group']) ? " group by ".$data['group'] : '';
        $order = !empty($data['order']) ? " order by ".$data['order'] : '';
        $limit = !empty($data['limit']) ? " limit ".(isset($data['start']) ? $data['start']."," : "").$data['limit'] : '';
        $sql = "select SQL_CALC_FOUND_ROWS $fields from $table $where $group $order $limit";error_log($sql);
        // echo 'sql '.$sql;die;
        $result = mysqli_query($this->con, $sql) or $this->logError($sql."\n". __FILE__." on line ".__LINE__);
        if($result && mysqli_num_rows($result) > 0) { return mysqli_fetch_all($result,MYSQLI_ASSOC);}
    }
    public function delete_record($data) {
        $table = !empty($data['table']) ? $data['table'] : ''; if(empty($table)){return false;}
        $where = !empty($data['where']) ? " where ".$data['where'] : ''; if(empty($where)){return false;}
        $sql = "delete from $table $where ";
        $result = mysqli_query($this->con, $sql) or $this->logError($sql."\n". __FILE__." on line ".__LINE__);
        if($result && mysqli_affected_rows($this->con) > 0) {return true;}
    }
    private function sql($sql) {
        return str_replace("#__",TABLE_PREFIX,$sql);        
    }
}