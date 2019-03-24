<?php
    function mysqli_multiquery_prepare($query)
    {
        //checks for illegal signs
        if(strpos($query, '--') !== false && strpos($query, "'--") !== false) 
        {
            return false;
        }
        else
        {
            return $query;
        }
    }
?>