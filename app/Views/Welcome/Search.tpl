<md-card class="mat-card">
  <div class="row">
   <div class="col s12 m12">
     {{$status}}
     {{$noresults}}
       @foreach ($searchresults as $search)
       <div class="row searchsite">
           <div class="col s12 m2">
               <md-card class="mat-card">
                  <img class="search-img" src="{{resource_url($search->fileImg)}}" alt="{{$search->filename}}">
               </md-card>
           </div>
           <div class="col s12 m10">
              <div class="search-results">
               <h1>
                   @if ($search->fileType == 'video')
                      <a href="video/{{Str::slug("$search->filename")}}-{{$search->fileID}}"> {{$search->filename}}</a>
                    @endif
                    @if ($search->fileType == 'audio')
                      <a href="audio/{{Str::slug("$search->filename")}}-{{$search->fileID}}"> {{$search->filename}}</a>
                    @endif
                   </h1>
                 @if ($search->fileType !== ' ')<h6>{{substr(strip_tags($search->fileDesc, ENT_QUOTES), 0, 150)}}..</h6> @endif
                <div class="card-action innertube">
                    @if ($search->fileType == 'video')
                    <a href="video/{{Str::slug("$search->filename")}}-{{$search->fileID}}"><i class="material-icons left">face</i> <span class="left">{{$search->fileViews}}</span></a>
                    @endif
                    @if ($search->fileType == 'audio')
                    <a href="audio/{{Str::slug("$search->filename")}}-{{$search->fileID}}"><i class="material-icons left">face</i> <span class="left">{{$search->fileViews}}</span></a>
                    @endif
                    
                </div>
                <div><br><h6>{{$search->fileType}}</h6></div>
            </div>
           </div>
       </div>
          @endforeach
       
     </div>
  </div>
</md-card>