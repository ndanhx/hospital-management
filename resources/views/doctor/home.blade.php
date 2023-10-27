<!DOCTYPE html>
<html lang="en">
  <head>
    @include('doctor.components.css');
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_sidebar.html -->
        @include('doctor.components.sidebar');
      <!-- partial -->
      
        @include('doctor.components.navbar');

        <!-- partial -->
        @include('doctor.components.body');
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('doctor.components.script');
    <!-- End custom js for this page -->
  </body>
</html>