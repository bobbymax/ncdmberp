<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\ComputeTraining;

class UpdateStaffStatus extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:staff:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets all scheduled trainings and changes the users status to training';

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
        $this->fire();
        $this->info("Done!!");
    }

    private function fire()
    {
        return (new ComputeTraining)->init();
    }
}
