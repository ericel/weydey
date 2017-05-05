<?php
/**
 * Dasboard - Implements a simple Administration Dashboard.
 *
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */

namespace App\Modules\System\Controllers\Admin;

use App\Core\BackendController;

use View;
use App\Models\Videos;
use App\Models\Audios;
use Auth;

class Dashboard extends BackendController
{

     public function index()
    {
        $username = Auth::user()->username;
        $audios = Audios::where('username', '=', $username)->orderBy('created_at', 'Desc')->get();
        $videos = Videos::where('username', '=', $username)->orderBy('created_at', 'Desc')->get();

        return $this->getView()
            ->with('audios', $audios)
            ->with('videos', $videos)
            ->shares('title', __d('system', 'Dashboard'));
    }

    public function Audios()
    {
        $username = Auth::user()->username;
        $audios = Audios::where('username', '=', $username)->orderBy('created_at', 'Desc')->get();
        return $this->getView()
            ->with('audios', $audios)
            ->shares('title', __d('system', 'Audios'));
    }
   
   public function Videos()
    {
        $username = Auth::user()->username;
        $videos = Videos::where('username', '=', $username)->orderBy('created_at', 'Desc')->get();
        return $this->getView()
            ->with('videos', $videos)
            ->shares('title', __d('system', 'Videos'));
    }

}
