$(document).ready(function(){
    $("#realname").focus(function() {
         checkRealName();
    });
  function checkRealName(){
         $("#realname").keyup(function() {
             var realname = $("#realname").val();
             if(realname.length < 6){
                $("#realname1").html('<div class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Name And Surname Must be at least 6 characters long in the format "John Doe"!</div>');
             }
             if(realname.length > 6){
                   var reg = /\d/;
                   if(!reg.test(realname)){
                       var split = realname.split(" ");
                        if(split[1].length > 2){
                            $("#realname1").html('<div class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i> Name And Surname is okay!</div>');
                        }
                        if(split[1].length < 2) {
                            $("#realname1").html('<div class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Name And Surname should be at least 2 words!</div>');
                        }
                   } else {
                       $("#realname1").html('<div class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Name And Surname does not accept numbers!</div>');
                   }
             }
     });
  }

    $("#username").focus(function() {
          $("#username").keyup(function() {
             var username = $("#username").val();
             if(username.length < 6){
                $("#username1").html('<div class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Username Must be at least 6 characters long!</div>');
             }
             if(username.length > 6){
                $("#username1").html('<div class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i> Username Ok!</div>');
             }
          });
    });

       $("#password").focus(function() {
          $("#password").keyup(function() {
             var password = $("#password").val();
             var alNumMin8 = (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/);
             if(password.length < 8){
                $("#password1").html('<div class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Password Must be at least 8 characters long with at least one Uppercase character and a at leats 1 number!</div>');
             }else{
                 var reg = /\d/;
                 var regUp = /[A-Z]/;
                 var regDown = /[a-z]/;
                 if(!reg.test(password)){
                  $("#password1").html('<div class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Atleast one number is needed!</div>');
                } else if (!regUp.test(password)){
                    $("#password1").html('<div class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Atleast one Uppercase Letter is needed!</div>');
                } else if (!regDown.test(password)){
                    $("#password1").html('<div class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Atleast one Lowercase Letter is needed!</div>');
                }
                else{
                     $("#password1").html('<div class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i> Password seems good enough!</div>');
                }
             }
             
          });
    });

      $("#password_confirmation").focus(function() {
          $("#password_confirmation").keyup(function() {
             var password = $("#password").val();
             var password1 = $("#password_confirmation").val();
             if(password !== password1){
                $("#password2").html('<div class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Passwords Do not Match!</div>');
             } else {
                $("#password2").html('<div class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i> Password seems good enough!</div>');
             }
          });
    });

     $("#email").focus(function() {
         var regEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          $("#email").keyup(function() {
             var email = $("#email").val();
             if(!email.match(regEmail)){
                $("#email1").html('<div class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Invalid Email</div>');
             }else {
                $("#email1").html('<div class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i> Email is good!</div>');
             }
          });
    });

$('.statistic-counter').counterUp({
                delay: 10,
                time: 2000
 });
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

function restrict(elem){
	var tf = document.getElementById(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}

function checkusername(){
	var u = document.getElementById("username").value;
	if(u != ""){
		document.getElementById("username1").innerHTML = '<div class="red-text">checking if available...</div>';
		var ajax = ajaxObj("POST", "register/checkusername");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	           document.getElementById("username1").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("usernamecheck="+u);
	}
}

