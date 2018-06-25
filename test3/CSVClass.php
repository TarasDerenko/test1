<?php
/**
 * Created by PhpStorm.
 * User: konor
 * Date: 6/25/18
 * Time: 10:36 PM
 */

class CSVClass
{

    public $uid;
    public $firstName;
    public $lastName;
    public $birthDay;
    public $dateChange;
    public $description;

    private $db;
    private $update = 0;
    private $insert = 0;
    private $delete = 0;

    public function __construct($obj = null)
    {
        global $db;
        $this->db = $db;
        if(is_object($obj) || is_array($obj)){
            foreach ($obj as $name => $value){
                if(property_exists(self::class,$name))
                    $this->$name = $value;
            }
        }
        if(is_string($obj)){
            list($this->firstName,$this->lastName,$this->birthDay,$this->dateChange,$this->description) = explode(';',$obj);
        }
    }

    public static function getCSV(){
        global $db;
        $res = $db->query("
            SELECT *
            FROM csv
        ");
        if($res){
            return array_map(function ($el){
                return new CSVClass($el);
            },$res->fetchAll());
        }
        return array();
    }

    public function insert(){
        $query = $this->db->prepare("
            INSERT INTO csv (firstName,lastName,birthDay,dateChange,description)
            VALUE (:fn,:ln,:bd,:dc,:ds)
        ");
       if(!$query->execute(array(
           ':fn' => $this->firstName,
           ':ln' => $this->lastName,
           ':bd' => $this->birthDay,
           ':dc' => $this->dateChange,
           ':ds' => $this->description,
       ))){
           return $this->db->errorInfo();
       }else{
           return true;
       }
    }

    public function update(){
        if(!$this->uid)
            return false;
        $query = $this->db->prepare("
            UPDATE csv 
            SET firstName = :fn,lastName = :ln,birthDay = :bd, dateChange = :dc,description = :ds)
            WHERE uid = :id
        ");
        if(!$query->execute(array(
            ':fn' => $this->firstName,
            ':ln' => $this->lastName,
            ':bd' => $this->birthDay,
            ':dc' => $this->dateChange,
            ':ds' => $this->description,
            ':id' => $this->uid,
        ))){
            return $this->db->errorInfo();
        }else{
            return true;
        }
    }

    public function delete(){
        if(!$this->uid)
            return false;
        $query = $this->db->prepare("
            DELETE FROM csv
            WHERE uid = :id
        ");
        if(!$query->execute(array(
            ':id' => $this->uid,
        ))){
            return $this->db->errorInfo();
        }else{
            return true;
        }
    }

    public function checked($arr){
        foreach ($arr as $csv){
            if($this->firstName != $csv->firstName)
                continue;
            if($this->dateChange != $csv->dateChange){
                $this->load($csv);
                $this->update();
            }
        }
    }

    public function load($obj){
        if(is_object($obj) || is_array($obj)){
            foreach ($obj as $name => $value){
                if(property_exists(self::class,$name))
                    $this->$name = $value;
            }
        }
        if(is_string($obj)){
            list($this->firstName,$this->lastName,$this->birthDay,$this->dateChange,$this->description) = explode(';',$obj);
        }
    }
 }