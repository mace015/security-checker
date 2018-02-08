<?php

namespace App\Commands;

use App\Scans\Https;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Scan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan {domain : The domain that should be scanned.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scans a domain for security issues.';

    /**
     * All the scans that must be performed.
     *
     * @var array
     */
    protected $scans = [
        'HTTPS only' => Https::class
    ];

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
    public function handle(): void
    {
        $this->line('Starting scan');

        $bar = $this->output->createProgressBar(count($this->scans));

        $results = [];

        foreach ($this->scans as $name => $scan) {
            $instance       = new $scan;
            $results[$name] = $instance->perform($this, $this->domain());

            $bar->advance();
        }

        $bar->finish();

        $this->line('');

        $this->renderResults($results);

        $this->line('Scan completed');

        return;
    }

    /**
     * Returns the domain.
     *
     * @return string
     */
    public function domain()
    {
        return $this->argument('domain');
    }

    /**
     * Renders the scan results
     *
     * @param array $results
     * @return void
     */
    public function renderResults($results)
    {
        $headers = ['Scan', 'Status', 'Message'];

        foreach ($results as $key => $result) {
            $results[$key] = [
                'name'    => $key,
                'status'  => ($result[0])? "<bg=green;>Success</>": "<bg=red;>Error</>",
                'message' => $result[1]
            ];
        }

        $this->info('Scan results:');
        $this->table($headers, $results);
    }
}
