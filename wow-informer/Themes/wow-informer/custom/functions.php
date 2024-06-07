<?php



/**

 *

 * @convert seconds to hours minutes and seconds

 *

 * @param int $seconds The number of seconds

 *

 * @return string

 *

 */

function secondsToWords($seconds)

{

    /*** return value ***/

    $ret = "(";



    /** get the days ***/

    $days = intval(intval($seconds) / 86400);

    if($days > 0)

    {

        $ret .= ($days==1 ? $days." day ago)" : $days." days ago)");

        return $ret;

    }

    

    else {

    /*** get the hours ***/

    $hours = bcmod((intval($seconds) / 3600),24);

    if($hours > 0)

    {

        //$ret .= $hours."hours ";

        $ret .= ($hours==1 ? $hours." hour " : $hours." hours ");

    }

    /*** get the minutes ***/

    $minutes = bcmod((intval($seconds) / 60),60);

    if($hours > 0 || $minutes > 0)

    {

        $ret .= $minutes." minutes";

    }

    $ret .= " ago)";

    return $ret;

    }

}

?>