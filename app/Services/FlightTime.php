<?php
namespace App\Services;

use Carbon\Carbon;

class FlightTime {
    public function flightTime($departureFlight, $returnFlight = null)
    {
        // Xử lý thời gian bay chuyến bay
        $departureTime = Carbon::parse($departureFlight->departure_time);
        $flightStart = Carbon::parse($departureFlight->flight_start);
        $flightEnd = Carbon::parse($departureFlight->flight_end);

        $duration = $flightStart->diff($flightEnd)->format('%h giờ %i phút');
        $flightStartTime = $flightStart->format('H:i');
        $flightEndTime = $flightEnd->format('H:i');
        $departureDate = $departureTime->format('d/m/Y');
        $departureMonth = $departureTime->format('m');
        $departureYear = $departureTime->format('Y');
        $departureDay = $departureTime->format('d');
        $departureDayOfWeek = $departureTime->locale('vi')->isoFormat('dddd');

        $data = [
            'departureTime' => $departureTime,
            'flightStart' => $flightStart,
            'flightEnd' => $flightEnd,
            'duration' => $duration,
            'flightStartTime' => $flightStartTime,
            'flightEndTime' => $flightEndTime,
            'departureDate' => $departureDate,
            'departureMonth' => $departureMonth,
            'departureYear' => $departureYear,
            'departureDay' => $departureDay,
            'departureDayOfWeek' => $departureDayOfWeek,
        ];

        // Xử lý thời gian bay chuyến về (khứ hồi)
        if ($returnFlight) {
            $returnTime = Carbon::parse($returnFlight->departure_time);
            $returnStart = Carbon::parse($returnFlight->flight_start);
            $returnEnd = Carbon::parse($returnFlight->flight_end);

            $returnDuration = $returnStart->diff($returnEnd)->format('%h giờ %i phút');
            $returnStartTime = $returnStart->format('H:i');
            $returnEndTime = $returnEnd->format('H:i');
            $returnDate = $returnTime->format('d/m/Y');
            $returnMonth = $returnTime->format('m');
            $returnYear = $returnTime->format('Y');
            $returnDay = $returnTime->format('d');
            $returnDayOfWeek = $returnTime->locale('vi')->isoFormat('dddd');

            $data = array_merge($data, [
                'returnTime' => $returnTime,
                'returnStart' => $returnStart,
                'returnEnd' => $returnEnd,
                'returnDuration' => $returnDuration,
                'returnStartTime' => $returnStartTime,
                'returnEndTime' => $returnEndTime,
                'returnDate' => $returnDate,
                'returnMonth' => $returnMonth,
                'returnYear' => $returnYear,
                'returnDay' => $returnDay,
                'returnDayOfWeek' => $returnDayOfWeek,
            ]);
        }

        return $data;
    }
}