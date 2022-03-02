<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    @include('dashboard.layouts.assets')
  </head>
  <body>
    <div class="container-scroller">
        @include('dashboard.layouts.sidebar')
      <div class="container-fluid page-body-wrapper">
        @include('dashboard.layouts.navbar')
        <div class="main-panel">
          <div class="content-wrapper">
            @yield('content')
          </div>
          <!-- content-wrapper ends -->
        @include('dashboard.layouts.footer')
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('dashboard.layouts.scripts')
    @stack('scripts')
  </body>
</html>