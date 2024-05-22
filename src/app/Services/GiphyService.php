<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\ApiResponse;

/**
 * Class GiphyService.
 */
class GiphyService
{
    use ApiResponse;
    public function __construct(){
        $this->apiKey = config('services.giphy.api_key');
        $this->apiUrl = config('services.giphy.api_url');
    }

    public function searchGifs($query, $limit, $offset)
    {
        $queryParams = [
            'api_key' => $this->apiKey,
            'q' => $query,
            'limit' => $limit,
            'offset' => $offset
        ];

        $queries = http_build_query($queryParams);
        $response = Http::get($this->apiUrl.'/search?'. $queries);

        if ($response->successful()) {
            $data = $response->json();

            $filteredData = array_map(function ($item) {
                return [
                    'id' => $item['id'],
                    'url' => $item['url'],
                    'gif_url' => $item['images']['original']['url'],
                    'size' => $item['images']['original']['size'],
                    'slug' => $item['slug'],
                    'title' => $item['title'],
                    'height' => $item['images']['original']['height'],
                    'width' => $item['images']['original']['width'],
                ];
            }, $data['data']);

            return response()->json($filteredData, 200);
        } else {
            return $this->invalid('Request error');
        }
    }

    public function searchGifById($id)
    {
        $queryParams = [
            'api_key' => $this->apiKey,
        ];

        $queries = http_build_query($queryParams);

        $response = Http::get($this->apiUrl . '/' . $id . '?' . $queries);

        if ($response->successful()) {
            $data = $response->json();

            $gifData = [
                'id' => $data['data']['id'],
                'url' => $data['data']['url'],
                'gif_url' => $data['data']['images']['original']['url'],
                'size' => $data['data']['images']['original']['size'],
                'slug' => $data['data']['slug'],
                'title' => $data['data']['title'],
                'height' => $data['data']['images']['original']['height'],
                'width' => $data['data']['images']['original']['width'],
            ];

            return response()->json($gifData, 200);
        } else {
            return $this->invalid('Request error');
        }
    }


}
