<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="@php echo PATH_PUBLIC.'css/style.css'@endphp">
    <link rel="stylesheet" href="@php echo PATH_PUBLIC.'bootstrap/css/bootstrap.css'@endphp">    
</head>
<body>
    <div class="topnav" id="myTopnav">
        <a href="home" class="active">Home</a>
        <a href="users">Usuarios</a>
        <a href="#contact">Categorias</a>
        <a href="#about">Produto</a>
        <a href="#about">Fornecedor</a>
        <a href="javascript:void(0);" class="icon" onclick="responsive()">
          <i class="fa fa-bars"></i>
        </a>
      </div>
    @yield('content')

    <script src="{{PATH_PUBLIC}}js/index.js"></script>
    <script src="{{PATH_PUBLIC}}bootstrap/js/bootstrap.bundle.js"></script>
    <script src="{{PATH_PUBLIC}}js/axios_1.4.min.js"></script>
  @stack('script')  
</body>
</html>