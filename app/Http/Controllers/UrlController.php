<?php

namespace App\Http\Controllers;

use App\Models\Inspector;
use App\Models\Url;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'original' => ['required', 'url']
        ]);

        $validated['user_id'] = Auth::user()->id ?? null;
        $validated['uid'] = Str::random(8);

        Url::create($validated);

        return redirect()->route('dashboard')->with('flash', [
            'banner' => 'URL Shortened!',
            'bannerStyle' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {

        $getIp = Http::get('https://api.ipify.org/?format=json')->body();
        $getIp = json_decode($getIp)->ip;

        $iplookup = Http::get("http://ip-api.com/json/" . $getIp, [
            'fields' => 'status,message,country,countryCode,region,regionName,city,zip,lat,lon,timezone,isp,org,mobile,query'
        ])->body();
        $iplookup = json_decode($iplookup, true);
        $iplookup['ip'] = $getIp;
        $iplookup['url_id'] = $url->id;

        $inspector = Inspector::create(
            $iplookup
        );

        $url->save();

        return redirect()->to($url->original);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        $url->delete();

        return redirect()->back()->with('flash', [
            'banner' => 'URL Deleted!',
            'bannerStyle' => 'success'
        ]);
    }

    function inspect(Url $url)
    {
        return view('url-inspectors', [
            'inspectors' => $url->inspectors
        ]);
    }
}
