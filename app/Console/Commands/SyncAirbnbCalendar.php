<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;
use ICal\ICal;
use Carbon\Carbon;


class SyncAirbnbCalendar extends Command
{
    protected $signature = 'sync:airbnb';
    protected $description = 'Sincroniza las reservas desde el calendario iCal de Airbnb';

    public function handle()
    {
        $url = 'https://www.airbnb.com.pe/calendar/ical/1198805039233565709.ics?s=7b8958563eeeff99efed42eb5e1eaf06';

        try {
            $ical = new ICal($url, [
                'defaultTimeZone' => 'America/Lima',
                'filterDaysBefore' => 0,
                'skipRecurrence' => false,
            ]);

            $events = $ical->events();

            foreach ($events as $event) {
                $start = Carbon::parse($event->dtstart);
                $end = Carbon::parse($event->dtend);

                // Si ya existe, lo actualizamos, sino lo creamos
                Reservation::updateOrCreate(
                    ['external_id' => md5($event->uid)], // identificador único
                    [
                        'fuente' => 'airbnb',
                        'titulo' => $event->summary ?? 'Reserva Airbnb',
                        'fecha_inicio' => $start,
                        'fecha_fin' => $end,
                    ]
                );
            }

            $this->info('✅ Reservas de Airbnb sincronizadas correctamente.');

        } catch (\Exception $e) {
            $this->error('❌ Error al sincronizar Airbnb: ' . $e->getMessage());
        }
    }
}
