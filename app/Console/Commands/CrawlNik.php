<?php

namespace App\Console\Commands;

use App\Nik\NikCrawlerObserver;
use Illuminate\Console\Command;
use Spatie\Crawler\Crawler;

class CrawlNik extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:nik';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cralws NIK Kosher site';

    /** @var array  */
    protected $urls = [
        'https://www.nik.nl/2018/08/alcoholhoudende-dranken/',
        'https://www.nik.nl/2018/08/baby-en-kleutervoeding/',
        'https://www.nik.nl/2018/08/bakproducten/',
        'https://www.nik.nl/2018/08/bindmiddelen/'
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
    public function handle()
    {
        $url = 'https://www.nik.nl/2018/08/alcoholhoudende-dranken/';
        Crawler::create()->setCrawlObserver(new NikCrawlerObserver())->startCrawling($url);

    }
}
