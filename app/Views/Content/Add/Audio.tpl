<div class="addcontent">

 <md-card class="mat-card">
 <div class="icon-header color-primary"><i aria-hidden="true" class="fa fa-video-camera fa-5x" aria-hidden="true"></i></div>
  <h1>Click Below to Upload Audio File!</h1>
  <div id='preview'></div>
  <div class="status"></div>
  <form id="audio_upload_form" method="post" enctype="multipart/form-data"  
       autocomplete="off"
       action='{{site_url('add/store') }}'
    >
  <input type="file" name="file-b" id="file-b"   style="display:none;" accept="audio/*">
   <div class="color-gray upload"><label for="file-b"><i aria-hidden="true" class="material-icons">file_upload</i></label></div>
 </form>
  <ul class="collection">
    <li class="collection-item avatar">
      <a href="{{site_url('add/video')}}"><i aria-hidden="true" class="material-icons circle">folder</i>
      <span class="title color-primary">Share Social Video</span>
      <p>Share your social videos online fast and easy.
      </p>
      
      </a>
    </li>
    <li class="collection-item avatar">
    <a href="{{site_url('add/blog')}}">
    <i aria-hidden="true" class="material-icons circle green">insert_chart</i>
      <span class="title">Write a Blog (coming soon...)</span>
      <p>Still working on it! Will be Avaible soon!
      </p>
     </a>
    </li>
  </ul>
  
   </md-card>
  </div>
</div>