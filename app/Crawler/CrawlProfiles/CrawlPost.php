<?php
/**
 * Created by PhpStorm.
 * Filename: CrawlPost.php
 * User: Nguyễn Văn Ước
 * Date: 17/08/2022
 * Time: 14:54
 */

namespace App\Crawler\CrawlProfiles;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

class CrawlPost extends \Spatie\Crawler\CrawlProfiles\CrawlProfile
{
    protected $path;

    public function __construct($baseUrl)
    {
        $this->path = (new Uri($baseUrl))->getPath();
    }

    public function shouldCrawl(UriInterface $url): bool
    {
        $path = $url->getPath();
        return str_starts_with($path, $this->path);
    }
}
