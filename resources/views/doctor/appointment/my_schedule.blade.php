<!DOCTYPE html>
<html lang="en">

<head>
    @include('doctor.components.css');
</head>
<style>
    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .blink {
        animation: blink 1s infinite;
        /* 1s là thời gian mỗi chu kỳ blink */
    }

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
                                <div class="row">
                                    <form class="col-md-6" action="{{ url('doctor-search-appointment') }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Full name...">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>

                                    <form class="col-md-6" action="{{ url('doctor-search-date') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="date"
                                                    value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>



                                <div class="table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>email</th>
                                                <th>Phone</th>
                                                <th>Specialty</th>

                                                <th>Process</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($listAppointment) > 0)

                                                @foreach ($listAppointment as $appointment)
                                                    <td>{{ $appointment->date_request }}</td>

                                                    @if ($appointment->VIP == 1)
                                                        <td class="blink">
                                                            {{ $appointment->name }}
                                                            <i style="color: greenyellow;"
                                                                class="mdi mdi-checkbox-marked-circle"></i>
                                                        </td>
                                                    @else
                                                        <td>{{ $appointment->name }}</td>
                                                    @endif
                                                    <td>{{ $appointment->email }}</td>
                                                    <td>{{ $appointment->phone }}</td>
                                                    @foreach ($listSpecialty as $specialty)
                                                        @if ($specialty->id == $appointment->specialty_id)
                                                            <td>{{ $specialty->name }}</td>
                                                        @endif
                                                    @endforeach

                                                    <td>
                                                        @if ($appointment->status == 'pending')
                                                            <label class="badge badge-warning">Pending</label>
                                                        @endif
                                                        @if ($appointment->status == 'approved')
                                                            <label class="badge badge-info">approved</label>
                                                        @endif
                                                        @if ($appointment->status == 'cancel')
                                                            <label class="badge badge-danger">cancel</label>
                                                        @endif
                                                        @if ($appointment->status == 'completed')
                                                            <label class="badge badge-success">completed</label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="menu">
                                                            <ul class="clearfix">
                                                                <li>
                                                                    <a href="#"><span
                                                                            class="mdi mdi-dots-vertical"></span></a>
                                                                    {{-- <i class="mdi mdi-grease-pencil"></i> --}}
                                                                    <ul class="sub-menu">
                                                                        <li>
                                                                            <a class="btn btn-info"
                                                                                href="{{ url('doctor-checking-heath_book') . '/' . $appointment->id }}">checking</a>
                                                                        </li>
                                                                        <li>
                                                                            <form
                                                                                action="{{ url('cancel-status-appointment') }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <input type="text"
                                                                                    name="appointment_id"
                                                                                    id="appointment_id"
                                                                                    value="{{ $appointment->id }}"
                                                                                    hidden>
                                                                                <button
                                                                                    class="btn btn-danger">Cancel</button>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7">No data found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                {{$listAppointment->links()}}
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
