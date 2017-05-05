<div class="row content">
    <div class="col s12 m8">
       <div class="row home">
       @foreach ($videos as $video)
        <div class="col s12 m4" id="file_{{$video->fileID}}">
            <div class="card">
                
                <div class="card-image ">
                <a class='dropdown-button' href='#' data-activates='dropdown-{{$video->fileID}}'><i aria-hidden="true" class="material-icons">more_vert</i></a>
                <!-- Dropdown Structure -->
                <ul id='dropdown-{{$video->fileID}}' class='dropdown-content'>
                    
                    @if (Auth::check())
                    <li><a href=""><i aria-hidden="true" class="material-icons">save</i> Save Video</a></li>
                    @if (Auth::user()->username === $video->username)
                    <li><a href="/edit/video/{{Str::slug("$video->filename")}}-{{$video->fileID}}" ><i aria-hidden="true" class="material-icons">edit</i> Edit</a></li>
                    <li id="deletefile_{{$video->fileID}}"><a  onclick="deleteFile('{{$video->fileID}}','{{$video->fileType}}')"><i aria-hidden="true" class="material-icons">delete_forever</i> Delete</a></li>
                    @endif
                    @else
                     <li><a href="/login" ><i aria-hidden="true" class="material-icons">lock_open</i> log in</a></li>
                    @endif
                    <div class="divider"></div>
                    <li><a href="#modal-{{$video->fileID}}" ><i aria-hidden="true" class="material-icons">expand_more</i> More</a></li>
                </ul>
                <!-- Modal Structure -->
                <!-- Modal Structure -->
                <div id="modal-{{$video->fileID}}" class="modal bottom-sheet">
                    <div class="modal-content">
                        <div class="container">
                        <div class="row">
                             <div class="col s12 m4">
                                 <h1 class="cyan-text">Video Information: </h1>
                                 <h1 class="title green-text">Title: {{$video->filename}}</h1>
                                 <p class="description">Description: {{$video->fileDesc}}</p>
                                 <time>Shared on: {{$video->created_at}}</time>
                                 <div><author>Shared by: {{$video->username}}</author></div>
                             </div>
                              <div class="col s12 m4">
                                 <div class="page-views"> <i aria-hidden="true" class="material-icons orange-text">face</i> <span class="badge">{{$video->fileViews}} views</span></div>
                                 <div class="martop-30"></div>
                                 <div class="page-rating rating"> <i aria-hidden="true" class="material-icons cyan-text">favorite</i> <span class="badge">{{$video->rating}} votes</span></div>
                               
                             </div>
                              <div class="col s12 m4">
                                  
                             </div>
                        </div>
                        </div>
                    </div>
                </div>
                <img class="activator materialboxed" src="{{resource_url($video->fileImg)}}">
                <span class="card-title activator"><span class="title card-name"><a class="white-text" href="/video/{{Str::slug("$video->filename")}}-{{$video->fileID}}">{{substr($video->filename, 0, 50)}}</a></span></span>
                <a class="btn-floating halfway-fab waves-effect waves-light red" href="/video/{{Str::slug("$video->filename")}}-{{$video->fileID}}"><i aria-hidden="true" class="material-icons">play_arrow</i></a>
                </div>
                <div class="card-content">
                <p>{{ ucfirst(strtolower(substr(strip_tags($video->fileDesc, ENT_QUOTES), 0, 50)))}}..</p>
                </div>
                <div class="card-action">
                <a href="/video/{{Str::slug("$video->filename")}}-{{$video->fileID}}"><i aria-hidden="true" class="material-icons left">link</i> <span class="left"><!--{{$video->rating}}--></span></a>
                <a href="/video/{{Str::slug("$video->filename")}}-{{$video->fileID}}"><i aria-hidden="true" class="material-icons right">face</i> <span class="right">{{$video->fileViews}}</span></a>
                </div>
            </div>
             
        </div>
        @endforeach

        {{$videos->links()}}

       </div>
    


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
         <div class="card collection">
            <h1 class="collection-item"><i aria-hidden="true" class="material-icons">queue_music</i> Listening now</h1>
          @foreach ($audios as $audio)
                <a href="audio/{{Str::slug("$audio->filename")}}-{{$audio->fileID}}" class="collection-item"><span class="new badge" data-badge-caption="Listening">{{$audio->fileViews}}</span><i aria-hidden="true" class="material-icons">audiotrack</i> {{$audio->filename}}</a>
          @endforeach
           </div>
        @foreach ($videosrated as $videorated)
            <div class="card">
                    <div class="card-image ">
                    <img class="activator" src="{{resource_url($videorated->fileImg)}}">
                    <span class="card-title activator">{{substr($videorated->filename, 0, 50)}}</span>
                    <a class="btn-floating halfway-fab waves-effect waves-light red" href="video/{{Str::slug("$videorated->filename")}}-{{$videorated->fileID}}"><i aria-hidden="true" class="material-icons">play_arrow</i></a>
                    </div>
                    <div class="card-content">
                    <p>{{substr(strip_tags($videorated->fileDesc, ENT_QUOTES), 0, 50)}}..</p>
                    </div>
                    <div class="card-action">
                    <a href="video/{{Str::slug("$videorated->filename")}}-{{$videorated->fileID}}"><i aria-hidden="true" class="material-icons left">link</i> <span class="left"><!--{{$videorated->rating}}--></span></a>
                    <a href="video/{{Str::slug("$videorated->filename")}}-{{$videorated->fileID}}"><i aria-hidden="true" class="material-icons right">face</i> <span class="right">{{$videorated->fileViews}}</span></a>
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
      <md-card class="mat-card">
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- anotherAds -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-2243338195594977"
                data-ad-slot="8059130774"
                data-ad-format="auto"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
      </md-card>
    </div>
</div>
