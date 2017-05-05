/*!
 * IE10 viewport hack for Surface/desktop Windows 8 bug
 * Copyright 2014-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

// See the Getting Started docs for more information:


$(document).ready(function(){
  $('.button-collapse').sideNav({
      menuWidth: 300, // Default is 300
      edge: 'left', // Choose the horizontal origin
      closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true // Choose whether you can drag to open on touch screens
    }
  );
  $('.collapsible').collapsible();
   $('select').material_select();
  $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrainWidth: false, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: false, // Displays dropdown below the button
      alignment: 'right', // Displays dropdown with edge aligned to the left of button
      stopPropagation: false // Stops event propagation
    }
  );
//image media effect
$( ".togglesearch" ).click(function() {
  $( ".m-search" ).toggle( );
  if($('.m-search').css('display') != 'none')
  {
      $(".togglesearch").html("close");
  } else{
    $(".togglesearch").html("search");
  }
 
});

   $('.materialboxed').materialbox();
// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
  $('.modal').modal();
  $('ul.tabs').tabs();
      var submitIcon = $('.searchbox-icon');
       var inputBox = $('.searchbox-input');
            var searchBox = $('.searchbox');
            var isOpen = false;
            submitIcon.click(function(){
                if(isOpen == false){
                    searchBox.addClass('searchbox-open');
                    inputBox.focus();
                    isOpen = true;
                } else {
                    searchBox.removeClass('searchbox-open');
                    inputBox.focusout();
                    isOpen = false;
                }
            });  
             submitIcon.mouseup(function(){
                    return false;
                });
      searchBox.mouseup(function(){
          return false;
     });
      $(document).mouseup(function(){
        if(isOpen == true){
            $('.searchbox-icon').css('display','block');
              submitIcon.click();
       }
    });

function buttonUp(){
     var inputVal = $('.searchbox-input').val();
     inputVal = $.trim(inputVal).length;
     if( inputVal !== 0){
     $('.searchbox-icon').css('display','none');
      } else {
      $('.searchbox-input').val('');
       $('.searchbox-icon').css('display','block');
      }
}
    
/*$(function() {
     $(".file-content").hide();
     $("#file-b").change(function (){
       var fileName = ($('#file-b')[0].files[0].name).replace(/\.[^/.]+$/, "");
       $(".filename").val(fileName);
       $(".file-desc").html(fileName);
       $(".file-content").show();
     });
});*/

 function countdown(){
   var i = 25;
     var myinterval = setInterval(() => {
        document.getElementById("countdown").innerHTML = "" + i + "";
        if (i === 0) {
            clearInterval(myinterval );
            return;
        }
        else {
            i--;
        }
    }, 1000);
     return;
  }

    $('#video_upload_form #file-b').on('change', function() {
    $('.collection').hide();
   // countdown();
    $('.status').html('<div class="large-text alert red lighten-1 white-text"> Please Wait, Video Uploading....</div>');
    $("#preview").html('');
    $("#preview").html('  <div class="progress"><div class="indeterminate"></div></div>');
    $("#video_upload_form").ajaxForm({
    target: '#preview',
    success:       showResponse  // post-submit callback 
   }).submit();
    
  });
 

function showResponse(){
   //$(window).scrollTop($('.progress').offset().top);
  $("#infoform").hide();
  $("video").prop("volume", 0.0);
  var video = $("#jquery_jplayer_1").find("video")[0];
      if ( video.paused ) {
           video.play()
           countdown();
           $('.status').html('<div class="large-text alert red lighten-1 white-text"><div id="countdown"></div> Still, Video processing....</div>');
      }
//if ($("#videoThis").length) {
 //if($("video").prop("currentTime", 30)){
    setTimeout(
    function() 
    {
      var video = $("#jquery_jplayer_1").find("video")[0];
      if ( video.paused ) {
           video.play()
      }
      //video.setAttribute('crossOrigin', 'anonymous');
      var canvas = document.createElement('canvas');
      canvas.width = 640;
      canvas.height = 480;
      var context = canvas.getContext('2d');
      context.drawImage(video, 0, 0, canvas.width, canvas.height);
      var dataURI = canvas.toDataURL('image/jpeg');
      //$('#img1').attr("src", dataURI);
      $('#image-ID').val(dataURI);
      $('.status').html('<div class="large-text cyan lighten-1 white-text"">Processing Done: Go ahead and click above to add your video!</div>');
      $("#infoform").show();
      $("#video_upload_form").hide();
    }, 25000);

 // }
//}

}

  $('#audio_upload_form #file-b').on('change', function() {
    $('.collection').hide();
    $('.status').html('<div class="large-text alert red lighten-1 white-text"> Please Wait, Audio Uploading....</div>');
    $("#preview").html('');
    $("#preview").html('  <div class="progress"><div class="indeterminate"></div></div>');
    $("#audio_upload_form").ajaxForm({
    target: '#preview',
    success:       showResponsea  
   }).submit();
    
  });
 

function showResponsea(){
  $("#infoform").hide();
  $("audio").prop("volume", 0.0);
    setTimeout(
    function() 
    {
      var audio = $("#jquery_jplayer_1").find("audio")[0];
      if ( audio.paused ) {
           audio.play()
      }

      $('.status').html('<div class="large-text cyan lighten-1 white-text"">Processing Done: Go ahead and click above to add your audio!</div>');
      $("#infoform").show();
      $("#audio_upload_form").hide();
    }, 5000);
}

$("#updateBtn").click( function(){
  $("#updateContent").html('  <div class="progress"><div class="indeterminate"></div></div>');
    $("#editFormfile").ajaxForm({
          target: '#updateContent',
          success:       showUpdate  // post-submit callback 
        }).submit();
    });
function showUpdate(responseText, statusText, xhr, $form){
   $("#updateContent").html(responseText);
}

$('#image').on('change', function() {
    $("#preview").html('<div class="large-text red-text"> Please Wait, image processing....</div>');
    $("#preview").html('  <div class="progress"><div class="indeterminate"></div></div>');
    $("#image_upload_form-update").ajaxForm({
    target: '#preview',
   }).submit();
    
});

$("#downloadBtn").click( function(){
  $("#downloadstatus").html('  <div class="progress"><div class="indeterminate"></div></div>');
    $("#downloadFormfile").ajaxForm({
          target: '#downloadstatus',
          success:       showDownload  // post-submit callback 
        }).submit();
    });
function showDownload(responseText, statusText, xhr, $form){
   $("#downloadstatus").html(responseText);
}

$("#commentBtn").click( function(){
  $("#commentStatus").html('  <div class="progress"><div class="indeterminate"></div></div>');
    $("#commentForm").ajaxForm({
          target: '#commentStatus',
          success:       showComment,
          clearForm: true

        }).submit();
    });
function showComment(responseText, statusText, xhr, $form){
   $("#commentStatus").html(responseText);
}

$("#contactBtn").click( function(){
  $("#contactStatus").html('  <div class="progress"><div class="indeterminate"></div></div>');
    $("#contactFormfile").ajaxForm({
          target: '#contactStatus',
          success:       showContact,
          clearForm: true
        }).submit();
    });
function showContact(responseText, statusText, xhr, $form){
   $("#contactStatus").html(responseText);
}
});
function ajaxObj( meth, url ) {
  var x = new XMLHttpRequest();
  x.open( meth, url, true );
  x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  return x;
}
function ajaxReturn(x){
  if(x.readyState == 4 && x.status == 200){
      return true;  
  }
}
function ajax_post(id){
  var conf = confirm("Press OK to confirm to delete comment");
	if(conf != true){
		return false;
	}
  document.getElementById("deletestatus_"+id).innerHTML = "processing ...";
	var ajax = ajaxObj("POST", "/add/deletecomment");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			if(ajax.responseText == "accept_ok"){
				document.getElementById("deletestatus_"+id).innerHTML = "Deleted";
        document.getElementById("comment_"+id).style.display = "none";
			} else if(ajax.responseText == "reject_ok"){
				document.getElementById("deletestatus_"+id).innerHTML = "Cannot delete, this is not your comment!";
			} else {
				document.getElementById("deletestatus_"+id).innerHTML = ajax.responseText;
			}
		}
	}
	ajax.send("deleteID="+id);

}

function deleteFile(id, fileType){
  var conf = confirm("Press OK to confirm to delete file");
	if(conf != true){
		return false;
	} 
 document.getElementById("deletefile_"+id).innerHTML = "processing ...";
	var ajax = ajaxObj("POST", "/add/delete");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			if(ajax.responseText == "accept_ok"){
				document.getElementById("deletefile_"+id).innerHTML = "Deleted";
        document.getElementById("file_"+id).style.display = "none";
			} else if(ajax.responseText == "reject_ok"){
				document.getElementById("deletefile_"+id).innerHTML = "Cannot delete, this is not your file!";
			} else {
				document.getElementById("deletefile_"+id).innerHTML = ajax.responseText;
			}
		}
	}
	ajax.send("deleteID="+id+"&fileType="+fileType);
}
