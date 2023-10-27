<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css');
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
                      @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                      <h4 class="card-title">Add Doctor</h4>
                      <div class="row">  
                        <form action="{{ url('upload-doctor') }}" method="POST" enctype="multipart/form-data">
                          @csrf 
                          @method('POST')
                          <div>
                              <div class="mt-4">
                                  <x-label for="Doctor Name" value="{{ __('Doctor Name') }}" style="
                                  color: white;
                              "/>
                                  <x-input id="Doctor Name" class="block mt-1" type="text" name="name" :value="old('name')" 
                                  placeholder="Nhập tên bác sĩ" required autocomplete="Doctor Name" 
                                  style="background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem;"/>
                              </div>
                              
                              <div class="mt-4">
                                  <x-label for="Phone"  value="{{ __('Phone') }}" style="
                                  color: white;
                              "/>
                                  <x-input id="Phone" class="block mt-1" type="number" name="phone" :value="old('number')" 
                                  placeholder="Nhập số điện thoại" required autocomplete="Phone" style="color:black;"
                                  style="background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem;"/>
                              </div>
                              <div class="mt-4">
                                <x-label for="email"  value="{{ __('email') }}" style="
                                color: white;
                            "/>
                                <x-input id="email" class="block mt-1" type='email' name="email" 
                                placeholder="Nhập số điện thoại" required autocomplete="email" style="color:black;"
                                style="background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem;"/>
                            </div>
                            <div class="mt-4">
                              <x-label for="password"  value="{{ __('password') }}" style="
                              color: white;
                          "/>
                              <x-input id="password" class="block mt-1" type="password" name="password"  
                              placeholder="Nhập số điện thoại" required autocomplete="Phone" style="color:black;"
                              style="background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem;"/>
                          </div>
                              <div class="mt-4">
                                  <x-label for="Specialty" value="{{ __('Speciality') }}" style="
                                  color: white;
                              "/> 
                                  <select id="Specialty" class="block mt-1" name="specialty" required 
                                  style="background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem; border-radius: 7px;"
                                  >
                                     @foreach($listSpecialty as $specialty)
                                      <option value="{{$specialty->id}}">{{$specialty->name}}</option>  
                                       
                                      @endforeach
                                  </select>
                              </div>
                              <div class="mt-4">
                                  <x-label for="Room No" value="{{ __('Room No') }}" style="
                                  color: white;
                              "/>
                                  <x-input id="Room No" class="block mt-1" type="text" name="room" :value="old('room')" 
                                  placeholder="Nhập số phòng" required autocomplete="Room No" style="color:black;"
                                  style="background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem;"/>
                              </div>
                              <div class="mt-4">
                                  <x-label for="Doctor Image" value="{{ __('Doctor Image') }}" style="
                                  color: white;
                              "/>
                                  <x-input id="Doctor Image" class="block mt-1" type="file" name="file" :value="old('file')" 
                                  placeholder="Hình bác sĩ" required autocomplete="Doctor Image"  
                                  style="background-color: #333; color: white; border: 1px solid #555; padding: 0.5rem;"/>
                              </div>
                              <div class="mt-4">
                                  <input type="submit" class="btn btn-success">
                              </div>
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
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>