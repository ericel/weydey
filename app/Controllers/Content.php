<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Videos;
use App\Models\Audios;
use App\Models\Downloads;
use App\Models\Comment;
use Redirect;
use Response;
use View;
use Auth;
use Str;
use Input;
use File;
use DB;
use Nova\Helpers\SimpleCurl as Curl;
class Content extends Controller
{
  protected $layout = 'Welcome';
   public function index()
    {
        $message = __('Hello, welcome from the welcome controller! <br/>
this content can be changed in <code>/app/Views/Welcome/Welcome.php</code>');
        return View::make('Content/Index')
            ->shares('title', __('Share videos, music and blogs!'))
            ->shares('description', __('Social videos and music online for free.'))
            ->with('welcomeMessage', $message);
    }
    
    

    public function addVideo()
    {  $message = '';
        $videos = array();
        return View::make('Content/Add/Video')
            ->shares('title', __('Share Social Videos Online'))
            ->shares('description', __('Share Social videos and music online for free. We provide our users the service to self-publish on the Internet by uploading, storing and displaying their videos with us.'))
            ->with('welcomeMessage', $videos);
    }

    public function addAudio()
    {
        $message = __('Hello, welcome from the welcome controller! <br/>
this content can be changed in <code>/app/Views/Welcome/Welcome.php</code>');
        return View::make('Content/Add/Audio')
            ->shares('title', __('Share Afro Music Online'))
            ->shares('description', __('Share music online for free. We provide our users the service to self-publish on the Internet by uploading, storing and displaying their music with us.'))
            ->with('welcomeMessage', $message);
    }

  public function video($vid_title)
    {   
        $vidID =  substr($vid_title, strrpos($vid_title, '-') + 1);
        $video = Videos::find($vidID);
        $path_url = 'video/'.$vid_title.'';

        if($video === null) {
            // There is no User with this ID.
            $status = __d('Video', 'video not found: #{0}', $vidID);

            return Redirect::to('admin/users')->withStatus($status, 'danger');
        }
      
        $editUrl = site_url('edit/video/'.$vid_title.'');
        //Update Views
        $videoupdate = Videos::find($vidID);
        $videoupdate->fileViews = $video->fileViews + 1;
        $videoupdate->save();
        
        //content like
         $search_exploded = explode (" ", $video->filename);
         $x = 1;
         $construct = '';
        foreach($search_exploded as $search_each) {
         if($x==1) {
                $construct .="filename LIKE '%$search_each%'";
            } else {
                $construct .=" OR fileDesc LIKE '%$search_each%'";
            }
            $x++;
        }
        $VideosPopular = DB::select("SELECT * FROM weydey_videos WHERE  fileID != '$video->fileID' ORDER BY created_at desc limit 3");
        //video rated
        $videosrated = Videos::where('fileViews', '>', 100)->take(1)->orderBy('rating')->get();
        $slug = Str::slug($video->filename);
        $getComments = DB::table('users')
                      ->leftJoin('comments', 'users.username', '=', 'comments.username')
                      ->where('comments.fileID', $vidID)
                      ->paginate(6);

        $meta="";
        //$type = pathinfo(resource_url($video->fileImg), PATHINFO_EXTENSION);
        //$data = file_get_contents(resource_url($video->fileImg));
        //$meta .= 'data:image/' . $type . ';base64,' . base64_encode($data);
         
        $meta .= '
        <meta property="og:type" content="movie">
        <meta property="og:video" content="'.resource_url($video->file).'">';
       $meta .= '<meta property="og:video:secure_url" content="'.resource_url($video->file).'">
        <meta property="og:video:type" content="video/mp4">
        <meta property="og:video:width" content="640">
        <meta property="og:video:height" content="360">
        <meta name="date" content="'.$video->created_at.'">';
       /* $meta .= '<meta property="og:type" content="movie" />
        <meta property="og:video:height" content="260" />
        <meta property="og:video:width" content="420" />
        <meta property="og:video:type" content="application/x-shockwave-flash" />
        <meta property="og:title" content="'.$video->filename.'" />
        <meta property="og:description" content="'.$video->fileDesc.'. Have fun watching '.str_replace("-"," ",$video->filename).' with us. We bring you the best of videos online" />
        <meta property="og:image" content="'.resource_url($video->fileImg).'" />
         <meta property="og:video" content="https://www.weytindey.com/assets/jwplayer/jwplayer.flash.swf?file=https%3A%2F%2Fwww.weytindey.com%2assets%2uploads%2videos%2'.$vidID.'.'.$video->fileExt.'&autostart=true" />
        <meta property="og:video:secure_url" content="https://www.weytindey.com/assets/jwplayer/jwplayer.flash.swf?file=https%3A%2F%2Fwww.weytindey.com%2assets%2uploads%2videos%2'.$vidID.'.'.$video->fileExt.'&autoplay=true" />';*/

        return View::make('Content/Content/Video')
            ->shares('title', __('Watch:  '.$video->filename.''))
            ->shares('description', __(''.$video->fileDesc.'. Have fun watching '.str_replace("-"," ",$video->filename).' with us. We bring you the best of videos online'))
            ->shares('keywords', __('Watch '.$video->filename.', social videos, funny videos, Listen and download '.$video->filename.', Afrovideos, '.str_replace("-"," ",$video->filename).', weytindey music, africa videos, nollywood videos, weytindey videos'))
            ->shares('url', __(''.site_url($path_url).''))
            ->shares('meta', __(''.$meta.''))
            ->shares('image', __(''.resource_url($video->fileImg).''))
            ->with('video', $video)
            ->with('videospopular', $VideosPopular)
            ->with('comments', $getComments)
            ->with('videosrated', $videosrated);
    }

  public function audio($aud_title)
    {
      
     
        $audID =  substr($aud_title, strrpos($aud_title, '-') + 1);
        $audio = Audios::find($audID);
        $path_url = 'audio/'.$aud_title.'';

        if($audio === null) {
            $status = __d('Audio', 'audio not found: #{0}', $audID);

            return Redirect::to('admin/users')->withStatus($status, 'danger');
        }
        $editUrl = site_url('edit/audio/'.$aud_title.'');
        $download_url = site_url('download/file/'.$audID.'');
       //Update Views
        $audio->fileViews = $audio->fileViews + 1;
        $audio->save();
      //content like
        $audiosPopular = Audios::where('fileViews', '>=', 100)->take(6)->orderBy('created_at')->get();
       
        //video rated
        $videosrated = Videos::where('fileViews', '>', 100)->take(1)->orderBy('rating')->get();
      
        $search_exploded = explode (" ", $audio->filename);
         $x = 1;
         $construct = '';
        foreach($search_exploded as $search_each) {
         if($x==1) {
                $construct .="filename LIKE '%$search_each%'";
            } else {
                $construct .=" OR fileDesc LIKE '%$search_each%'";
            }
            $x++;
        }
        $audioslike = DB::select("SELECT * FROM weydey_audios WHERE filename LIKE '%$search_exploded[0]%' AND  fileID != '$audio->fileID'  limit 6");
    
        $getComments = DB::table('users')
                      ->leftJoin('comments', 'users.username', '=', 'comments.username')
                      ->where('comments.fileID', $audID)
                      ->paginate(6);
        //$getComments = Comment::find($audID)->commentImage();
        /*$contains_the_string = array(); // container of the matches
        foreach ($audiosd as $k => $v) { // so, for each object
            if (stripos($v->filename, $string_to_find) !== false) {
            // check if string to find is contained within the name attribute
                $contains_the_string[] = $v; // if yes, put it inside the container
            }
        }*/ 
      //print_r($contains_the_string);
      //   $audioslike = $contains_the_string;
        
        //var_dump($audioslike);
        $meta='<meta name="date" content="'.$audio->created_at.'">';
        /*$meta .= '<meta property="og:type" content="video.other">
        <meta property="og:audio" content="'.resource_url($audio->file).'" />
        <meta property="og:audio:secure_url" content="'.resource_url($audio->file).'" />
        <meta property="og:audio:type" content="audio/mpeg" />';*/
        return View::make('Content/Content/Audio')
            ->shares('title', __('Listen And Download  '.str_replace("-"," ",$audio->filename).''))
            ->shares('description', __(''.$audio->fileDesc.'. Have fun listening to '.str_replace("-"," ",$audio->filename).'. Lyrics for '.str_replace("-"," ",$audio->filename).' are also available all for free. You can also download '.str_replace("-"," ",$audio->filename).' free if you decide to do so.'))
            ->shares('keywords', __(''.$audio->fileDesc.' lyrics, Listen and download '.$audio->fileDesc.', Afromusic, '.str_replace("-"," ",$audio->filename).', weytindey music, africa music'))
            ->shares('image', __(''.resource_url($audio->fileImg).''))
            ->shares('url', __(''.site_url($path_url).''))
            ->shares('meta', __(''.$meta.''))
            ->with('audiospopular', $audiosPopular)
            ->with('videosrated', $videosrated)
            ->with('editurl', $editUrl)
            ->with('download_url', $download_url)
            ->with('audioslike', $audioslike)
            ->with('comments', $getComments)
            ->with('audio', $audio);
    }

    public function store(){
        $upload_result = '';  
        $valid_file_formats = array("mp4", "mov", "mp3", "MP3", "ogg", "acc", "m4a", "wma", "flac", "wav");
        $valid_file_formats_audio = array("mp3", "MP3", "ogg", "acc", "m4a", "wma", "flac", "wav");
        $valid_file_formats_video = array("mp4", "mov");
        if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
        {
                $name = $_FILES['file-b']['name'];
                $size = $_FILES['file-b']['size'];
                $filename = pathinfo($name, PATHINFO_FILENAME);
                $bytes = $size;
                 if ($bytes >= 1073741824)
                  {
                      $bytes = number_format($bytes / 1073741824, 2) . ' GB';
                  }
                  elseif ($bytes >= 1048576)
                  {
                      $bytes = number_format($bytes / 1048576, 2) . ' MB';
                  }
                  elseif ($bytes >= 1024)
                  {
                      $bytes = number_format($bytes / 1024, 2) . ' KB';
                  }
                  elseif ($bytes > 1)
                  {
                      $bytes = $bytes . ' bytes';
                  }
                  elseif ($bytes == 1)
                  {
                      $bytes = $bytes . ' byte';
                  }
                  else
                  {
                      $bytes = '0 bytes';
                  }
       $extensions = "mp3, ogg, acc, m4a, wma, flac, wav, mp4, mov";  
       if(strlen($name)) {
                list($txt, $ext) = explode(".", $name);
       if(in_array($ext,$valid_file_formats)) {
        if($size < 67108864) {
                $vidID = substr(md5(time()+$filename), 0, 11);
                $video_name = $vidID.".".$ext;
                $tmp = $_FILES['file-b']['tmp_name'];
        
           if(in_array($ext,$valid_file_formats_video)){
                  $path = ROOTDIR ."assets/uploads/videos/";
           }
            if(in_array($ext,$valid_file_formats_audio)){
                  $path = ROOTDIR ."assets/uploads/audios/";
           }
         if($filename !== '' || $vidID !== ''){
           if(move_uploaded_file($tmp, $path.$video_name)){
                if(in_array($ext,$valid_file_formats_audio)){
                      $postType = "audio";
                      $postTitle = $filename;
                      $postDesc = $filename;
                      $postID = $vidID;
                      if($postTitle == '' || $postDesc == '' || $postID == ''){
                            $error = 'All fields  are  required';
                      } else {
                      $audio = new Audios;
                      $audio->filename = $postTitle;
                      $audio->fileID = $postID;
                      $audio->fileDesc = $postDesc;
                      $audio->username = Auth::user()->username;
                      $audio->fileImg = 'uploads/audios/thumbnails/audio.png';
                      $audio->file = 'uploads/audios/'.$video_name.'';
                      $audio->fileExt = $ext;
                      $audio->rating = 1;
                      $audio->save();
                      }
                      // End Database adding
                      $upload_result .= '<div class="row"><div class="cyan lighten-5">File Successfully Uploaded</div>';
                      $upload_result .= '<div class="cyan lighten-5">Click Here to Watch Video : <a target="_blank" href="http://weytindey.com/video/'.$filename.'-'.$vidID.'">http://weytindey.com/audio/'.$filename.'-'.$vidID.'</a></div></div>';
                     $upload_result .= '<div id="jquery_jplayer_1"><audio controls><source src="'.resource_url('uploads/audios/'.$video_name.'').'" type="audio/'.$ext.'">
                     Your browser does not support the audio element.</audio></div>';
                }
                if(in_array($ext,$valid_file_formats_video)){
                    //Add to database
                      $postType = "video";
                      $postTitle = $filename;
                      $postDesc = $filename;
                      $postID = $vidID;
                      if($postTitle == '' || $postDesc == '' || $postID == ''){
                            $error = 'All fields  are  required';
                      } else {
                      $video = new Videos;
                      $video->filename = $postTitle;
                      $video->fileID = $postID;
                      $video->fileDesc = $postDesc;
                      $video->username = Auth::user()->username;
                      $video->fileImg = 'image';
                      $video->file = 'uploads/videos/'.$video_name.'';
                      $video->fileExt = $ext;
                      $video->rating = 1;
                      $video->save();
                      }
                      // End Database adding
                      $upload_result .= '<div class="row"><div class="cyan lighten-5">File Successfully Uploaded</div>';
                      $upload_result .= '<div class="cyan lighten-5">Click Here to Watch Video : <a target="_blank" href="http://weytindey.com/video/'.$filename.'-'.$vidID.'">http://weytindey.com/video/'.$filename.'-'.$vidID.'</a></div></div>';
                     $upload_result .= '<div id="jquery_jplayer_1"><video id="videoThis" width="100%" height="480" controls autoplay>
                        <source src="'.resource_url('uploads/videos/'.$video_name.'').'" type="video/mp4">
                        Your browser does not support the video tag.
                        </video></div>';
                }
                $upload_result .= '
                <div id="infoform"  class="mar-15 row">
                <div class="cyan lighten-5">
                        <div id="previewContent" class="color-primary"></div>
                <form class="col s12" id="contentForm" method="POST"
                action="'.site_url('add/update').'"
                >
                   <div class="input-field col s12">
                   <label for="filename">Filename</label><br>
                     <input  id="filename" name="filename" type="text" class="validate" value="'.$filename.'">
                   </div>
                   <div class="input-field col s12">
                   <label for="vid-desc">File Description</label><br>
                     <textarea id="vid-desc" name="vid-desc" class="materialize-textarea">'.$filename.'</textarea>
                     
                   </div>
                        <input type="hidden" name="video-ID" id="video-ID" value="'.$vidID.'">
                        <input type="hidden" name="image-ID" id="image-ID" value="">
                        <input type="hidden" name="post-type" id="post-type" value="'.$postType.'">    
                        <button type="submit" class="btn btn-primary" name="submit">Click Here to Upload File</button>
                </form>
                <div class="clearfix"></div>
                </div>
                </div>
                ';
                echo $upload_result;
        } else
          echo '<div class="alert red lighten-1 white-text">Video Upload failed, Could move file to disk</div>';
        } else
          echo '<div class="alert red lighten-1 white-text">Video Upload failed, Try again or use another file!</div>';
        } else
          echo '<div class="alert red lighten-1 white-text">Video file size maximum 64MB exceeded. Your file is '.$bytes.'</div>';
        } else
        echo '<div class="alert red lighten-1 white-text">Invalid file format! Accepted formats '.$extensions.'</div>';
        } else
        echo '<div class="alert red lighten-1 white-text">Please select a video</div>';
        exit;
        }
        
    }

  public function UpdateFileContent()
    {
        if(isset($_POST) and isset($_POST['submit']))
         {
         $postTitle = $_POST['filename'];
	       $postDesc = $_POST['vid-desc'];
         $postID = $_POST['video-ID'];
         $postType = $_POST['post-type'];
         $postImg = $_POST['image-ID'];
         if($postType === 'video'){

          $ifp = fopen(ROOTDIR .'assets/uploads/videos/thumbnails/'.$postID.'.jpg', "wb"); 

          $data = explode(',', $postImg);

          fwrite($ifp, base64_decode($data[1])); 
          fclose($ifp); 
          if($postTitle == '' || $postDesc == '' || $postID == ''){
            $error = 'All fields  are  required';
          } else {
                              $video =  Videos::find($postID);
                              $video->filename = $postTitle;
                              $video->fileDesc = $postDesc;
                              $video->fileImg = 'uploads/videos/thumbnails/'.$postID.'.jpg';
                              $video->save();
                              $status = __('Product does not exist.');
                              return Redirect::to('add/video')->withStatus($status, 'danger');
          }
      }
       if($postType === 'audio'){
          if($postTitle == '' || $postDesc == '' || $postID == ''){
            $error = 'All fields  are  required';
          } else {
                              $audio =  Audios::find($postID);
                              $audio->filename = $postTitle;
                              $audio->fileDesc = $postDesc;
                              $audio->save();
                              $status = __('Product does not exist.');
                              return Redirect::to('add/audio')->withStatus($status, 'danger');
          }

       }
     }
  
    }
 public function addComment(){
    if(isset($_POST) and isset($_POST['submit']))
         {
         $postID = $_POST['file-ID'];
	       $postComment = $_POST['comment'];
        if($postComment !== '' || $postID !== ''){
           $comment = new Comment;
           $comment->fileComment = $postComment;
           $comment->fileID = $postID;
           $comment->username = Auth::user()->username;
           $comment->save();
         $commentstatus = '';

         $commentstatus .= '<li class="collection-item avatar">
                          <i class="material-icons circle green">insert_chart</i>
                          <span class="title">'.Auth::user()->username.'</span>
                          <p>'.$postComment.'</p>
                          <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                          </li>';
         echo $commentstatus;
        }
       }
 }
 public function deleteComment(){
   if(isset($_POST["deleteID"])){
     $comment = DB::table('comments')->where('id', $_POST["deleteID"])->delete();
      echo 'accept_ok';
   } else {
      echo 'reject_ok';
   }
 }
 public function Editfile($type, $vid_title){

        $vidID =  substr($vid_title, strrpos($vid_title, '-') + 1);
      if($type === "video"){
        $file = Videos::find($vidID);
        
        if($file === null) {
            // There is no User with this ID.
            $status = __d('Video', 'video not found: #{0}', $vidID);

            return Redirect::to('/')->withStatus($status, 'danger');
       }
       if($file->username !== Auth::user()->username){
          // There is no User with this ID.
            $status = __d('Video', 'User missmatch: #{0}', $vidID);

            return Redirect::to('/')->withStatus($status, 'danger');
       }
      }

    if($type === "audio"){
        $file = Audios::find($vidID);
        
        if($file === null) {
            // There is no User with this ID.
            $status = __d('Audio', 'Audio not found: #{0}', $vidID);

            return Redirect::to('/')->withStatus($status, 'danger');
       }
       if($file->username !== Auth::user()->username){
          // There is no User with this ID.
            $status = __d('Audio', 'User missmatch: #{0}', $vidID);

            return Redirect::to('/')->withStatus($status, 'danger');
       }
      }
    return View::make('Content/Add/Editfile')
            ->shares('title', __('Watch  '.$file->filename.''))
            ->with('file', $file)
            ->with('fileType', $type);
 }

  public function UpdateFile(){
  
     if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
        {
          $postTitle = $_POST['filename'];
          $postDesc = $_POST['file-desc']; 
          $vidID = $_POST['file-ID'];
          $type = $_POST['file-type']; 
          
          if($type === "video"){
            if($postTitle == '' || $postDesc == ''){
                echo 'All fields  are  required';
              } else { 
                      $vidUpdate = Videos::find($vidID);
                      $vidUpdate->filename = $postTitle;
                      $vidUpdate->fileDesc = $postDesc;
                      $vidUpdate->save();
                echo '<div class="cyan white-text">Updated sucessfully</div>';
            }
        }
         if($type === "audio"){
            $postLyrics = $_POST['file-lyrics']; 
            if($postTitle == '' || $postDesc == ''){
                echo 'All fields  are  required';
              } else { 
                      $vidUpdate = Audios::find($vidID);
                      $vidUpdate->filename = $postTitle;
                      $vidUpdate->fileDesc = $postDesc;
                      $vidUpdate->fileLyrics = $postLyrics;
                      $vidUpdate->save();
                echo '<div class="cyan white-text">Updated sucessfully</div>';
            }
        }
    
      }
  }
  public function Updatevideoimg(){
      $upload_result = '';  
      $valid_file_formats = array("gif", "png", "jpg");
      if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
      {
       $vidID = $_POST['file-ID'];
       $type = $_POST['file-type']; 
       $name = $_FILES['image']['name'];
       $size = $_FILES['image']['size'];
 
      $filename = pathinfo($name, PATHINFO_FILENAME);
      if(strlen($name)) {
                list($txt, $ext) = explode(".", $name);
       if(in_array($ext,$valid_file_formats)) {
        if($size<(1024*1024)) {
                $image_name = $vidID.".jpg";
                $tmp = $_FILES['image']['tmp_name'];
         if($type === "video"){
                $path = ROOTDIR ."assets/uploads/videos/thumbnails/";
          }
        if($type === "audio"){
                $path = ROOTDIR ."assets/uploads/audios/thumbnails/";
          }
         if($filename !== '' || $vidID !== ''){
           if(move_uploaded_file($tmp, $path.$image_name)){
                // End Database adding
                if($type === "video"){
                      $video = Videos::find($vidID);
                      $video->fileImg = 'uploads/videos/thumbnails/'.$image_name.'';
                      $video->save();
                }
                if($type === "audio"){
                      $audio = Audios::find($vidID);
                      $audio->fileImg = 'uploads/audios/thumbnails/'.$image_name.'';
                      $audio->save();
                }
                $upload_result .= '<div class="row"><div class="cyan lighten-5">File Successfully Uploaded</div>';
                echo $upload_result;
        } else
          echo "Image Upload failed";
        } else
          echo '<div class="red lighten-1">Image Upload failed, Try again or use another file!</div>';
        } else
          echo "Image file size maximum 1 MB";
        } else
        echo "Invalid file format";
        }
      }
    
  }
 
  public function delete(){
  if(isset($_POST["deleteID"]) && isset($_POST['fileType'])){
    $fileID =  $_POST["deleteID"];
    $fileType =  $_POST["fileType"];
      if($fileType === 'video')
    { 
      $video = Videos::find($fileID);
      if($video->username !== Auth::user()->username){
            // There is no User with this ID.
              $status = __d('Video', 'User missmatch: #{0}', $fileID);

              return Redirect::to('/')->withStatus($status, 'danger');
        }
     
      $path = "assets/uploads/videos/thumbnails/".$fileID.".jpg";
      $path_video = "assets/uploads/videos/".$fileID.".".$video->fileExt."";
    if (file_exists('assets/'.$video->file)){
     if (unlink($path_video))
      {
        if (file_exists($path)){
          if (unlink($path))
          {
          $video->delete();
            echo "accept_ok";
          }
        } else {
           $video->delete();
            echo "accept_ok";
        }
      }
     }
      }
   if($fileType === 'audio')
    { 
      $audio = Audios::find($fileID);
      if($audio->username !== Auth::user()->username){
            // There is no User with this ID.
              $status = __d('Audio', 'User missmatch: #{0}', $fileID);

              return Redirect::to('/')->withStatus($status, 'danger');
        }
     $path = "assets/uploads/audios/thumbnails/".$fileID.".jpg";
     $path_video = "assets/uploads/audios/".$fileID.".".$audio->fileExt."";
     if (file_exists('assets/'.$audio->file)){
     if (unlink($path_video))
      {
        if (file_exists($path)){
          if (unlink($path))
          {
          $audio->delete();
            echo "accept_ok";
          }
        } else {
           $audio->delete();
            echo "accept_ok";
        }
      }
     }
      }
    
  }
  }

  public function file($fileID){
      $audio = Audios::find($fileID);
      if($audio === null) {
            // There is no User with this ID.
            $status = __d('Audio', 'Audio not found: #{0}', $vidID);

            return Redirect::to('admin/users')->withStatus($status, 'danger');
      } else {
         $downloads = Downloads::where('username', '=', Auth::user()->username)->get();
        if(count($downloads) > 5){
          // There is no User with this ID.
              $status = __d('Audio', 'Your need to Upgrade your account!');

              return Redirect::to('upgrade')->withStatus($status, 'danger');
        } else {
        $download = new Downloads;
        $download->filename = $audio->filename;
        $download->fileID = $fileID;
        $download->username = Auth::user()->username;
        $download->save();
        $audio->fileDownloads = $audio->fileDownloads + 1;
        $audio->save();
        $fileName = resource_url(''.$audio->file.'');
        $downloadFileName = $audio->filename.'.'.$audio->fileExt;
        header('Content-type: audio/mpeg',true,200);
        header('Content-Disposition: attachment; filename="'.$downloadFileName.'"');
        header('Cache-Control: no-transform');
        //header('Content-Length: '.strlen( $fileName ));
        readfile($fileName);
        exit();
        }
    }
  }

  public function playfile($fileID){
     $audio = Audios::find($fileID);
      if($audio === null) {
            // There is no User with this ID.
            $status = __d('Audio', 'Audio not found: #{0}', $vidID);

            return Redirect::to('admin/users')->withStatus($status, 'danger');
      } else {
    $filepath = resource_url(''.$audio->file.'');
     $fileSize=filesize('assets/'.$audio->file);
    if (file_exists('assets/'.$audio->file))
     {
        //header('Content-disposition: inline');
        //header('Content-type: audio/mpeg',true,200);
        header("Content-Transfer-Encoding: binary"); 
        header("Content-Type: audio/mpeg, audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3");
        header('Content-Disposition:: inline; filename="'.$audio->filename.'"');
        header('Content-length: '.$fileSize);
        header('Cache-Control: no-cache');
        header('Accept-Ranges: bytes');
       // header('Content-Length: ' . filesize($filepath));
        /*header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
        header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        header('Content-type: audio/mpeg',true,200);
        header("Content-Disposition: attachment; filename=\"" . $filepath . "\"");
        header("Content-Length: " . $fileSize);*/
        readfile($filepath);

        //exit;
     }
    }
  }

}
?>