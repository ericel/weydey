<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58e3b4b7894cbb0011d5a857&product=sticky-share-buttons"></script>
        <script src="https://content.jwplatform.com/libraries/sjhFF0fP.js"></script>   
 <div class="row">
            <div class="col s12 m8">
                <div id="myElement"></div>
           <md-card class="mat-card audio">
            <div class="side-property">
            <div class="row">
                <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a href="#desc"  class="active">Details</a></li>
                    <li class="tab col s3"><a href="#lyrics">Lyrics</a></li>
                  
                </ul>
                   @if (Auth::check())
                        @if (Auth::user()->username === $audio->username)
                        <a href="{{$editurl}}"> <i aria-hidden="true" class='material-icons right'>edit</i></a>
                        @endif
                    @endif
                </div>
                <div id="desc" class="col s12">
                    <div class="row">
                    <div class="col s12 m8">
                        <hi class="title audio-title"><i aria-hidden="true" class="material-icons left orange-text">title</i> {{$audio->filename}} <span class="views new badge" data-badge-caption="Views">{{$audio->fileViews}}</span></hi>
                         @if (Auth::check())
                           <a class="waves-effect waves-light btn-flat cyan-text" href="{{$download_url}}">Download</a>
                           @else 
                           <a class="waves-effect waves-light btn-flat cyan-text" href="#login">Download</a>
                         @endif
                          <!-- Modal Structure -->
                            <div id="login" class="modal text-center grey darken-3 white-text" style="background-image: url('{{resource_url('images/stardust1.png'); }}">
                                 <div class="modal-content">
                                   <h4>Authentication Needed!</h4>
                                   <p class="red-text">To Download you Need to Login</p>
                                <p>Downloading is easy and simple, however we only accept file downloads from authenticated users. </p>
                                </div>
                                <div class="modal-footer">
                                 <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Stay Here</a>
                                <a href="{{site_url('login')}}" class="modal-action modal-close waves-effect waves-green btn-flat cyan-text">Login Now</a>
                                </div>
                            </div>
                    </div>
                        <div class="col s12 m4">
                            <i aria-hidden="true" class="material-icons left orange-text">schedule</i> {{$audio->created_at}}
                            <div>
                            
                            </div>
                        </div>
                <div class=" col s12 m12 ">
                 <div class="hide-on-large-only">
           
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
                    </div>
            <div class="col s12 m12">
             <div class="details audio-description"><i aria-hidden="true" class="material-icons left orange-text">description</i>
             About {{$audio->filename}}
              <div> {{substr(strip_tags($audio->fileDesc, ENT_QUOTES), 0, 100)}}</div>
              </div>
            </div>
            
           </div>
                <div id="lyrics" class="col s12">
                    <div> {{$audio->fileLyrics}}</div>
                </div>
            </div></div>
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
                            <input type="hidden" name="file-ID" id="file-ID" value="{{$audio->fileID}}">
                        </div>
                        <div class="col s12 m12">
                            <button type="submit"  id="commentBtn" class="right btn-flat waves-effect waves-light white cyan-text" name="submit">Post comment</button>
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
                          <a href="#!" class="secondary-content" onclick="ajax_post({{$comment->id}})"><i aria-hidden="true" class="material-icons tiny red-text">close</i></a>
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
            <div class="card collection">
                <h1 class="collection-item"><i aria-hidden="true" class="material-icons">queue_music</i> More Like <span class="cyan-text">{{$audio->filename}}</span></h1>
                <div>
                <small class="left auto">
                    <em class="gray-text"> Enable autoplay</em>
                </small>
                   <div class="switch right pulse">
                     <label>
                        <input id="autoplay" type="checkbox" checked>
                        <span class="lever"></span>
                        </label>
                    </div>
                    <div class="clearfix"></div>
                </div>
                    @foreach ($audioslike as $audiolike)
                            <a href="/audio/{{Str::slug("$audiolike->filename")}}-{{$audiolike->fileID}}" class="collection-item autotoplay " ><span class="new badge orange darken-1" data-badge-caption="Listening">{{$audiolike->fileViews}}</span><i aria-hidden="true" class="material-icons">audiotrack</i> {{$audiolike->filename}}</a>

                    @endforeach
                 
            </div>
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
            <div class="card collection">
                <h1 class="collection-item"><i aria-hidden="true" class="material-icons">ic_queue_music</i> Listening now</h1>
                    @foreach ($audiospopular as $audiop)
                            <a href="/audio/{{Str::slug("$audiop->filename")}}-{{$audiop->fileID}}" class="collection-item"><span class="new badge orange darken-1" data-badge-caption="Listening">{{$audiop->fileViews}}</span><i aria-hidden="true" class="material-icons">audiotrack</i> {{$audiop->filename}}</a>
                    @endforeach
            </div>
             @foreach ($videosrated as $videorated)
            <div class="card">
                    <div class="card-image ">
                    <img class="activator" src="{{resource_url($videorated->fileImg)}}">
                    <span class="card-title activator">{{substr($videorated->filename, 0, 50)}}</span>
                    <a class="btn-floating halfway-fab waves-effect waves-light red" href="/video/{{Str::slug("$videorated->filename")}}-{{$videorated->fileID}}"><i aria-hidden="true" class="material-icons">play_arrow</i></a>
                    </div>
                    <div class="card-content">
                    <p>{{ucfirst(strtolower(substr(strip_tags($videorated->fileDesc, ENT_QUOTES), 0, 50)))}}..</p>
                    </div>
                    <div class="card-action">
                    <a href="/video/{{Str::slug("$videorated->filename")}}-{{$videorated->fileID}}"><i aria-hidden="true" class="material-icons left">link</i> <span class="left"><!--{{$videorated->rating}}--></span></a>
                    <a href="/video/{{Str::slug("$videorated->filename")}}-{{$videorated->fileID}}"><i aria-hidden="true" class="material-icons right">face</i> <span class="right">{{$videorated->fileViews}}</span></a>
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

<script type="text/javascript">
var playerInstance=jwplayer("myElement");playerInstance.setup({image:"{{resource_url($audio->fileImg)}}",file:"/play/file/{{$audio->fileID}}/.file",type:"mp3",
events:{
        onComplete: function() {
         if(document.getElementById('autoplay').checked)
           {
               var x = document.getElementsByClassName("autotoplay");
               x[0] = x[0].getAttribute('href');
               window.location = x[0];
          }
        }
    },
});

</script> 