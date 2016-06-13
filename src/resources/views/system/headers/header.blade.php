<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="keywords" content="@yield('keywords', config('site.keywords'))"/>
<meta name="author" content="@yield('author', config('site.author'))"/>
<meta name="description" content="@yield('description', config('site.description'))"/>
<link rel="icon" href="/favicon.ico">
<title>@section('title') {{ config('site.name') }} @show</title>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
