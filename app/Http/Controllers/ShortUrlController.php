<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function index()
    {
        return view('shortener');
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortCode = Str::random(6);
        while (ShortUrl::where('short_code', $shortCode)->exists()) {
            $shortCode = Str::random(6);
        }

        $shortUrl = ShortUrl::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
        ]);

        return view('shortener', [
            'shortUrl' => $shortUrl,
        ]);
    }

    public function redirect($short_code)
    {
        $shortUrl = ShortUrl::where('short_code', $short_code)->firstOrFail();
        $shortUrl->increment('access_count');
        return redirect($shortUrl->original_url);
    }
}
