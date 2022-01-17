<?php

namespace App\Console\Commands;

use Mail;
use Carbon\Carbon;
use App\Models\Judicial;
use App\Mail\CourtReminder;
use Illuminate\Console\Command;
use Log;

class ScheduleReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:court-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Court Date Reminders';

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
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $data = Judicial::incomplete()->where('court_date', $today)->orWhere('court_date', $tomorrow)->get();
        
        $this->info('There are ' . $data->count() . ' records found!');

        foreach($data as $item){
            Mail::to('vahnmarty@gmail.com')->send(new CourtReminder($item));

            $this->line('Email sent to ' . $item->parents);
        }


        return $data->count();
    }
}
