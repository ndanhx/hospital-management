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
        @include('user.components.sidebar');
        <!-- partial -->

        @include('user.components.navbar');

        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <p class="card-description"> Patient information </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Full Name</label>
                                            <div class="col-sm-9">
                                                <label type="text" class="form-control">{{ $user->name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <label type="text" class="form-control">{{ $user->email }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Phone</label>
                                            <div class="col-sm-9">
                                                <label type="text" class="form-control">{{ $user->phone }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                                            <div class="col-sm-9">
                                                <label class="form-control">{{ $user->created_at }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <label type="text" class="form-control">{{ $user->address }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Diagnosis</label>
                                            <div class="col-sm-9">
                                                <label type="text" name="diagnosis"
                                                    class="form-control">{{ $heathBook->diagnosis }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Drug name</th>
                                                <th>Quantity</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($listPrescriptions as $prescriptions)
                                                <td>{{ $prescriptions->STT }}</td>

                                                <td>{{ $prescriptions->drug_name }}</td>
                                                <td>{{ $prescriptions->quantity }}</td>
                                                <td>{{ $prescriptions->time }}</td>
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
