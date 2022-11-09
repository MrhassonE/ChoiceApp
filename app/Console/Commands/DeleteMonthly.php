<?php

namespace App\Console\Commands;

use App\Models\GeneralSetting;
use App\Models\MonthlyVisit;
use Illuminate\Console\Command;

class DeleteMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visit:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        MonthlyVisit::truncate();
    }
}
