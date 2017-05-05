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
class Welcome extends Controller
{
    /**
     * The currently used Layout.
     *
     * @var string
     */
    protected $layout = 'Welcome';

    /**
     * Create and return a View instance.
     */
    public function subPage()
    {
        $message = __('Hello, welcome from the welcome controller and subpage method! <br/>
This content can be changed in <code>/app/Views/Welcome/SubPage.php</code>');

        return $this->getView()
            ->shares('title', __('Subpage'))
            ->withWelcomeMessage($message);
    }
    public function Upgrade()
    {
        $message = __('We take a one time yearly account upgrade fee.<div class="fee cyan-text large-text">$49</div> <p>This enables us to keep the service running! Once, you upgrade your account:</p><p> You are able to download none stop, upload none stop.</p><p class="cyan-text">Click Below to Check Subscribe</p>');

        return $this->getView()
            ->shares('title', __('One time Annual Account Upgrage'))
            ->withWelcomeMessage($message);
    }
    public function Videos()
    {
        $videos = Videos::orderBy('created_at', 'desc')->paginate(15);
        $audios = Audios::take(5)->orderBy('created_at', 'desc')->get();
        //video rated
        $videosrated = Videos::where('fileViews', '>', 100)->take(1)->orderBy('rating')->get();

        return $this->getView()
            ->shares('title', __('Afro web social videos'))
            ->shares('type', __('Website'))
            ->shares('url', __(''.site_url('videos').''))
            ->shares('description', __('Watch social videos, all in one place. Short funny, day to day videos contributted by service users. Start sharing with us.'))
            ->shares('image', __(''))
            ->with('videosrated', $videosrated)
            ->with('videos', $videos)
            ->with('audios', $audios);

    }

 public function Music()
    {
        $audios = Audios::orderBy('created_at', 'desc')->paginate(15);
        $audiosp = Audios::where('fileViews', '>', 100)->take(5)->orderBy('created_at', 'desc')->get();
         //video rated
        $videosrated = Videos::where('fileViews', '>', 100)->take(1)->orderBy('rating')->get();
        return $this->getView()
            ->shares('title', __('Listen And Download Afro popular sounds. The Best of Afro music online'))
            ->shares('type', __('Website'))
            ->shares('url', __(''.site_url('music').''))
            ->shares('description', __('Weytindey music let\'s it\'s users share and even sell their music online. The best of Afro music, downloads and lyrics of your best artist available.'))
            ->shares('image', __(''))
            ->with('videosrated', $videosrated)
            ->with('audiosp', $audiosp)
            ->with('audios', $audios);

    }



   public function search()
    {       
            $status = '';
            $noresults = '';
            $search = Input::only('search_term');
            $search_term =preg_replace('#[^a-z 0-9?!]#i', '', $search['search_term']);
               if($search_term == ''){
		   // Prepare the flash message.
                  $status = '<div class="search-status red lighten-5">ERROR: Define a search term.</div>';
		} else {
                  $status = '<div class="search-status cyan lighten-5">Search Term: <em class="orange-text">'.$search_term.'</em></div>';
                  $videos_search = DB::table('videos')->where('filename', 'LIKE', '%' .$search_term .'%')
                   ->orWhere('fileDesc', 'LIKE', '%' .$search_term .'%')->get();
                  $audios_search = DB::table('audios')->where('filename', 'LIKE', '%' .$search_term .'%')
                   ->orWhere('fileDesc', 'LIKE', '%' .$search_term .'%')->get();
                   $searchresults = (object) array_merge((array) $videos_search, (array) $audios_search);
                /* (SELECT id, page_title AS title FROM pages WHERE MATCH (page_title,page_body) AGAINST ('$searchquery')) UNION (SELECT id, blog_title AS title FROM blog WHERE MATCH (blog_title,blog_body) AGAINST ('$searchquery'))
                  $users = DB::table('users')->whereNull('last_name')->union($first)->get();
                  $searchresults = Videos::where('filename', 'LIKE', '%' .$search_term .'%')
                  ->orWhere('fileDesc', 'LIKE', '%' .$search_term .'%')->orderBy('created_at', 'desc')
                  ->paginate(25);*/
              }
              
              if(count((array)$searchresults) < 1) {
                $noresults = '<div class="search-status cyan lighten-5">Search Term: <em class="orange-text">No results returned! Refine Search term.</em></div>';
              }
       return View::make('Welcome/Search')
            ->shares('title', __('Searching '.$search_term.''))
            ->with('search_term', $search_term)
            ->with('status', $status)
            ->with('noresults', $noresults)
            ->with('searchresults', $searchresults);

    }

    public function Dmca()
    {
        $message = __('<p>Weytindey is an online service provider as defined in the Digital Millennium Copyright Act. We provide legal copyright owners with the ability to self-publish on the Internet by uploading, storing and displaying various types of media. We do not actively monitor, screen or otherwise review the media which is uploaded to our servers by users of the service.
                </p><p>
                We take copyright violation very seriously and will vigorously protect the rights of legal copyright owners. If you are the copyright owner of content which appears on the Weytindey website and you did not authorize the use of the content you must notify us in writing in order for us to identify the allegedly infringing content and take action.
                </p>
                <p>
                In order to facilitate the process, we have provided an online form for your use. We will be unable to take any action if you do not provide us with the required information, so please fill out all fields accurately and completely. Alternatively, you may make a written notice via e-mail, facsimile or postal mail to our DMCA Agent as listed below. Your written notice must include the following: Specific identification of the copyrighted work which you are alleging to have been infringed. If you are alleging infringement of multiple copyrighted works with a single notification you must submit a representative list which specifically identifies each of the works that you allege are being infringed. Specific identification of the location and description of the material that is claimed to be infringing or to be the subject of infringing activity with enough detailed information to permit us to locate the material. You should include the specific URL or URLs of the web pages where the allegedly infringing material is located. Information reasonably sufficient to allow us to contact the complaining party which may include a name, address, telephone number and electronic mail address at which the complaining party may be contacted. A statement that the complaining party has a good faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent or the law. A statement that the information in the notification is accurate, and under penalty of perjury that the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.
                </p>');

        return $this->getView()
            ->shares('title', __('Dmca | We fight against copyright violation'))
            ->shares('type', __('Article'))
            ->shares('url', __(''.site_url('about/dmca').''))
            ->shares('description', __('Weytindey is an online service provider as defined in the Digital Millennium Copyright Act. We provide legal copyright owners with the ability to self-publish on the Internet by uploading, storing and displaying various types of media.'))
            ->withWelcomeMessage($message);
    }
     public function About()
    {
        $message = __('<p>We are just a team of like minded people with love for motherland. We are trying to make information about Africa easily accessible.</p><p>Weytindey is an online service provider as defined in the Digital Millennium Copyright Act. We provide legal copyright owners with the ability to self-publish on the Internet by uploading, storing and displaying various types of media. We do not actively monitor, screen or otherwise review the media which is uploaded to our servers by users of the service.
                </p>');

        return $this->getView()
            ->shares('title', __('About Us'))
            ->shares('type', __('Article'))
            ->shares('url', __(''.site_url('about').''))
            ->shares('description', __('Weytindey is an online service provider as defined in the Digital Millennium Copyright Act. We provide our users the service to self-publish on the Internet by uploading, storing and displaying various types of media.'))
            ->withWelcomeMessage($message);
    }
      public function Terms()
    {
        $message = __('<p>We take copyright violation very seriously and will vigorously protect the rights of legal copyright owners. If you are the copyright owner of content which appears on the Weytindey website and you did not authorize the use of the content you must notify us in writing in order for us to identify the allegedly infringing content and take action.
                </p><p>We do not actively monitor, screen or otherwise review the media which is uploaded to our servers by users of the service. However we are ready to fight any copyright violation discovered in our service.</p><p>In order to facilitate the process, we have provided an online form for your use. We will be unable to take any action if you do not provide us with the required information, so please fill out all fields accurately and completely. Alternatively, you may make a written notice via e-mail, facsimile or postal mail to our DMCA Agent as listed below. Your written notice must include the following: Specific identification of the copyrighted work which you are alleging to have been infringed. If you are alleging infringement of multiple copyrighted works with a single notification you must submit a representative list which specifically identifies each of the works that you allege are being infringed. Specific identification of the location and description of the material that is claimed to be infringing or to be the subject of infringing activity with enough detailed information to permit us to locate the material. You should include the specific URL or URLs of the web pages where the allegedly infringing material is located. Information reasonably sufficient to allow us to contact the complaining party which may include a name, address, telephone number and electronic mail address at which the complaining party may be contacted. A statement that the complaining party has a good faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent or the law. A statement that the information in the notification is accurate, and under penalty of perjury that the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</p><h1 class="title cyan-text">Weytindey Content</h1><p>Images, scripts and any other content not shared by our users is covered under Weytindey Copyrights. You may not copy, or use such content without prior permission from the Weytindey Team.<p>');

        return $this->getView()
            ->shares('title', __('Terms of Use and Services'))
            ->shares('type', __('Article'))
            ->shares('url', __(''.site_url('about/terms').''))
            ->shares('description', __('However we are ready to fight any copyright violation discovered in our service.'))
            ->withWelcomeMessage($message);
    }
    public function Contact()
    {
        $message = __('Hello, welcome from the welcome controller and subpage method! <br/>
This content can be changed in <code>/app/Views/Welcome/SubPage.php</code>');

        return $this->getView()
            ->shares('title', __('Any inquiries | Contact Us'))
             ->shares('type', __('Article'))
            ->shares('url', __(''.site_url('contact').''))
            ->shares('description', __('We are always eager to hear from you. Have any service questions, we will gladly answer.'))
            ->withWelcomeMessage($message);
    }
    public function contactMsg(){
        if(isset($_POST) and isset($_POST['submit']))
         {
         // Validate the Input data.
         $input = Input::only('name', 'email', 'inquiry_type', 'message');
         $postName = $input['name'];
	     $postEmail = $input['email'];
         $postType = $input['inquiry_type'];
         $postMsg = $input['message'];
         if($postName == '' || $postEmail == '' || $postType == '' || $postMsg == ''){
              echo '<div class="card-panel red darken-3 white-text" style="padding:10px">All fields are required. Check to make sure!</div>';
             
         } else {
             
              Mailer::send('Emails/Contact', array('contact_type' => $_POST['inquiry_type'], 'token' => $_POST['message'], 'name' => $_POST['name'], 'email' => $_POST['email']), function($message)
                {
        
                    $message->to('ericel123@gmail.com')->cc('admin@weytindey.com');
                    $message->subject('Re: '.$_POST['inquiry_type']);
                    $message->replyTo($_POST['email'], $_POST['name']);
                });
                
              echo '<div class="card-panel cyan darken-3 white-text" style="padding:10px">Thanks <em class="red-text">'.$postName.'</em>! We will get back to your as soon as possible!</div>';
         }
         }
    }
 

   public function siteMap()
    {
    header('Content-Type: text/xml');
    $output = '<?xml version="1.0" encoding="UTF-8"?>';
    $output .='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
';
    $output .= '<url>
    <loc>https://www.weytindey.com/</loc>
    </url>
    <url>
    <loc>https://www.weytindey.com/videos</loc>
    </url>
    <url>
    <loc>https://www.weytindey.com/music</loc>
    </url>
    <url>
    <loc>https://www.weytindey.com/add</loc>
    </url>
    <url>
    <loc>https://www.weytindey.com/register</loc>
    </url>
    <url>
    <loc>https://www.weytindey.com/login</loc>
    </url>
    <url>
    <loc>https://www.weytindey.com/about</loc>
    </url>
    <url>
    <loc>https://www.weytindey.com/contact</loc>
    </url>';
    $output .='</urlset>';
    echo $output;
    }
}
