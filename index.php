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

include 'model.php';
include 'collection.php';
include 'account.php';
include 'accounts.php';

include 'dbconn.php';

include 'stringFunction.php';
include 'table.php';
include 'todo.php';
include 'todos.php';
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






