<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class instagramPull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulls the top images from Instagram';

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
        $this->info('Welcome to instagram posts command!');
    }
}
