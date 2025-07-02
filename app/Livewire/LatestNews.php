<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use App\Services\HttpService;
use Illuminate\Support\Env;

class LatestNews extends Component
{
    public $selectedApi;
    public $news = [];
    public $apiUrls = [];
    protected $httpService;
    // public $selectedCountry;


// aggiunto funzione allowedApis e denominato le 3 approvate


public $allowedApis = [
    'uk' => 'https://newsapi.org/v2/top-headlines?country=gb&apiKey=5fbe92849d5648eabcbe072a1cf91473',
    'us' => 'https://newsapi.org/v2/top-headlines?country=us&apiKey=5fbe92849d5648eabcbe072a1cf91473',
    'it' => 'https://newsapi.org/v2/top-headlines?country=it&apiKey=5fbe92849d5648eabcbe072a1cf91473',
    ];

public $selectedApiKey = 'uk';
public $selectedApiKey1 = 'us';
public $selectedApiKey2 = 'it';

//codice insicuro

    public function __construct()
    {
        $this->httpService = app(HttpService::class);
    }

public function mount()
    {
        $this->httpService = app(HttpService::class);

        $apiKey = env('NEWSAPI_API_KEY');

// https://newsapi.org/v2/top-headlines?country=us&apiKey=5fbe92849d5648eabcbe072a1cf91473


        // Costruisci le URL dinamicamente usando la chiave API dal .env
        $this->apiUrls = [
            'it' => "https://newsapi.org/v2/top-headlines?country=it&apiKey=$apiKey",
            'gb' => "https://newsapi.org/v2/top-headlines?country=gb&apiKey=$apiKey",
            'us' => "https://newsapi.org/v2/top-headlines?country=us&apiKey=$apiKey",
        ];
    }




//     public function fetchNews()
//     {
//         $httpService = app(\App\Services\HttpService::class);

//         if (filter_var($this->selectedApi, FILTER_VALIDATE_URL) === FALSE) {
//             $this->news = 'Invalid URL';
//             return;
//         }

//         if (!array_key_exists($this->selectedApiKey or $this->selectedApiKey1 or $this->selectedApiKey2, $this->allowedApis)) {
//         $this->news = 'API non consentita';
//         return ;

        
//     }

// ///


//     try {
//             $response = $this->httpService->getRequest($this->selectedApi);
//             $this->news = json_decode($response, true);
//         } catch (\Exception $e) {
//             $this->news = ['error' => 'Errore nel recupero delle news'];
//         }

//         $this->news = json_decode($this->httpService->getRequest($this->selectedApi), true);

//     }
//     public function render()
//     {
//         $apiKey = config('services.newsapi.api_key');

//     // ...logica...

//     return view('livewire.latest-news', [
//         'apiKey' => $apiKey,
//     ]);
//         // return view('livewire.latest-news');
//     }


public function fetchNews()
{

    
    $apiKey = env('NEWSAPI_API_KEY');
    // $country = $this->selectedCountry;
// Costruisci la URL lato server

// https://newsapi.org/v2/top-headlines?country=us&apiKey=5fbe92849d5648eabcbe072a1cf91473

    $url = "https://newsapi.org/v2/top-headlines?country=$this->selectedApi&apiKey=$apiKey";


    $allowed = ['it', 'gb', 'us'];
    if (!in_array($this->selectedApi, $allowed)) {
        $this->news = ['error' => 'API non consentita'];
        return;
    }


    try {
        $response = $this->httpService->getRequest($url);
        $this->news = json_decode($response, true);
    } catch (\Exception $e) {
        $this->news = ['error' => 'Errore nel recupero delle news'];
    }
}






}
