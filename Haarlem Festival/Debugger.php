<?php

class Debugger
{

    //to use debugger:
    //Debugger::LogVarToFile($var);
    //open Debugger.txt to see var contents
    //only works if file is downloaded from server upon opening

    static function EchoVar($var)
    {
        echo ($var);
    }

    static function LogVarToFile($var)
    {
        $file = 'Debugger.txt';

        //get timestamp
        // something like: Monday 8th of August 2005 03:12:46 PM
        $date = date('l jS \of F Y h:i:s A');

        //open the file to get existing content
        $current = file_get_contents($file);

        // Append a new person to the file
        $current .= "\n" . $date . "\n" . (string)$var . "\n";

        // Write the contents back to the file
        file_put_contents($file, $current);
    }

    static function LogArrayToFile($array)
    {
        $file = 'Debugger.txt';

        //get timestamp
        // something like: Monday 8th of August 2005 03:12:46 PM
        $date = date('l jS \of F Y h:i:s A');

        //convert array to string
        $string = print_r($array, true);

        //open the file to get existing contentt
        $current = file_get_contents($file);

        // Append a new person to the file
        $current .= "\n" . $date . "\n" . $string . "\n";

        // Write the contents back to the file
        file_put_contents($file, $current);
    }

    static function Obj($obj)
    {
        $file = "Debugger.txt";
        $date = date("l jS \of F Y h:i:s A");

        $output = var_dump($obj);

        $current = file_get_contents($file);
        $current .= "\n" . $date . "\n" . $output . "\n";

        file_put_contents($file, $output);
    }
}


?>