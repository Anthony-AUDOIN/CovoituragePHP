<?php
function getEnglishDate($date): string
{
    $membres = explode('/', $date);
    $date = $membres[2] . '-' . $membres[1] . '-' . $membres[0];
    return $date;
}

function addJours($date, $nbJours): string
{
    $membres = explode('/', $date);
    $date = $membres[2] . '-' . $membres[1] . '-' . (intval($membres[0]) + $nbJours);
    return $date;
}
