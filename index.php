<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
</style>

<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);
define('DATABASE', 'as3379');
define('USERNAME', 'as3379');
define('PASSWORD', 'aiYzUifB');
define('CONNECTION', 'sql1.njit.edu');
class dbConn{
    //variable to hold connection object.
    protected static $db;
    //private construct - class cannot be instatiated externally.
    private function __construct() {
        try {
            // assign PDO object to db variable
            self::$db = new PDO( 'mysql:host=' . CONNECTION .';dbname=' . DATABASE, USERNAME, PASSWORD );
            self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch (PDOException $e) {
            //Output error - would normally log this to error file rather than output to user.
            echo "Connection Error: " . $e->getMessage();
        }
    }
    // get connection function. Static method - accessible without instantiation
    public static function getConnection() {
        //Guarantees single instance, if no connection object exists then create one.
        if (!self::$db) {
            //new connection object.
            new dbConn();
        }
        //return connection.
        return self::$db;
    }
}
class collection {
    static public function create() {
        $model = new static::$modelName;
        return $model;
    }
    static public function findAll() {
        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordsSet =  $statement->fetchAll();
        return $recordsSet;
    }
    static public function findOne($id) {
        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id =' . $id;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordsSet =  $statement->fetchAll();
        return $recordsSet;
    }
}
class accounts extends collection {
    protected static $modelName = 'accounts';
}
class todos extends collection {
    protected static $modelName = 'todos';
}
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
class account extends model {

    public $email = 'email';
    public $fname = 'fname';
    public $lname = 'lname';
    public $phone = 'phone';
    public $birthday = 'birthday';
    public $gender = 'gender';
    public $password = 'password';

    static $insertRow = array ('as3379@njit.edu','Ashi','Gowda','8628728339', '2017-04-13', 'female', 'aaa13');


    static $tableName = 'accounts';
    static $id = '28';

    static $column ='lname';
    static $update ='Diwakar';


}
class todo extends model {

    public $owneremail = 'owneremail';
    public $ownerid = 'ownerid';
    public $createddate = 'createddate';
    public $duedate = 'duedate';
    public $message = 'message';
    public $isdone = 'isdone';

    static $insertRow = array ('as3379@njit.edu','8','2017-11-19','2017-11-22', 'Hello', '0');


        static $tableName = 'todos';
        static $id = '1';

        static $column ='message';
        static $update ='Updated message';

}

class stringFunction
{
   static function displayString($string)
    {
        echo '<h1>'.$string.'</h1>';
    }
}

class table
{
    static function makeTable($result)
    {
        echo '<table>';
        foreach ($result as $row)
        {
            echo '<tr>';

            foreach ($row as $column)
            {
                echo '<td>';
                echo $column;
                echo '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
}

stringFunction::displayString('Select All Records from Accounts');
$obj = accounts::create();
$result = $obj->findAll();
table::makeTable($result);

echo '<br>';
echo '<br>';

stringFunction::displayString('Select One Record from Accounts');
$obj = accounts::create();
$result = $obj->findOne(8);
table::makeTable($result);

echo '<br>';
echo '<br>';

stringFunction::displayString('Select All Records from Todos');
$obj = todos::create();
$result = $obj->findAll();
table::makeTable($result);

echo '<br>';
echo '<br>';

stringFunction::displayString('Select One Record from Todos');
$obj = todos::create();
$result = $obj->findOne(7);
table::makeTable($result);
echo '<br>';
echo '<br>';

//stringFunction::displayString('Delete Record from Todos');
//$obj = new todo;
//$obj->delete();
//echo '<br>';
//echo '<br>';

stringFunction::displayString('Update into Todo database');
$obj = new Todo;
$obj -> save();
$obj = todos::create();
$result = $obj->findAll();
table::makeTable($result);
echo '<br>';
echo '<br>';

stringFunction::displayString('Insert into accounts database');
$obj = new account;
$obj -> save();
$obj = accounts::create();
$result = $obj->findAll();
table::makeTable($result);






