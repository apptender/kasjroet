<?php
declare(strict_types=1);

namespace App\Nik;

use App\Brand;
use App\Category;
use App\Product;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Spatie\Crawler\CrawlObserver;

final class NikCrawlerObserver extends CrawlObserver
{
    /**
     * Called when the crawler has crawled the given url successfully.
     *
     * @param UriInterface $url
     * @param ResponseInterface $response
     * @param UriInterface|null $foundOnUrl
     */
    public function crawled(UriInterface $url, ResponseInterface $response, ?UriInterface $foundOnUrl = null)
    {
        $result = (string)$response->getBody();

        $pattern = '/<tbody>(.*?)<\/tbody>/s';
        $cleanedResult = preg_replace("/\s+/", " ", $result);
        preg_match_all($pattern, trim($cleanedResult), $lines);
        $alltTrs = $lines[1][0];
        $pattern = '/<tr class=".*?">(.*?)<\/tr>/si';
        preg_match_all($pattern, $alltTrs, $trs);
        foreach ($trs[1] as $tr) {
            $pattern = '/<td class=".*?">(.*?)<\/td>/si';
            preg_match_all($pattern, trim($tr), $row);
            $this->saveProduct($row[1]);
        }
        dd('done');
    }

    /**
     * @param array $data
     */
    private function saveProduct(array $data)
    {
        $brand = Brand::firstOrCreate(['brandname' => trim(ucfirst($data[0]))]);
        $category = Category::firstOrCreate(['name' => trim(ucfirst($data[1]))]);
        try {
            $product = Product::where([
                ['productname', '=', $data[3]],
                ['brand_id', '=', $brand->id]
            ])->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $product = new Product();
            $product->brand_id = $brand->id;
            $product->productName = ucfirst(trim($data[3]));
            $product->informationsource = "NIK Website";
            $product->kosher = trim(strtoupper($data[2])) === 'NK' ? 0 : 1;
            var_dump(strtoupper($data[3]));
            $product->koshertype = trim($data[2]);
            $product->eancode = trim($data['4']) === 'onbekend' ? null : trim($data[4]);
            $product->save();
//          dd($product);

            $product->categories()->attach($category);




    }


    }

    /**
     * Called when the crawler had a problem crawling the given url.
     *
     * @param UriInterface $url
     * @param RequestException $requestException
     * @param UriInterface|null $foundOnUrl
     */
    public function crawlFailed(UriInterface $url, RequestException $requestException, ?UriInterface $foundOnUrl = null)
    {
        dd('exception');
        dd($url, $requestException);
    }
}
