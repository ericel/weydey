<div class="row">
  <div class="col s12 m8">
  <h1 class="title cyan-text"> Contact Us</h1>
    <div class="row">
    <form class="col s12" id="contactFormfile"
    method="POST"  
    autocomplete="off"
    action="{{site_url('contact/send')}}" 
    >
      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">account_circle</i>
          <input id="name" name="name" type="text" class="validate">
          <label for="name">Full Name</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">email</i>
          <input id="email" name="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
      <div class="input-field col s12">
      <i class="material-icons prefix">playlist_add_check</i>
        <select name="inquiry_type" id="inquiry_type">
          <optgroup label="General Inquiry">
            <option value="General Inquiry">General Inquiry</option>
            <option value="Advertise With Us">Advertise With Us</option>
          </optgroup>
          <optgroup label="Report Copyright">
            <option value="Video Illegal Upload">Video Illegal Upload</option>
            <option value="Audio Illegal Upload">Audio Illegal Upload</option>
          </optgroup>
        </select>
        <label>Optgroups</label>
      </div>
      </div>
      <div class="row">
      
        <div class="input-field col s12">
        <i class="material-icons prefix">message</i>
          <textarea id="message" name="message" class="materialize-textarea"></textarea>
          <label for="message">What's your inquiry?</label>
        </div>
      </div>
       <div id="contactStatus"></div>
       <button type="submit" name="submit" id="contactBtn" class="btn right cyan darken-3">Contact Us</button>
    </form>
  </div>
  </div>
  <div class="col s12 m4">
    <ul class="menu">
     <li><a href="{{ site_url() }}">Home</a></li>
     <li><a href="{{ site_url('about') }}">About Us</a></li>
     <li><a href="{{ site_url('about/dmca') }}">DMCA</a></li>
     <li><a href="{{ site_url('about/terms') }}">Terms of Use</a></li>
    </ul>
  </div>
</div>