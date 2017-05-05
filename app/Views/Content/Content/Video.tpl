<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58e3b4b7894cbb0011d5a857&product=sticky-share-buttons"></script>
 <div class="row">
            <div class="col s12 m8">
            <div id="myElement"></div>
            <md-card class="mat-card video">
            <div itemscope itemtype="http://schema.org/Movie" class="video-details row">
            <div class="col s12 m8">
                <img itemprop="image" class="avatar-image left" src="{{resource_url($video->fileImg)}}">
                <hi class="title video-title"><i aria-hidden="true" class="material-icons left orange-text">title</i> <span itemprop="name">{{$video->filename}}</span> <span class="views new badge" data-badge-caption="Views">{{$video->fileViews}}</span></hi>
            </div>
                <div class="col s12 m4">
                    <i aria-hidden="true" class="material-icons left orange-text">schedule</i> <span itemprop="datePublished" content="{{$video->created_at}}">{{$video->created_at}}</span>
                </div>
                <div class=" col s12 m12 ">
                    <div class="hide-on-large-only adslot">
    
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- blogle -->
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-2243338195594977"
                        data-ad-slot="7581452770"
                        data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                   
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- responUnit -->
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-2243338195594977"
                        data-ad-slot="7979162777"
                        data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
 
                    </div>
                </div>
            <div class="col s12 m12">
             <div class="details video-description"><i aria-hidden="true" class="material-icons left orange-text">description</i> {{$video->fileDesc}}</div>
            </div>
            </div>
             <div class="comments clearfix">
                <form id="commentForm"
                method="POST"  
                autocomplete="off"
                action="{{site_url('add/comment')}}">
                    <div class="row">
                        <div class="col s12 m12">
                             <div class="input-field col s12">
                                <textarea id="comment" name="comment" class="materialize-textarea"></textarea>
                                <label for="textarea1">Enter a comment</label>
                               </div>
                            <input type="hidden" name="file-ID" id="file-ID" value="{{$video->fileID}}">
                        </div>
                        <div class="col s12 m12">
                            <button type="submit"  id="commentBtn" class="right btn-flat waves-effect waves-light white grey-text" name="submit">Post comment</button>
                        </div>
                     </div>
                </form>
                <div class="clearfix"></div>
                <div class="added-comments">
                 All Comments ({{count($comments)}}+) 
                 <ul class="collection">
                    <div id="commentStatus"></div>
                    @foreach ($comments as $comment)
                    <li class="collection-item avatar" id="comment_{{$comment->id}}">
                     @if ($comment->image == '')
                    <img src="{{resource_url('images/users/no-image.png')}}" alt="{{ucfirst($comment->username)}}" class="circle">
                    @else
                    <img src="{{str_replace(ROOTDIR, '/', $comment->image)}}" alt="{{ucfirst($comment->username)}}" class="circle">
                    @endif
                    <span class="title"><a href="#!">{{ucfirst($comment->username)}}</a></span> Commented: <time>{{$comment->created_at}}</time>
                    <p>{{$comment->fileComment}}</p>
                    @if (Auth::check())
                        @if (Auth::user()->username === $comment->username)
                        <span id="deletestatus_{{$comment->id}}"></span>
                          <a href="#!" class="secondary-content" onclick="ajax_post({{$comment->id}})"><i aria-hidden="true" class="material-icons tiny gray-text">close</i></a>
                        @endif
                      @endif
                    </li>
                     @endforeach
                
                </ul>
                <div class="right">{{$comments->links()}}</div>
                <div class="clearfix"></div>
                </div>
            </div>
            
            <div class="hide-on-med-and-down">
               
                     <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- blogle -->
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-2243338195594977"
                        data-ad-slot="7581452770"
                        data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                
            <div class="row">

                <div class="col s4">
                   <div class="center promo promo-example">
                        <i class="material-icons" aria-hidden="true">audiotrack</i>
                        <p class="promo-caption">Share Music</p>
                        <p class="light center">Weytindey music let's it's users share and even sell their music online. The best of Afro music, downloads and lyrics of your best artist available.</p>
                    </div>
                </div>
                <div class="col s4">
                    <div class="center promo promo-example">
                        <i class="material-icons" aria-hidden="true">ondemand_video</i>
                        <p class="promo-caption">Social Videos</p>
                        <p class="light center">Watch social videos, all in one place. Short funny, day to day videos contributted by service users. Start sharing with us.Social videos of all kinds. We share what ever we can lay our hands on.</p>
                    </div>
                </div>
                <div class="col s4">
                    <div class="center promo promo-example">
                        <i class=" material-icons" aria-hidden="true">verified_user</i>
                        <p class="promo-caption">Contributors</p>
                        <p class="light center">We provide legal copyright owners with the ability to self-publish on the Internet by uploading, storing and displaying various types of media.</p>
                    </div>
                </div>

                </div>
                 </div>
            </md-card>
        
            </div>
            <div class="col s12 m4">
            
            <md-card class="mat-card">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- responUnit -->
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-2243338195594977"
                        data-ad-slot="7979162777"
                        data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
            </md-card>
        
      @foreach ($videospopular as $videop)
       
            <div class="card horizontal small h-card">
            <div class="card-image">
                <img src="{{resource_url($videop->fileImg)}}">
            </div>
            <div class="card-stacked">
                <div class="card-content">
                   <a class="grey-text white" href="/video/{{Str::slug("$videop->filename")}}-{{$videop->fileID}}">{{ucfirst(strtolower(substr(strip_tags($videop->filename, ENT_QUOTES), 0, 100)))}}</a>
                <p>{{ucfirst(strtolower(substr(strip_tags($videop->filename, ENT_QUOTES), 0, 20)))}}..</p>
                </div>
                <div class="card-action">
                <a class="cyan white-text" href="/video/{{Str::slug("$videop->filename")}}-{{$videop->fileID}}">Watch Now</a>
                </div>
            </div>
            </div>
        
     
        @endforeach
     
          
            <md-card class="mat-card">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- blogle -->
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-2243338195594977"
                        data-ad-slot="7581452770"
                        data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
            </md-card>
            </div>
        </div>
<script src="https://content.jwplatform.com/libraries/RpYFdGm7.js"></script>
<script type="text/javascript">
var playerInstance = jwplayer("myElement");
playerInstance.setup({
   'image': '{{resource_url($video->fileImg)}}',
    file: "{{resource_url($video->file)}}",
    /*skin: {
  	name: 'custom',
		url: '{{resource_url('css/jwplayer.css')}}'
  }*/

});
</script>     
