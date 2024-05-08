<?php

function convertTime($dateString)
{
    $dateTimestamp = strtotime($dateString);
    $formattedDate = date("j F Y", $dateTimestamp);
    return $formattedDate;
}
