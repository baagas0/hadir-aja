<?php

namespace App\Console\Commands;

use App\Models\PresenceDaily;
use App\Models\SchoolUser;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateDailyPresenceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily-presence:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $school_user = SchoolUser::all();
        
        // $service = Service::whereCode('PRS-FCN')->first();
        // if(!$service) {
        //     $this->info('Layanan tidak ditemukan');
        //     return;
        // }

        foreach ($school_user as $key => $user) {

            $group = $user->school_group;
            $daily_presence_service = $group->daily_presence_service;
            if(!$daily_presence_service) continue;

            $school_shift = $group->school_shift;
            $school_shift_hours_collection = $school_shift->school_shift_hours;

            $carbon = Carbon::now()->locale('id');
            $carbon->settings(['formatFunction' => 'translatedFormat']);
            $day = $carbon->format('l');
            
            $shift_hour = $school_shift_hours_collection->where('day', $day)->first();
            $carbon_hour_in = Carbon::createFromTimeString($shift_hour->hour_in);
            $carbon_hour_out = Carbon::createFromTimeString($shift_hour->hour_out);
            $duration = $carbon_hour_out->diffInMinutes($carbon_hour_in);
            
            // ENTERING CREATE PRESENCE DATA
            $default = [
                'school_id'             => $user->school_id,
                'school_user_id'        => $user->id,
                'presence_location_id'  => $user->is_all_location_presence ? null : $user->school_location_id,
                'service_id'            => $daily_presence_service->id,
                'school_shift_id'       => $group->school_shift_id,
                'school_shift_hour_id'  => $shift_hour->id,
                'day'                   => $shift_hour->day,
                'actual_hour_in'        => $shift_hour->hour_in,
                'actual_hour_out'       => $shift_hour->hour_out,
                'actual_duration'       => $duration,
                'presence_date'         => Carbon::now(),
                'presence_day'          => $day,
            ];
            
            PresenceDaily::create($default);
            $this->info("School User $user->id has been created");
        }
    }
}
