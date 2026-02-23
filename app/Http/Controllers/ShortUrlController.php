use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class ShortUrlController extends Controller

    public function qrcode($short_code)
    {
        $shortUrl = ShortUrl::where('short_code', $short_code)->firstOrFail();
        $url = url('/' . $shortUrl->short_code);
        $qr = new QrCode($url);
        $qr->setSize(250);
        $writer = new PngWriter();
        $result = $writer->write($qr);
        return response($result->getString(), 200)
            ->header('Content-Type', $result->getMimeType());
    }
{
    public function __construct()
    {
        $this->middleware('auth')->except(['redirect']);
    }
    public function listagem()
    {
        $shortUrls = ShortUrl::orderByDesc('created_at')->get();
        return view('lista_links', compact('shortUrls'));
    }
    public function index()
    {
        $shortUrls = ShortUrl::orderByDesc('created_at')->get();
        return view('shortener', compact('shortUrls'));
    }
    public function destroy($id)
    {
        $shortUrl = ShortUrl::findOrFail($id);
        $shortUrl->delete();
        return redirect()->route('home')->with('success', 'Link excluído com sucesso!');
    }

    public function store(Request $request)
    {
        \Log::info('Tentando encurtar link', [
            'original_url' => $request->original_url,
            'custom_slug' => $request->custom_slug,
        ]);

        $request->validate([
            'original_url' => 'required|url',
            'custom_slug' => [
                'nullable',
                'alpha_dash',
                'min:3',
                'max:30',
                'unique:short_urls,short_code',
            ],
        ]);

        if ($request->filled('custom_slug')) {
            $shortCode = $request->custom_slug;
        } else {
            $shortCode = Str::random(6);
            while (ShortUrl::where('short_code', $shortCode)->exists()) {
                $shortCode = Str::random(6);
            }
        }

        try {
            $shortUrl = ShortUrl::create([
                'original_url' => $request->original_url,
                'short_code' => $shortCode,
            ]);
            \Log::info('Link encurtado salvo com sucesso', [
                'id' => $shortUrl->id,
                'short_code' => $shortUrl->short_code,
                'original_url' => $shortUrl->original_url,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erro ao salvar link encurtado', [
                'message' => $e->getMessage(),
                'original_url' => $request->original_url,
                'short_code' => $shortCode,
            ]);
            return redirect()->route('home')->with('error', 'Erro ao encurtar link.');
        }

        return redirect()->route('home')->with('shortUrl', $shortUrl);
    }

    public function redirect($short_code)
    {
        $shortUrl = ShortUrl::where('short_code', $short_code)->firstOrFail();
        $shortUrl->increment('access_count');
        return redirect($shortUrl->original_url);
    }
}
