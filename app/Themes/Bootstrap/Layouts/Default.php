<?php
/**
 * Default Layout - a Layout similar with the classic Header and Footer files.
 */

$siteName = Config::get('app.name', SITETITLE);
// Prepare the current User Info.
$user = Auth::user();
if (isset($user->image) && $user->image->exists()) {
    $imageUrl = resource_url('images/users/' .basename($user->image->path));
} else {
    $imageUrl = vendor_url('dist/img/avatar5.png', 'almasaeed2010/adminlte');
}

// Generate the Language Changer menu.
$langCode = Language::code();
$langName = Language::name();

$languages = Config::get('languages');

//
ob_start();

foreach ($languages as $code => $info) {
?>
<li <?php if($langCode == $code) echo 'class="active"'; ?>>
    <a href='<?= site_url('language/' .$code); ?>' title='<?= $info['info']; ?>'><?= $info['name']; ?></a>
</li>
<?php
}

$langMenuLinks = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="<?= $langCode; ?>">
<head>
    <head prefix="og:http://ogp.me/ns#">
    <meta charset="utf-8">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
     <!-- Chrome for Android theme color -->
    <meta name="theme-color" content="#212121">
    <meta property="fb:app_id" content="1732300390419025" />
    <meta name="google-site-verification" content="unhV86Cmm4PuFQUvn15Ma1I1HeICrYHklgq8NBehPsc" />
    <meta name="msvalidate.01" content="9D670C9CE0D1E29F2A8424E078051150" />
    <link rel="shortcut icon" href="<?= resource_url('images/favicon.ico'); ?>" type="image/x-icon">
    <title><?= $title .' - ' .Config::get('app.name', SITETITLE); ?></title>
    <meta name="description" content="<?= isset($description) ? substr(str_replace(array("\r", "\n"), '', strip_tags($description, ENT_QUOTES)), 0, 150) : ''; ?>">
    <meta name="keywords" content="<?= isset($keywords) ? substr(str_replace(array("\r", "\n"), '', strip_tags($keywords, ENT_QUOTES)), 0, 150) : ''; ?>">
    <meta property="og:title" content="<?= $title .' - ' .Config::get('app.name', SITETITLE); ?>" />
    <meta property="og:url" content="<?= isset($url) ? $url : ''; ?>" />
    <meta property="og:description" content="<?= isset($description) ? substr(str_replace(array("\r", "\n"), '', strip_tags($description, ENT_QUOTES)), 0, 150) : ''; ?>">
    <meta property="og:site_name" content="<?= strtoupper(Config::get('app.name', SITETITLE)); ?>" />
    <meta property="og:image" content="<?= isset($image) ? $image : ''; ?>" />
    <meta property="og:image:secure_url" content="<?= isset($image) ? $image : ''; ?>" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="640" />
    <meta property="og:image:height" content="480" />
<?php
echo isset($meta) ? $meta : ''; // Place to pass data / plugable hook zone

Assets::css([
    'https://fonts.googleapis.com/icon?family=Material+Icons',
    'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css',
    theme_url('css/style.css', 'Bootstrap')
]);

echo isset($css) ? $css : ''; // Place to pass data / plugable hook zone
?>
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-93578025-1', 'auto');
  ga('send', 'pageview');

</script>
<div class="navbar-fixed">
<nav  style="background-image: url('<?= resource_url('images/stardust1.png'); ?>" class="grey darken-4" role="navigation" >
    <div class="nav-wrapper container"><a id="logo-container" href="<?= site_url(); ?>" class="brand-logo"><img src='<?= theme_url('images/logo_h.png', 'Bootstrap'); ?>' alt='<?= Config::get('app.name', SITETITLE); ?>'></a>
    <ul class="left-flung hide-on-med-and-down">
        <li class="ink"><a href="<?= site_url('videos') ?>"><i class="material-icons">ondemand_video</i>&nbsp; Videos</a></li>
        <li class="ink"><a href="<?= site_url('music') ?>"><i class="material-icons">audiotrack</i> Music</a></li>
    </ul>
      <ul class="right hide-on-med-and-down">
        <li>
            <div class="s-container">
               <form class="searchbox" method="GET" action="<?= site_url('search'); ?>/">
                   <input type="search" placeholder="Enter Search Term" name="search_term" class="searchbox-input" onkeyup="buttonUp();" required>
                     <input type="submit" name="submit" class="searchbox-submit" value="GO">
                    <span class="searchbox-icon"><i class="material-icons">search</i></span>
                  </form>
           </div>
        </li>
        
        <li class="ink"><a href="<?= site_url('add') ?>"><i class="material-icons">add</i> Add</a></li>
         <?php if (Auth::check()) { ?>
           <li class="dropme">
            <a class='dropdown-button' href="<?= site_url('admin/dashboard'); ?>" data-activates='dropdown-menu'> <img class="header-avatar" src="<?= $imageUrl; ?>" alt="<?= Auth::user()->username; ?>"> <?= Auth::user()->username; ?></a>
              <ul id='dropdown-menu' class='dropdown-content'>
            <li><a href='<?= site_url('admin/dashboard'); ?>'><i class="material-icons">face</i> Your Profile</a></li>
            <li><a href="<?= site_url('add/video'); ?>"><i class="material-icons">ondemand_video</i> Add a video</a></li>
            <li><a href="<?= site_url('add/audio'); ?>"><i class="material-icons">audiotrack</i> Share music</a></li>
            <li class="divider"></li>
            <li><a href='<?= site_url('logout'); ?>' class="red-text"><i class="material-icons">remove_circle_outline</i> <?= __d('admin_lite', 'Logout'); ?></a></li>
          </ul>
         </li>
        
           
         <?php } else { ?>
         <li class="ink"><a href="<?= site_url('register') ?>"><i class="material-icons">fingerprint</i> Sign up</a></li>
        <li class="ink"><a href="<?= site_url('login') ?>"><i class="material-icons">lock_open</i> Log in</a></li>
        <?php } ?>
      </ul>
    
 
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>

    </div>
  </nav>

</div>
  <div class="hide-on-large-only search-m">
     <i class="material-icons small togglesearch">search</i>
    <div class="m-search">
     <form class="row" method="GET" action="<?= site_url('search'); ?>/">
        <div class="input-field col s9">
          <input type="search" placeholder="Enter Search Term" name="search_term" class="searchbox-input"  required>
          </div>
        <div class="input-field col s3">
          <button type="submit" name="submit" class="btn-floating btn-large waves-effect waves-light lime"><i class="material-icons">search</i></button>
        </div>
     </form>
     <div class="clearfix"></div>
     </div>
</div>
      
 <ul id="nav-mobile" class="side-nav">
          <li class="header-side"><div class="userView">
              <div class="background">
                <img src="<?= theme_url('images/icon-seamless.png'); ?>">
              </div>
              <a href="<?= site_url() ?>"><img class="circle" src="<?= theme_url('images/logo_h.png'); ?>"></a>
              <a href="<?= site_url() ?>"><span class="white-text name">Weytindey</span></a>
            </div></li>
           <li class="ink"><a href="<?= site_url('add') ?>"><i class="material-icons">add</i> Add</a></li>
         <?php if (Auth::check()) { ?>
         <li>
            <a  href='<?= site_url('admin/dashboard'); ?>'> <img class="header-avatar" src="<?= $imageUrl; ?>" alt="<?= Auth::user()->username; ?>"> <?= Auth::user()->username; ?></a>
         </li>
         <li class="ink">
           <a href='<?= site_url('logout'); ?>'><i class="material-icons">remove_circle_outline</i> <?= __d('admin_lite', 'Logout'); ?></a>
         </li>
         <?php } else { ?>
         <li class="ink"><a href="<?= site_url('register') ?>"><i class="material-icons">fingerprint</i> Sign up</a></li>
        <li class="ink"><a href="<?= site_url('login') ?>"><i class="material-icons">lock_open</i> Log in</a></li>
        <?php } ?>
            <li><div class="divider"></div></li>
            <li><a class="subheader">Sub Menu</a></li>
            <li><a class="waves-effect" href="<?= site_url('about') ?>">About Us</a></li>
            <li><a class="waves-effectt" href="<?= site_url('contact') ?>">Contact Us</a></li>
            <li><a class="waves-effect" href="<?= site_url('contact') ?>">Advertise with Us</a></li>
            <li><a class="waves-effect" href="<?= site_url('contact') ?>">Join Our Team</a></li>
            <li><div class="divider"></div></li>
            <li><a class="subheader">Language</a></li>
            <?= $langMenuLinks; ?>

            
    </ul>
     

<?= isset($afterBody) ? $afterBody : ''; // Place to pass data / plugable hook zone ?>
  <div class="container">
    <div class="section main">
       <?= $content ?>
    </div>
  </div>

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
            <?= $langMenuLinks; ?>
          </ul>
        </div>
        </div>
      </div>
    </div>
  </footer>


<?php
Assets::js([
    'https://code.jquery.com/jquery-2.1.1.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js',
     resource_url('js/jquery.form.min.js'),
     theme_url('js/main.js', 'Bootstrap'),
]);

echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone

echo isset($footer) ? $footer : ''; // Place to pass data / plugable hook zone
?>

<!-- DO NOT DELETE! - Forensics Profiler -->

</body>
</html>
