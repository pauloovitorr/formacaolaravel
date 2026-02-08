<?php

namespace App\Listeners;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated implements ShouldQueue
{
    public function handle(EventsSeriesCreated $event): void
    {
        

        $listUsers = User::all();

        foreach ($listUsers as $index => $user) {
            $email = new SeriesCreated(
                $event->titulo,
                $event->id,
                $event->seasonsQty,
                $event->episodesPerSeason
            );

            $when = Carbon::now()->addSeconds($index * 30);
            Mail::to($user->email)->later($when, $email);
        }
    }
}
