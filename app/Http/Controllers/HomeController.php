<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use HeadlessChromium\BrowserFactory;


use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $base_url = ('https://art.co');


        $response = $this->getData($base_url);

        // dd($response);
        $frontPageData = $response['props']['pageProps']['homeCounters'];

        return view('welcome', compact('frontPageData'));
    }

    public function search(Request $request)
    {
        // $client = new Client;
        // $response = $client->get('http://127.0.0.1:8001?url=' . $url);
        // $response = json_decode($response->getBody(), true);

        // Make Query Url for art.co
        $url = $this->queryMaker($request->input(), 'search');

        // Get api from artvisor Api
        $response = $this->getData($url);


        // Manipulate with response
        $data = ($response['props']['pageProps']['searchResponseAndEntity']['response']);
        $currentData = $response['props']['pageProps']['searchAndEntityParams'];
        $pagination = $data['cursors'];
        $items = $data['items'];
        $namespaces = $response['props']['namespaces']['common'];
        $typeData = $response['props']['pageProps']['typesCountsResponse']['aggregations']['_index'];
        $types = $response['props']['pageProps']['typesCountsQuery']['types'];


        return view('result', compact('pagination', 'namespaces', 'typeData', 'items', 'currentData'));
    }

    public function artist(Request $request, $slug)
    {
        $query = $request->input();
        $url = $this->queryMaker($query, 'artists/' . $slug);

        $response = $this->getData($url);

        $image = $response['props']['pageProps']['artists'][$slug]['media'][0]['url'];
        $artist = $response['props']['pageProps']['artistProfile'];
        $artworks = $response['props']['pageProps']['artworks']['items'];
        $pagination = $response['props']['pageProps']['artworks']['cursors'];
        // dd($pagination);
        // $size = $response['props']['pageProps']['entities'];
        $filters = $response['props']['pageProps']['artworksFilters'];

        $months = [
            'Jan', 'Feb', 'Mar', 'April', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        return view('artist', compact('artist', 'image', 'artworks', 'months', 'pagination', 'filters'));
    }

    public function artwork(Request $request, $artwork)
    {

        $query = $request->input();
        $url = $this->queryMaker($query, 'artworks/' . $artwork);
        $response = $this->getData($url);
        $artwork = $response['props']['pageProps']['artworks'][$artwork];
        $historical_data = $response['props']['pageProps']['eventsResponse']['items'];
        $similiar_arts =  $response['props']['pageProps']['similarArtworks']['items'];
        $artist = $artwork['artists'][0];

        return view('artwork', compact('artwork', 'artist', 'historical_data', 'similiar_arts'));
    }

    public function queryMaker($params, $page = null)
    {


        $base_url = 'https://art.co';
        $query = '';
        $count = count($params);
        $i = 0;
        foreach ($params as $key => $value) {
            ++$i;
            $query .= $key . '=' . $value . ($i != $count ? '&' : '');
        }
        $base_url .= '/' . $page . '?' . $query;

        return urlencode($base_url);
    }

    public function getData($url)
    {
        $apiurl = config('app.api_url');
        $client = new Client;
        $response = $client->get($apiurl . '?url=' . $url);
        $response = json_decode($response->getBody(), true);
        return $response;
    }
}
