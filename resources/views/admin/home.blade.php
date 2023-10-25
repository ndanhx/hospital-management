<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.doctor.css');
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_sidebar.html -->
        @include('admin.doctor.sidebar');
      <!-- partial -->
      
        @include('admin.doctor.navbar');

        <!-- partial -->
        @include('admin.doctor.body');
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.doctor.script');
    <!-- End custom js for this page -->
  </body>
</html>