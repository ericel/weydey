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
            <a class='dropdown-button' href="<?= site_url('admin/dashboard'); ?>" data-activates='dropdown-menu'> <img class="header-avatar" src="{{$imageUrl}}" alt="<?= Auth::user()->username; ?>"> <?= Auth::user()->username; ?></a>
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
            <a  href='<?= site_url('admin/dashboard'); ?>'> <img class="header-avatar" src="{{$imageUrl}}" alt="<?= Auth::user()->username; ?>"> <?= Auth::user()->username; ?></a>
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
            @foreach (Config::get('languages') as $code => $info)
                        <li {{ ($code == Language::code()) ? 'class="active"' : ''; }}>
                            <a href='{{ site_url('language/' .$code) }}' title='{{ $info['info'] }}'>{{ $info['name'] }}</a>
                        </li>
            @endforeach

            
    </ul>