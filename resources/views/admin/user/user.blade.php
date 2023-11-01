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
                                <a href="{{ url('admin-add-user') }}" class="btn btn-primary">Add User</a>
                                <br>
                                <br>
                                <hr>
                                <div class="table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Active</th>
                                                <th>Role</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listUser as $user)
                                            <tr>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td><label class="badge badge-success">active</label></td>
                                                @if($user->usertype==1)
                                                <td style="color: rgb(252, 252, 252)">admin</td>
                                                @else
                                                <td>customer</td>
                                                @endif

                                                <td>

                                                    @if($user->usertype!=1)


                                                    <form
                                                                            action="{{ url('/admin-delete-user' . '/' . $user->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">delete</button>

                                                                        </form>
                                                    @endif




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