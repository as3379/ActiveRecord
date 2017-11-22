<?php
class model {
    // protected $tableName;
    static $columnString;
    static $valueString;

    public function save()
    {
        if (static::$id == '') {
            $array = get_object_vars($this);
            static::$columnString = implode(',', $array);
            static::$valueString = implode(',',  array_fill(0,count($array),'?'));
            $db = dbConn::getConnection();
            $sql = $this->insert();
            $statement = $db->prepare($sql);
            $statement->execute(static::$insertRow);
        }
        else
        {
            $db = dbConn::getConnection();
            $sql = $this->update();
            $statement = $db->prepare($sql);
            $statement->execute();
        }

        // echo "INSERT INTO $tableName (" . $columnString . ") VALUES (" . $valueString . ")</br>";
        //  echo 'I just saved record: ' . $this->id;
    }
    private function insert() {
        $sql = "INSERT INTO ".static::$tableName." (".self::$columnString.") VALUES (".static::$valueString.")";
        return $sql;
    }
    private function update() {
        $sql = "UPDATE ".static::$tableName." SET ".static::$column." = '".static::$update."' WHERE id=".static::$id;
        return $sql;
    }
    public function delete()
    {
        $db = dbConn::getConnection();
        $sql = 'delete from '.static::$id.' where id='.static::$id;
        $statement = $db->prepare($sql);
        $statement->execute();
        echo 'column with id '.static::$id.' has been deleted from todos table';
    }
}

?>