<?php
use \Carbon\Carbon;

class vStack 
{
    public static function getDay($date = null)
    {
        $date = Carbon::create($date ? $date : date("Y-m-d H:i:s"));
        $days_of_week = [
            "Domingo",
            "Segunda-Feira",
            "Terça-Feira",
            "Quarta-Feira",
            "Quinta-Feira",
            "Sexta-Feira",
            "Sábado"
        ];
        return (object)[
            "date"     => $date,
            "full_formated" => $date->format("d/m/Y - H:i:s"),
            "formated" => $date->format("d/m/Y"),
            "week" => $days_of_week[$date->dayOfWeek],
        ];
    }
}