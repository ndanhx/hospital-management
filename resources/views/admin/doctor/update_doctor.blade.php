<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="../admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../admin/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar');
      <!-- partial -->
      
        @include('admin.navbar');

        <!-- partial -->
       
        <div class="main-panel">
            <div class="content-wrapper"> 
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Add Doctor</h4>
                      <div class="row"> 
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">
                                    X
                                </button>
                                {{session()->get('message')}}
                            </div>
                        @endif 
                        
                        <form action="{{ route('update-doctor', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PATCH')
                          <div class="mt-4">
                            <x-label for="Doctor Name" value="{{ __('Doctor Name') }}" style="color: white;" />
                            <x-input id="Doctor Name" class="block mt-1" type="text" name="name" :value="$doctor->name" placeholder="Nhập tên bác sĩ" required autocomplete="Doctor Name" style="background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem;" />
                          </div>
                          <div class="mt-4">
                            <x-label for="Phone" value="{{ __('Phone') }}" style="color: white;" />
                            <x-input id="Phone" class="block mt-1" type="number" name="phone" :value="$doctor->phone" placeholder="Nhập số điện thoại" required autocomplete="Phone" style="color: black; background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem;" />
                          </div>
                          <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" style="color: white;" />
                            <x-input id="email" class="block mt-1" type="email" name="email" :value="$doctor->email" placeholder="Nhập email" required autocomplete="Phone" style="color: black; background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem;" />
                          </div>
                          <div class="mt-4">
                            <x-label for="specialty_id" value="{{ __('Speciality') }}" style="color: white;" />
                            <select id="specialty_id" class="block mt-1" name="specialty_id" required style="background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem; border-radius: 7px;">
                              @foreach($listSpecialty as $specialty)
                              @if($specialty->id == $doctor->specialty_id)
                                <option value="{{$specialty->id}}">{{$specialty->name}}</option>  
                                @else

                                <option value="{{$specialty->id}}">{{$specialty->name}}</option>     
                                @endif 
                              @endforeach 
                            </select>
                          </div>
                          <div class="mt-4">
                            <x-label for="Room No" value="{{ __('Room No') }}" style="color: white;" />
                          <x-input id="Room No" class="block mt-1" type="text" name="room" :value="$doctor->room" placeholder="Nhập số phòng" required autocomplete="Room No" style="color: black; background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem;" />
                        </div>
                        <div class="mt-4">
                          
                          <x-label for="Doctor Image" value='Old Image'  style="color: white;" />
                          <img src="../doctorimage/{{$doctor->image}}" alt="lỗi">
                        </div>
                        <div class="mt-4">

                          <x-label for="Doctor Image" value="{{ __('Doctor Image') }}" style="color: white;" />
                          <x-input id="Doctor Image" class="block mt-1" type="file" name="file"   placeholder="Hình bác sĩ"   autocomplete="Doctor Image" style="background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem;" />
                        </div>
                        <div class="mt-4">
                          <input type="submit" class="btn btn-success" value="Update">
                        </div>
                      </form> 
                        


                         
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          </div> 
        </div> 
        </div>   
        <script src="../admin/assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="../admin/assets/vendors/chart.js/Chart.min.js"></script>
        <script src="../admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
        <script src="../admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
        <script src="../admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
        <script src="../admin/assets/js/jquery.cookie.js" type="text/javascript"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="../admin/assets/js/off-canvas.js"></script>
        <script src="../admin/assets/js/hoverable-collapse.js"></script>
        <script src="../admin/assets/js/misc.js"></script>
        <script src="../admin/assets/js/settings.js"></script>
        <script src="../admin/assets/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="../admin/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>