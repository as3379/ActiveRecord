<?php
class todo extends fusion\model {

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
?>