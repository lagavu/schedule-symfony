<?php

namespace App\RemoteService;

class GoogleCalendar
{
    private const GOOGLE_CALENDAR_API = 'https://www.googleapis.com/calendar/v3/calendars/russian__ru%40holiday.calendar.google.com/events?key=AIzaSyC8khrJO57yl4szjLOuyQrlW7R_CKgwaH0';

    public static function googleCalendarApi(): array
    {
        return json_decode(file_get_contents(self::GOOGLE_CALENDAR_API), true);
    }

    public static function countHolidaysRussia(): int
    {
        $countHolidaysRussia = GoogleCalendar::googleCalendarApi();
        return count($countHolidaysRussia['items']);
    }

    public static function datesHolidaysRussia(): array
    {
        $itemsGoogleCalendarApi = GoogleCalendar::googleCalendarApi();
        $countHolidaysRussia = GoogleCalendar::countHolidaysRussia();
        $datesHolidaysRussia = [];

        for ($i=0; $i < $countHolidaysRussia; $i++)
        {
            $datesHolidaysRussia[] = $itemsGoogleCalendarApi['items'][$i]['start']['date'];
        };
        return $datesHolidaysRussia;
    }

    public static function nameHolidaysRussia(): array
    {
        $itemsGoogleCalendarApi = GoogleCalendar::googleCalendarApi();
        $countHolidaysRussia = GoogleCalendar::countHolidaysRussia();
        $nameHolidaysRussia = [];

        for ($i=0; $i < $countHolidaysRussia; $i++)
        {
            $nameHolidaysRussia[] = $itemsGoogleCalendarApi['items'][$i]['summary'];
        };
        return $nameHolidaysRussia;
    }

    public function holidaysRussiaDateAndName(): array
    {
        $countHolidaysRussia = GoogleCalendar::countHolidaysRussia();
        $datesHolidaysRussia = GoogleCalendar::datesHolidaysRussia();
        $nameHolidaysRussia = GoogleCalendar::nameHolidaysRussia();
        $holidaysRussiaDateAndName = [];

        for ($i = 0; $i < $countHolidaysRussia; $i++)
        {
            $holiday[] = [
                "date" => $datesHolidaysRussia[$i],
                "name_holiday" => $nameHolidaysRussia[$i]
            ];
        }
        return $holidaysRussiaDateAndName;
    }

    public function currentYearHolidaysRussia(): array
    {
        $datesHolidaysRussia = GoogleCalendar::datesHolidaysRussia();
        $currentYearHolidaysRussia = array_filter($datesHolidaysRussia, function ($var) {
            return substr($var, 0, 4) === date("Y");
        });
        return $currentYearHolidaysRussia;
    }
}