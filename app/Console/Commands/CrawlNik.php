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

    /** @var array */
    protected $urls = [
        'https://www.nik.nl/2018/08/alcoholhoudende-dranken/',
        'https://www.nik.nl/2018/08/baby-en-kleutervoeding/',
        'https://www.nik.nl/2018/08/bakproducten/',
        'https://www.nik.nl/2018/08/bindmiddelen/',
        'https://www.nik.nl/2018/08/brood-en-graanprodukten/',
        'https://www.nik.nl/2018/08/broodbeleg/',
        'https://www.nik.nl/2018/08/chips-en-noten/',
        'https://www.nik.nl/2018/08/chocolade-en-bonbons/',
        'https://www.nik.nl/2018/08/dessertproducten/',
        'https://www.nik.nl/2018/08/dieetartikelen/',
        'https://www.nik.nl/2018/08/dranken-niet-alcoholisch/',
        'https://www.nik.nl/2018/08/drop/',
        'https://www.nik.nl/2018/08/groenten/',
        'https://www.nik.nl/2018/08/ijs/',
        'https://www.nik.nl/2018/08/indische-producten/',
        'https://www.nik.nl/2018/08/koek-en-biscuit/',
        'https://www.nik.nl/2018/08/melk-en-zuivelproducten/',
        'https://www.nik.nl/2018/08/olie-en-olieproducten/',
        'https://www.nik.nl/2018/08/pasta-en-rijst/',
        'https://www.nik.nl/2018/08/sauzen/',
        'https://www.nik.nl/2018/08/snoep/',
        'https://www.nik.nl/2018/08/specerijen/',
        'https://www.nik.nl/2018/08/suiker-en-zoetstof/',
        'https://www.nik.nl/2018/08/tafelzuur-en-azijn/',
        'https://www.nik.nl/2018/08/vis-en-visconserven/',
        'https://www.nik.nl/2018/08/vlees-gevogelte-en-vleesvervangers/',
        'https://www.nik.nl/2018/08/vruchtenconserven/',
        'https://www.nik.nl/2018/08/aardappelproducten-2/',
        'https://www.nik.nl/2019/09/meer-exotische-producten-op-de-kasjroetlijst/',

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
        $crawler = Crawler::create()
            ->setCrawlObserver(new NikCrawlerObserver())
            ->setMaximumDepth(0);

        foreach ($this->urls as $url) {
            $this->info('Handling url: ' . $url);
            $crawler->startCrawling($url);
        }
    }
}
