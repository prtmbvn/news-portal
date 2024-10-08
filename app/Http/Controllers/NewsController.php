<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Weidner\Goutte\GoutteFacade as Goutte;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();

        $category = $request->get('category', '');

        // Function untuk memproses URL dan mengambil data
        function fetchNews($client, $baseUrl, $category)
        {
            try {
                $url = $category ? $baseUrl . '/' . $category : $baseUrl . '/terbaru';
                $response = $client->get($url);
                $data = json_decode($response->getBody(), true);

                // Cek apakah ada posts yang valid di dalam data
                if (isset($data['data']['posts']) && !empty($data['data']['posts'])) {
                    return $data['data']['posts'];
                }
            } catch (\Exception $e) {
                // Log error jika ada exception atau error dari API
                // \Log::error('Error fetching news from: ' . $baseUrl . ' - ' . $e->getMessage());
            }

            return []; // Kembalikan array kosong jika tidak ada data
        }

        // Proses masing-masing URL
        $posts_cnn = fetchNews($client, 'https://api-berita-indonesia.vercel.app/cnn', $category);
        $posts_antara = fetchNews($client, 'https://api-berita-indonesia.vercel.app/antara', $category);
        $posts_jpnn = fetchNews($client, 'https://api-berita-indonesia.vercel.app/jpnn', $category);
        $posts_kumparan = fetchNews($client, 'https://api-berita-indonesia.vercel.app/kumparan', $category);
        $posts_merdeka = fetchNews($client, 'https://api-berita-indonesia.vercel.app/merdeka', $category);
        $posts_republika = fetchNews($client, 'https://api-berita-indonesia.vercel.app/republika', $category);
        $posts_sindonews = fetchNews($client, 'https://api-berita-indonesia.vercel.app/sindonews', $category);
        $posts_tribun = fetchNews($client, 'https://api-berita-indonesia.vercel.app/tribun', $category);

        // Menggabungkan hanya array yang tidak kosong
        $all_posts = array_merge(
            $posts_cnn,
            $posts_antara,
            $posts_jpnn,
            $posts_kumparan,
            $posts_merdeka,
            $posts_republika,
            $posts_sindonews,
            $posts_tribun
        );


        // Periksa apakah ada data yang tergabung
        if (empty($all_posts)) {
            return view('page.home', ['message' => 'Tidak ada berita yang tersedia untuk kategori tersebut.']);
        }

        // dd($all_posts);

        return view('page.home', ['articles' => $all_posts ,'category'=>$category]);
    }
}