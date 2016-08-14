<?php

namespace App\Http\Controllers\Live;

use Illuminate\Http\Request;
use App\Model\LiveInfo;
use App\Model\SiteConfig;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LiveController extends Controller
{
    public function getindex()
    {
        $siteconfig = SiteConfig::find(1);
        if(time() - $siteconfig->live_update_time > $siteconfig-> live_update_duration)
        {
            $siteconfig->live_update_time = time();
            $siteconfig->save();
            return view('welcome');
        }
        return view('welcome');
    }
}
