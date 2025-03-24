<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<title></title>
</head>
<body>


@auth

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <a class="navbar-brand pl-4" href="/"> Simple Accounts App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      
      <a href="/" class="nav-item nav-link" href="#">Dashboard</a>
      <a href="/transfer" class="nav-item nav-link" href="#">Transfer</a>
      <a href="/withdraw" class="nav-item nav-link" href="#">Withdraw</a>
      <a href="/deposit" class="nav-item nav-link" href="#">Deposit</a>
      <a href="/logout" class="nav-item nav-link" href="#">Logout</a>
    </div>
  </div>
</nav>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        {{ session('success') }}
    </div>
@endif
@endauth

@auth
{{$slot}}
@else
<div class="d-flex justify-content-end mb-4 mt-4 pt-4 ">
	<a href="/login"><button class="btn btn-success mx-2">
		<i class="fas fa-paper-plane"></i> Login
	</button></a>
	<a href="/register"><button class="btn btn-warning mx-2">
		<i class="fas fa-arrow-circle-down"></i> Register
	</button></a>
</div>
{{$slot}}
@endauth


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
