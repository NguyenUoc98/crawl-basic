<?php
/**
 * Created by PhpStorm.
 * Filename: VnExpressObservers.php
 * User: Nguyễn Văn Ước
 * Date: 17/08/2022
 * Time: 16:22
 */

namespace App\Crawler\CrawlObservers;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class VnExpressObservers extends \Spatie\Crawler\CrawlObservers\CrawlObserver
{

    /**
     * @inheritDoc
     */
    public function crawled(UriInterface $url, ResponseInterface $response, ?UriInterface $foundOnUrl = null): void
    {
        // TODO: Implement crawled() method.
    }

    /**
     * @inheritDoc
     */
    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null
    ): void {
        // TODO: Implement crawlFailed() method.
    }
}
