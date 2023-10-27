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
       
        <div class="main-panel">
            <div class="content-wrapper"> 
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <a href="{{ url('add-doctor') }}" class="btn btn-primary">Add doctor</a>


                      </p>
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Preview</th>
                              <th>Name</th>
                              <th>Phone</th>
                              <th>Specialty</th>
                              <th>Room</th>  
                              <th>Process</th>  
                              <th>Action</th>  
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              @foreach ($listDoctor as $doctor)
                                  
                              
                              <td><img src="doctorimage/{{$doctor->image}}" alt=""></td>
                              <td>{{$doctor->name}}</td>
                              <td>{{$doctor->phone}}</td>
                              @foreach ($listSpecialty as $specialty)
                                @if ($specialty->id == $doctor->specialty_id)
                                  <td >{{$specialty->name}}</td>
                                @endif
                                
                              @endforeach
                              <td>{{$doctor->room}}</td> 
                              <td><label class="badge badge-danger">Pending</label></td>
                            </tr>
                            @endforeach
                            
                          </tbody>
                        </table>
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