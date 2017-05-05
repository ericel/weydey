<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@novaframework.com
 * @version 3.0
 */

namespace App\Controllers;

use App\Core\Controller;

use View;
use App\Models\Contact;
use App\Models\Videos;
use App\Models\Audios;
use Input;
use Validator;
use Request;
use DB;
use Mailer;

/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Main extends Controller
{
    /**
     * The currently used Layout.
     *
     * @var string
     */
    protected $layout = 'Main';

    
    /**
     * Create and return a View instance.
     */
     public function index()
    {
        $this->layout = "Main";
        $videos = Videos::take(15)->orderBy('created_at', 'desc')->get();
        $audios = Audios::take(5)->orderBy('created_at', 'desc')->get();
        //video rated
        $videosrated = Videos::where('fileViews', '>', 100)->take(1)->orderBy('rating')->get();
        return View::make('Welcome/Welcome')
            ->shares('title', __('Afro Social Media Site'))
            ->shares('type', __('Website'))
            ->shares('url', __(''.site_url().''))
            ->shares('description', __('Watch Social Videos, Listen to Afro music all for free. At Weytindey, we try to connect the dots, Information neccessary to keep our world growing.'))
            ->shares('image', __(''))
            ->with('videosrated', $videosrated)
            ->with('videos', $videos)
            ->with('audios', $audios);
    }

   
}
