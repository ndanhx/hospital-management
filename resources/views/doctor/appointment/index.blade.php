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
                      


                      </p>
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>email</th>
                              <th>Phone</th>
                              <th>Specialty</th>
                              <th>Process</th>  
                              <th>Action</th>  
                            </tr>
                          </thead>
                          <tbody>
                             
                              @foreach ( $listAppointment as $appointment)
                              @if($appointment->specialty_id ==Auth::guard('doctor')->user()->specialty_id )
                                  
                              
                               
                              <td>{{$appointment->name}}</td>
                              <td>{{$appointment->email}}</td>
                              <td>{{$appointment->phone}}</td>
                              @foreach ($listSpecialty as $specialty)
                                @if ($specialty->id == $appointment->specialty_id)
                                  <td >{{$specialty->name}}</td>
                                @endif
                                
                              @endforeach
                              <td>
                                @if($appointment->status =='pending')
                                <label class="badge badge-danger">Pending</label>
                                @endif
                                @if($appointment->status =='approved')
                                <label class="badge badge-danger">approved</label>
                                @endif
                                @if($appointment->status =='cancel')
                                <label class="badge badge-danger">cancel</label>
                                @endif
                                
                              <td></td>
                            </tr>
                            @endif
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