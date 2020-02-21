<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SES - Secretária Estadual de Saúde</title>
    <link rel="stylesheet" href="{{url('assets/css/ses.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/all.min.css')}}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">SES - Secretaria Estadual de Saúde</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('contacts.store')}}">Contatos <span class="sr-only">(página atual)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('birthdays')}}">Aniversáriantes do mês</a>
            </li>
          </ul>
        </div>
      </nav>
    @yield('content')
    <script src="{{url('assets/js/jquery.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
</body>
</html>