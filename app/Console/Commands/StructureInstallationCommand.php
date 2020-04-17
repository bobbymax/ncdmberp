<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Classes\Periquisite;
use App\Grade;

class StructureInstallationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ncdmb:data:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the basic data for use';

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
        // 1. Migrate Database
        // 2. Add Grades, Locations, Roles, Vocabularies, Departments
        $this->info('Installing dependencies...');
        Periquisite::install('grades', 'Grade');
        $this->info('Grade details installed successfully...');
        Periquisite::install('locations', 'Location');
        $this->info('Location details installed successfully...');
        Periquisite::install('vocabularies', 'Vocabulary');
        $this->info('Vocabulary details installed successfully...');
        Periquisite::install('roles', 'Role');
        $this->info('Role details installed successfully...');
        Periquisite::install('departments', 'Department');
        $this->info('Department details installed successfully...');
        Periquisite::install('administrators', 'User');
        $this->info('Admin details installed successfully...');    
        // Done grades, 

        
        // 3. Add Staff Records
        // 4. Add Applications
        // 5. Add Modules
        // 6. Add Pages
        // 7. Add Training Categories, Category Type, Topic Areas
    }
}
