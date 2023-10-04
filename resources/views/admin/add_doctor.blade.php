<html>
<head>
    @include('admin.css');
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar');
      <!-- partial -->
      
        @include('admin.navbar');

        <div class="container-fluid page-body-wrapper">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                        X
                    </button>
                    {[session()->get('message')]}
                </div>
            @endif
            <div class="container">
                <form action="{{ url('upload_doctor') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="mt-4">
                            <x-label for="Doctor Name" value="{{ __('Doctor Name') }}" />
                            <x-input id="Doctor Name" class="block mt-1" type="text" name="name" :value="old('name')" 
                            placeholder="Nhập tên bác sĩ" required autocomplete="Doctor Name" style="color:black;"/>
                        </div>
                        <div class="mt-4">
                            <x-label for="Phone" value="{{ __('Phone') }}" />
                            <x-input id="Phone" class="block mt-1" type="number" name="number" :value="old('number')" 
                            placeholder="Nhập số điện thoại" required autocomplete="Phone" style="color:black;"/>
                        </div>
                        <div class="mt-4">
                            <x-label for="Specialty" value="{{ __('Speciality') }}" /> 
                            <select id="Specialty" class="block mt-1" name="specialty" required style="color:rgb(73, 72, 72); border-radius: 7px;">
                                <option>---Select---</option>
                                <option value="Skin">Skin</option>  
                                <option value="Heart">Heart</option>
                                <option value="Eye">Eye</option>
                                <option value="Nose">Nose</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-label for="Room No" value="{{ __('Room No') }}" />
                            <x-input id="Room No" class="block mt-1" type="text" name="room" :value="old('room')" 
                            placeholder="Nhập số phòng" required autocomplete="Room No" style="color:black;"/>
                        </div>
                        <div class="mt-4">
                            <x-label for="Doctor Image" value="{{ __('Doctor Image') }}" />
                            <x-input id="Doctor Image" class="block mt-1" type="file" name="file" :value="old('file')" 
                            placeholder="Hình bác sĩ" required autocomplete="Doctor Image" style="color:white;"/>
                        </div>
                        <div class="mt-4">
                            <input type="submit" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>