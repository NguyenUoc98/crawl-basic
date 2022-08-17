<?php

namespace App\Console\Commands;

use App\Crawler\CrawlObservers\VnExpressObservers;
use App\Crawler\CrawlProfiles\CrawlPost;
use App\Models\Site;
use App\Queues\DbQueues;
use Illuminate\Console\Command;
use Spatie\Crawler\Crawler;
use Spatie\Crawler\CrawlQueues\ArrayCrawlQueue;

class CrawlSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:run {site}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepares and runs the crawler';

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
        $queue = null;
        $site = Site::query()
            ->whereName($this->argument('site'))
            ->first();

        if ($site) {
            if (is_null($queue)) {
                $this->info('Preparing a new crawler queue');
                $queue = new DbQueues(86400);
            }

            // Crawler
            $this->info('Start crawling');

            Crawler::create()
                ->addCrawlObserver(new VnExpressObservers())
                ->setCrawlQueue($queue)
                ->setCrawlProfile(new CrawlPost($site))
                ->startCrawling($site);

            $this->info('Finished crawling');

            $this->info($queue->hasPendingUrls() ? 'Has URLs left' : 'Has no URLs left');
        } else {
            $this->error('Not found site ' . $this->argument('site') . 'in DB');
        }

        return 0;
    }
}
