  <footer class="page-footer grey darken-4">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <img src='<?= theme_url('images/logo.png', 'Bootstrap'); ?>' alt='<?= Config::get('app.name', SITETITLE); ?>'>
          <p class="grey-text text-lighten-4">We are just a team of like minded people with love for motherland. We are trying to make information about Africa easily available</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Meet Us</h5>
          <ul>
            <li><a class="white-text" href="<?= site_url('about') ?>">About Us</a></li>
            <li><a class="white-text" href="<?= site_url('contact') ?>">Contact Us</a></li>
            <li><a class="white-text" href="<?= site_url('contact') ?>">Advertise with Us</a></li>
            <li><a class="white-text" href="<?= site_url('contact') ?>">Join Our Team</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Terms Of Service</h5>
          <ul>
            <li><a class="white-text" href="<?= site_url('about/terms') ?>">Terms of Use</a></li>
            <li><a class="white-text" href="<?= site_url('about/terms') ?>">Terms Of Service</a></li>
            <li><a class="white-text" href="<?= site_url('add') ?>">Sharing With Us</a></li>
            <li><a class="white-text" href="<?= site_url('about/dmca') ?>">DMCA</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
          <div class="row">
          <div class="col s12 m6">
          Copyright &copy; <?php echo date('Y'); ?> <a href="https://www.weytindey.com/" target="_blank"><b class="white-text">Weytindey </b></a>
        </div>
        <div class="col s12 m6 white-text">
          <ul class="language">
           @foreach (Config::get('languages') as $code => $info)
                        <li {{ ($code == Language::code()) ? 'class="active"' : ''; }}>
                            <a href='{{ site_url('language/' .$code) }}' title='{{ $info['info'] }}'>{{ $info['name'] }}</a>
                        </li>
            @endforeach
          </ul>
        </div>
        </div>
      </div>
    </div>
  </footer>