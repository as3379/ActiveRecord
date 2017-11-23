<?php

include 'todo.php';

final class account extends fusion\model implements modelInterface {

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
?>