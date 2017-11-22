<?php
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
?>