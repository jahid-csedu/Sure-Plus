<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SurePlus') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/home">{{ config('app.name', 'SurePlus') }}</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="{{ route('logout') }}" 
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
        </li>
      </ul>
    </nav>
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="/home">
                  <i class="fas fa-home"></i>
                  <b class="px-1">Dashboard</b> <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/students">
                  <i class="fas fa-users"></i>
                  <b class="px-1">Students</b>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/fees">
                  <i class="fas fa-dollar-sign"></i>
                  <b class="px-1">Fees</b>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/employees">
                  <i class="fas fa-user-tie"></i>
                  <b class="px-1">Employees</b>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/exams">
                  <i class="fas fa-pen"></i>
                  <b class="px-1">Exams</b>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/results">
                  <i class="fas fa-id-card"></i>
                  <b class="px-1">Results</b>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/payments">
                  <i class="fas fa-dollar-sign"></i>
                  <b class="px-1">Payments</b>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/expenses">
                  <i class="fas fa-money-bill"></i>
                  <b class="px-1">Expenses</b>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/accounts">
                  <i class="fas fa-money-check"></i>
                  <b class="px-1">Accounts</b>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/classes">
                  <i class="fas fa-bell "></i>
                  <b class="px-1">Classes</b>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/sections">
                  <i class="fas fa-book"></i>
                  <b class="px-1">Sections</b>
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Show reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-file"></i>
                  <b class="px-1">Results</b>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-file-alt"></i>
                  <b class="px-1">Statements</b>
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <div class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
          @include('messages.errors')
          @include('messages.success')

          <main class="row">
              @yield('content')
          </main>
        </div>
    </div>
    <div>
      @yield('scripts')
    </div>

</body>
</html>
