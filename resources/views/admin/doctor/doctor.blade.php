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
                                        <td>{{$doctor->specialty}}</td>
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