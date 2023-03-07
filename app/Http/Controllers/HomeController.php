<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $general_settings = Setting::select('building_name', 'welcome_message')->first();

        $pinned_announcements = Announcement::where('status', true)->where('pinned', true)->get();

        $announcements = Announcement::where('pinned', false)->where('status', true)->orderBy('id','desc')->get();
        
        return view('home', compact('general_settings', 'pinned_announcements', 'announcements'));
    }
}
