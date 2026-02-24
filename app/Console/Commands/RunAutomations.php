<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\AutomationController;

class RunAutomations extends Command
{
    protected $signature = 'automation:run';
    protected $description = 'Run all automation tasks';

    public function handle()
    {
        $this->info('Running automations...');
        
        $controller = new AutomationController();
        $result = $controller->runAll();
        
        $this->info('Automations completed successfully!');
        $this->line(json_encode($result->getData(), JSON_PRETTY_PRINT));
        
        return 0;
    }
}
