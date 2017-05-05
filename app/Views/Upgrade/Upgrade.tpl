<div class="row">
  <div class="col s12 m12 text-center">
  <h1 class="title cyan-text "> Upgrade Your Account!</h1>
    {{$welcomeMessage}}
    <div style="margin-left:auto; margin-right: auto; margin-top: 10px;">
     
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="hosted_button_id" value="Y5TFUMGVBKX3A">
      <input type="hidden" name="item_name" value="{{Auth::user()->username}} - Weytindey Annual Subscription">
      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
      <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
      </form>


    </div>
  </div>

</div>