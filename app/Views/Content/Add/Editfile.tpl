<script src="{{resource_url('js/nicEdit-latest.js')}}" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
  bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('file-lyrics');
  });
  //]]>

  //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
</script>
<div class="addcontent">

 <md-card class="mat-card">
 <div id="infoform"  class="mar-15 row">
       <div class="">
              <div class="large-text red-text">Edit Video</div>
               
                   <form class="col s12" id="editFormfile" method="POST"  
                            autocomplete="off"
                            action="{{site_url('add/updateinline')}}"
                            >
                          <div class="col s12">
                             <div class="input-field col s12">
                                <label for="filename">Filename</label><br>
                                    <input  id="filename" name="filename" type="text" class="validate" value="{{$file->filename}}">
                                </div>
                                <div class="input-field col s12">
                                <label for="vid-desc">File Description</label><br>
                                    <textarea id="file-desc" name="file-desc" class="materialize-textarea">{{$file->fileDesc}}</textarea>
                                    
                                </div>
                                  <input type="hidden" name="file-ID" id="file-ID" value="{{$file->fileID}}">
                                  <input type="hidden" name="file-type" id="file-type" value="{{$fileType}}"> 
                                  @if ($fileType  === 'audio')
                                  <div class="input-field col s12">
                                <label for="file-lyrics">Song Lyrics</label><br><br>
                                    <textarea id="file-lyrics" name="file-lyrics" class="materialize-textarea">{{$file->fileLyrics}}</textarea>
                                    
                                </div>
                                  @endif
                                <div id="updateContent"></div>
                                <button type="submit" id="updateBtn" class="btn btn-primary" name="submit">Edit File</button>
                                </div>
     </form>
  <div class="clearfix"></div>
 </div>
</div>
</md-card>

<md-card class="mat-card">
  <h1>Update Video Image</h1>
    <div id='preview'></div>
  <div class="status"></div>
  <form id="image_upload_form-update" method="post" enctype="multipart/form-data"  
       autocomplete="off"
       action='{{site_url('add/updatevideoimg') }}'
    >
  <input type="file" name="image" id="image"   style="display:none;" >
   <div class="color-gray upload"><label for="image"><i class="material-icons">file_upload</i></label></div>
   <input type="hidden" name="file-type" id="file-type" value="{{$fileType}}">
   <input type="hidden" name="file-ID" id="file-ID" value="{{$file->fileID}}">
 </form>
</md-card>
</div>