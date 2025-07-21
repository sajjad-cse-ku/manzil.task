<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use Illuminate\Support\Str;
class ShortLinkController extends Controller
{
    public function index()
    {
        $shortLinks = ShortLink::latest()->get();
        return view('shortlink', compact('shortLinks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        $shortCode = Str::random(6);

        $shortLink = ShortLink::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode
        ]);

        return redirect()->back()->with('success', 'Short link created!');
    }

    public function redirect($code)
    {
        $shortLink = ShortLink::where('short_code', $code)->firstOrFail();
        $shortLink->increment('clicks');
        return redirect($shortLink->original_url);
    }
}
