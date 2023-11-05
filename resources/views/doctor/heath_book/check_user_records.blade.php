<!DOCTYPE html>
<html lang="en">

<head>
    @include('doctor.components.css');
</head>
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
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            X
                                        </button>
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                 <div class="row">
                                    <form class="col-md-6" action="{{ url('doctor-search-appointment') }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <input oninput="searchUser(this)" value=""  
                                                 type="text" class="form-control" name="name"
                                                    placeholder="Full name...">
                                            </div>


                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
                                            <script>
                                                
                                                function searchUser(param) {
                                                    var txtSearch = param.value;
                                                    axios.get('/doctor-search-user', {
                                                        params: {
                                                            txt: txtSearch
                                                        }
                                                    })
                                                    .then(function (response) {
                                                        var row = document.getElementById("table-ne");
                                                        row.innerHTML = response.data.html;
                                                    })
                                                    .catch(function (error) {
                                                        console.error(error);
                                                    });
                                                }

                                            </script>


                                            <button type="submit" class="btn btn-primary" disabled>Search</button>
                                        </div>
                                    </form> 
                                   
                                </div>
                                <div class="table-ne" id="table-ne">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Patient</th>
                                                <th>Diagnosis</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($listMedicalHistory) > 0)

                                                @foreach ($listMedicalHistory as $heathBook)
                                                    <td>{{ $heathBook->created_at }}</td>
                                                    @foreach ($listUser as $user)
                                                        @if ($user->id == $heathBook->user_id)
                                                            <td>{{ $user->name }}</td>
                                                        @endif
                                                    @endforeach
                                                    <td>{{ $heathBook->diagnosis }}</td>
                                                    <td>
                                                        <a class="btn btn-info"
                                                            href="{{ url('doctor-heath-book-detail/' . $heathBook->id) }}">Detail</a>
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

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    @include('doctor.components.script');
    <!-- End custom js for this page -->
</body>

</html>
