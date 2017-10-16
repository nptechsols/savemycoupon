<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\User;
use Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {

            $user = User::find(3);
            
            Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
                $m->from('reminder@savemycoupon.com', 'Save My Coupon');

                $m->to($user->email, $user->name)->subject('Following coupons are expiring this week.');
            });

        })->everyMinute();
    }
}
