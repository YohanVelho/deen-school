<!DOCTYPE html>
<html lang="{{App::currentLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="ALL" />
    <meta property="og:title" content="{{(isset($seo['title']) ? $seo['title'] : '')}}"/>
    <meta property="og:description" content="{{(isset($seo['description']) ? $seo['description'] : '')}}"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta name="description" content="{{$seo['description'] ?? ''}}"/>
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="600">
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
    <meta property="og:site_name" content="Riccio Imóveis" />
    @if(!empty($seo['keywords']))
        <meta name="keywords" content="{{(json_decode($seo['keywords']) ? implode(',', json_decode($seo['keywords'], true)) : $seo['keywords']) ?? ''}}"/>
    @endif
    @if(!empty($seo['canonical']))
        <link rel="canonical" href="{{$seo['canonical'] ?? ''}}" />
    @endif

    @if (!empty($general['favicon']))
        <link rel="icon" href="storage/{{ $general['favicon'] }}">
    @endif

    @if (isset($seo['seo_img']))
        <meta property="og:image" content="{{ resize('storage/'.$seo['seo_img'],512) }}"/>
    @endif

    <base href="{{url('')}}" />

    <title>{{(isset($seo['title']) ? $seo['title'] : '')}}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7COpen%20Sans:300,400,700%7CMontserrat:700' rel='stylesheet' type='text/css'>		
    <link href="assets/site/css/vendor.css?v=<?= filemtime('assets/site/css/vendor.css') ?>" rel="stylesheet">
    <link href="assets/site/css/style.css?v=<?= filemtime('assets/site/css/style.css') ?>" rel="stylesheet">

    @yield('css')

    {!! $general['script_head'] !!}

</head>

<body {{request()->route()->getName() ==  'properties' ? 'id=imoveis' : ''}}>

    {!! $general['script_body'] !!}

    @yield('content')

    <script src="assets/site/js/jquery.js"></script>			                                       
    <script src="assets/site/js/jquery.sticky.js"></script>			                                       
    <script src='assets/site/js/imagesloaded.pkgd.js'></script>                
    <script src='assets/site/js/jquery.fitvids.js'></script>                
    <script src='assets/site/js/jquery.smartmenus.min.js'></script>                                 
    <script src='assets/site/js/isotope.pkgd.js'></script>                                 
    <script src='assets/site/js/jquery.easing.1.3.js'></script>                                                       
    <script src='assets/site/js/jquery.prettyPhoto.js'></script>                                                         
    <script src='assets/site/js/owl.carousel.min.js'></script>                          
    <script src='assets/site/js/main.js'></script>

    @yield('js')

    {!! $general['script_footer'] !!}


</body>
</html>

