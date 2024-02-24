<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating Sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Rozpoczynam generowanie sitemapy');
        $postSitemap = Sitemap::create();
        $postSitemap->add(
            Url::create("")
                ->setPriority(1)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        );

        $postSitemap->add(
            Url::create("/blog")
                ->setPriority(1)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
        );

        Blog::where('activated', true)->where('language', env('LANGUAGE'))->get()->each(function (Blog $blog) use ($postSitemap) {
            $postSitemap->add(
              Url::create("/article/{$blog->slug}")
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        $postSitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('Generowanie zakończone...');
    }
}
