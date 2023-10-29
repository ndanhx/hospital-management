<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css');
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
    <style>
        menu {
            width: 50px;
            margin: 0px auto;
            background: #bf5c71;
            height: 50px;
            margin-top: 150px;
        }

        .menu li {
            margin: 0px;
            list-style: none;
            font-family: 'Ek Mukta';
        }

        .menu a {
            transition: all linear 0.15s;
            color: #919191;
            text-decoration: none;
        }

        .menu li:hover>a,
        .menu .current-item>a {
            text-decoration: none;
            color: #be5b70;
        }

        .menu .arrow {
            font-size: 11px;
            line-height: 0%;
        }

        /*----- css cho phần menu cha -----*/
        .menu>ul>li {
            float: left;
            display: inline-block;
            position: relative;
            font-size: 19px;
        }

        .menu>ul>li>a {
            padding: 10px 20px;
            display: inline-block;
            color: white;
        }

        .menu>ul>li:hover>a,
        .menu>ul>.current-item>a {
            background: #2e2728;
        }

        /*----css cho menu con----*/
        .menu li:hover .sub-menu {
            z-index: 1;
            opacity: 1;
        }

        .sub-menu {
            width: 100%;
            padding: 5px 0px;
            position: absolute;
            top: 100%;
            left: 0px;
            z-index: -1;
            opacity: 0;
            transition: opacity linear 0.15s;
            box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.2);
            background: #2e2728;
        }

        .sub-menu li {
            display: block;
            font-size: 16px;
        }

        .sub-menu li a {
            padding: 5px 10px;
            display: block;
        }

        .sub-menu li a:hover,
        .sub-menu .current-item a {
            background: black;
        }
    </style>
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
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            X
                                        </button>
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <a href="{{ url('add-doctor') }}" class="btn btn-primary">Add doctor</a>
                                </p>
                                <div class="table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Preview</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Specialty</th>
                                                <th>Room</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($listDoctor as $doctor)
                                                    <td><img src="doctorimage/{{ $doctor->image }}" alt=""></td>
                                                    <td>{{ $doctor->name }}</td>
                                                    <td>{{ $doctor->phone }}</td>
                                                    @foreach ($listSpecialty as $specialty)
                                                        @if ($specialty->id == $doctor->specialty_id)
                                                            <td>{{ $specialty->name }}</td>
                                                        @endif
                                                    @endforeach
                                                    <td>{{ $doctor->room }}</td>
                                                    {{-- <td><label class="badge badge-danger">Pending</label></td> --}}
                                                    <td>

                                                        <div class="menu">
                                                            <ul class="clearfix">
                                                                <li>
                                                                    <a href="#"><span
                                                                            class="mdi mdi-dots-vertical"></span></a>
                                                                    {{-- <i class="mdi mdi-grease-pencil"></i> --}}
                                                                    <ul class="sub-menu">
                                                                        <li><a class="btn btn-info"
                                                                                href="{{ url('edit-doctor/' . $doctor->id) }}">
                                                                                edit </a></li>
                                                                        <li>

                                                                            <form
                                                                                action="{{ url('/delete-doctor' . '/' . $doctor->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">delete</button>

                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        {{-- <form action="view-doctor" method="GET">
                                  <button  class="btn btn-danger" type="submit">  <i class="mdi mdi-delete-forever"></i></button>
                                </form> --}}

                                                    </td>
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
