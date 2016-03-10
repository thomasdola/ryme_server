<?php

namespace App\Console\Commands;

use App\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EventAdMainActivation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event-ads:main-activation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'daily check to see whether a particular event-ad start_date is due
                                -> start_date (is_active)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ads = collect(Event::where('is_active', '0')->get());
        if($ads->isEmpty()) return;
        $early_today = Carbon::today()->startOfDay();
        $ads->each(function(Event $ad) use($early_today){
            $ad_start_day = Carbon::parse($ad->start_date)->startOfDay();
            if($ad_start_day->eq($early_today)){
                $ad->update(['is_active' => true]);
            }
        });
    }
}
