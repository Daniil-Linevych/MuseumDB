<?php

namespace core;

class DataBase
{
    protected $servername = "localhost";
    protected $dbname = "museum";
    protected $username = "root";
    protected $password = "";

    public static $access = 0;

    public function connect(){

        try {
            $dsn = "mysql: host={$this->servername};dbname={$this->dbname};charset=utf8mb4";
            $db = new \PDO($dsn, $this->username, $this->password);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (\PDOException $e){
            echo "Connection failed".$e->getMessage();
            return null;
        }


    }

    public function SELECT($tName, $choices = "*", $conditions = null,  $orderConditions=null, $isDesc = false, $joinTable = null, $joinConditions = null){
        if(is_string($choices)){
            $choices_str = $choices;
        }
        if (is_array($choices)){
            $choices_str = implode(",",$choices);
        }
        $condition = "";
        $values = [];
        if (is_array($conditions)){
            $elems = [];
            foreach ($conditions as $key => $value){
                $elems[]="{$key}=?";
                $values[] = $value;
            }
            $condition = "WHERE ".implode(' AND ', $elems);

        }
        $orderCondition = "";
        if (is_array($orderConditions)){
            $elems = [];
            foreach ($orderConditions as $oCondition){
                if ($isDesc){
                    $elems[] = $oCondition." DESC";
                }
                else{
                    $elems[] = $oCondition." ASC";
                }
            }
            $orderCondition = "ORDER BY ".implode(', ', $elems);
        }
        $joinCondition = "";
        if (!empty($joinTable) && is_array($joinConditions)){
            $joinCondition = "INNER JOIN ".$joinTable." ON ".$tName.".".$joinConditions["FirstTable"]." = ".$joinTable.".".$joinConditions["SecondTable"];
        }
        //var_dump("SELECT {$choices} FROM {$tName} {$joinCondition} {$condition} {$orderCondition}");
        $stmt = $this->connect()->prepare("SELECT {$choices} FROM {$tName} {$joinCondition} {$condition} {$orderCondition}");
        $stmt->execute($values);
        return $rows = $stmt->fetchALL(\PDO::FETCH_ASSOC);

    }

    public function UPDATE($tName, $setElems, $conditions){
        $values = [];
        $setElemsString = "";
        if (is_array($setElems)){
            $makeSet = [];
            foreach ($setElems as $key => $value){
                $makeSet [] = "{$key}=?";
                $values[] = $value;
            }
            $setElemsString = implode(',',$makeSet);

        }
        $condition = "";
        if (is_array($conditions)){
            $elems = [];
            foreach ($conditions as $key => $value){
                $elems[]="{$key}=?";
                $values [] = $value;
            }
            $condition = "WHERE ".implode(' AND ', $elems);

        }
        $stmt = $this->connect()->prepare("UPDATE {$tName} SET {$setElemsString} {$condition}");
        return $stmt->execute($values);
    }

    public function INSERT($tName, $insertRow){
        $tableColumns = array_keys($insertRow);
        $tableColumnNames = implode(",",$tableColumns);
        $values = [];
        $setValuesArray = [];
        foreach ($insertRow as $key=>$value){
            $setValuesArray[] = "?";
            $values[] = $value;
        }
        $setValues = implode(", ", $setValuesArray);
        $stmt = $this->connect()->prepare("INSERT INTO {$tName}({$tableColumnNames}) VALUES({$setValues})");
        $stmt->execute($values);
        $this::$access += 1;

    }

    public function DELETE($tName, $conditions = null){
        $values = [];
        $condition = "";
        if (is_array($conditions)){
            $elems = [];
            foreach ($conditions as $key => $value){
                $elems[]="{$key}=?";
                $values [] = $value;
            }
            $condition = "WHERE ".implode(' AND ', $elems);

        }
        $stmt = $this->connect()->prepare("DELETE FROM {$tName} {$condition}");
        return $stmt->execute($values);
    }

    public function getUser($login, $pass = null){
        $query = "SELECT * FROM user WHERE Login=?";
        $conditions = [$login];
        if(!empty($pass)){
            $query = "SELECT * FROM user WHERE Login=? AND Password=?";
            $conditions[] = $pass;
        }
        $stmt = $this->connect()->prepare($query);
        $stmt->execute($conditions);
        if (empty($stmt->fetch(\PDO::FETCH_ASSOC)))
            return true;
        else
            return false;
    }

}