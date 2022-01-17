<?php

namespace App\Console\Commands;

use Mail;
use Carbon\Carbon;
use App\Models\Judicial;
use App\Mail\CourtReminder;
use Illuminate\Console\Command;
use Log;
use App\Services\Sms;

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

            if($item->email_address){
                Mail::to($item->email_address)->send(new CourtReminder($item));
                Log::channel('cron')->info('Reminder: EMAIL sent to ' . $item->email_address);
            }

            // if($item->phone){
            //     $sms = new Sms;
            //     $sms->send($item->phone, 'You have a schedule for a court date today.');
            //     Log::channel('cron')->info('Reminder: SMS sent to ' . $item->phone);
            // }
        }


        return $data->count();
    }
}
