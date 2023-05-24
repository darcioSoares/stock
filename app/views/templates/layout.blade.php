<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="@php echo PATH_PUBLIC.'css/style.css'@endphp">
</head>
<body>
    <div class="topnav" id="myTopnav">
        <a href="#home" class="active">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
        <a href="javascript:void(0);" class="icon" onclick="responsive()">
          <i class="fa fa-bars"></i>
        </a>
      </div>
    @yield('content')

    <script src="{{PATH_PUBLIC}}js/index.js"></script>
</body>
</html>