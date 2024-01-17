<?php

namespace App\Listeners;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventsSeriesCreated $event): void
    {
        //pegando todos os usuarios
        $userList = User::all();

        //para cada usuario criando um email e enviando
        foreach ($userList as $index =>$user){
            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seriesSeasonsQty,
                $event->episodesPerSeason,
            );
            // Mail::to($user)->send($email);

            //agendando um email
            $when = now()->addSeconds($index * 5);
            Mail::to($user)->later($when, $email);
            // Mail::to($user)->queue($email);
            //sleep(2);
        }
    }
}
