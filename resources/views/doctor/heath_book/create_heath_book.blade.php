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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label style=" font-size: larger;  color: palevioletred;  "
                                                class="col-sm-3 col-form-label"><i class="mdi mdi-message-text"></i>
                                                Message</label>
                                            <div class="col-sm-9">
                                                <label type="text"
                                                    style=" font-size: larger;  color: palevioletred;  "
                                                    class="form-control">{{ $appointment->message }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <p class="card-description">
                                    ---------------------------------------------------------- Doctor
                                    ----------------------------------------------------------- </p>

                                <form method="POST" action="{{ url('create-heath-book') }}">
                                    @csrf
                                    <input type="text" name="appointment_id" id="appointment_id"
                                        value="{{ $appointment->id }}" hidden>
                                    <input type="text" name="userID" id="userID" value="{{ $user->id }}"
                                        hidden>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Diagnosis</label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" name="diagnosis" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="createRowContainer">
                                        <div id="createRow">
                                            <div class="row-item row row5 rowmb3">
                                                <div class="col-lg-3 col-sm-6 col-12">
                                                    <div class="position-relative form-icon form-icon_right">
                                                        <input type="text" class="form-control" name="Drug_name[]"
                                                            id="code" data-row="1" placeholder="Drug name"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6 col-12">
                                                    <div class="position-relative form-icon form-icon_right">
                                                        <input type="number" class="form-control" name="soluong[]"
                                                            data-row="1" id="soluong" placeholder="Quantity"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-10 col-9" id="menhGia">
                                                    <select class="form-control charging-amount" id="price"
                                                        name="time[]" data-row="1" required>
                                                        <option name="">--- Select time ---</option>
                                                        <option value="Morning" data-index="0">Morning</option>
                                                        <option value="Noon" data-index="1">Noon</option>
                                                        <option value="Afternoon" data-index="1">Afternoon</option>
                                                        <option value="Evening" data-index="1">Evening</option>
                                                    </select>
                                                    <br>
                                                </div>
                                                <div class="col-lg-1 col-sm-2 col-3 text-right">
                                                    <button type="button" class="btn btn-small btn-success addRow">
                                                        <i class="fas fa-plus-circle"></i>
                                                        Thêm
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-info">Create prescription</button>
                                </form>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('.addRow').on('click', function() {
                                            var newRow = $('#createRow .row-item:first').clone();
                                            newRow.find('.addRow').remove();
                                            newRow.find('input[type=text], input[type=number]').val('');
                                            newRow.find('select').prop('selectedIndex', 0);
                                            $('#createRowContainer').append(newRow);
                                        });
                                    });
                                </script>





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
