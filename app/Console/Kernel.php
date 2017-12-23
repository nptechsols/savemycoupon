<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\User;
use Mail;
use Carbon\Carbon;

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

            $users = User::all();

            foreach ($users as $user) {

                $user_coupons = $user->coupons()->whereDate('expiry_date','=',Carbon::tomorrow()->toDateString())->get();
                
                $expired_coupons = $user->coupons()->whereDate('expiry_date','=',Carbon::yesterday()->toDateString())->get();

                if (count($user_coupons)>0) {
                    Mail::send('emails.reminder', ['user' => $user,'user_coupons' => $user_coupons], function ($m) use ($user) {
                        $m->from('nptechsols@gmail.com', 'Save My Coupon');

                        $m->to($user->email, $user->name)->subject('Following coupons are expiring tomorrow.');
                    });
                }

                if (count($expired_coupons)>0) {
                    foreach ($expired_coupons as $expired_coupon){
                        $expired_coupon->delete();
                    }
                }

            }
            
        })->daily();

    }
}
