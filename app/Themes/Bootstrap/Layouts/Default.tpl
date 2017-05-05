<!DOCTYPE html>
<html lang="{{ Language::code() }}">
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
   {{  isset($meta) ? $meta : ''; }}
    @assets('css', array(
       'https://fonts.googleapis.com/icon?family=Material+Icons',
       'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css',
        theme_url('css/style.css', 'Bootstrap'),
    ))
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
@section('header')

@show

<div class="container">
<div class="section main">
@section('content')
    {{ $content }}
@show
</div>
</div>

@section('footer')

@show

@assets('js', array(
    'https://code.jquery.com/jquery-2.1.1.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js',
     resource_url('js/jquery.form.min.js'),
     theme_url('js/main.js', 'Bootstrap'),
))

<!-- DO NOT DELETE! - Forensics Profiler -->

</body>
</html>
