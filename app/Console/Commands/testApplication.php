<?php

namespace App\Console\Commands;

use App\Services\OrderService;
use App\Services\TermiiService;
use Illuminate\Console\Command;

class testApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:app';

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
        // return dd((new OrderService)->otpGenerator(2,5,9,3));
        return dd((new TermiiService)->balance());
    }
}
