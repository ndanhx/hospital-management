{{-- <div class="page-section">
    <div class="container">
        <h1 class="text-center wow fadeInUp">Make an Appointment</h1>
        @if (Route::has('login'))
            @auth
                <form class="main-form" action="{{ url('request-appointment') }}" method="POST">
                    @csrf

                    <div class="row mt-5 ">
                        <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                                readonly>
                        </div>
                        <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                            <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}"
                                readonly>
                        </div>
                        <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
                            <input type="date" class="form-control" name="date" id="datePicker"
                                min="<?php echo date('Y-m-d'); ?>">

                        </div>
                        <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                            <select name="specialty_id" id="specialty_id" class="custom-select">
                                @foreach ($listSpecialty as $specialty)
                                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                            <input type="text" name="phone" class="form-control" placeholder="Number..">
                        </div>
                        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                            <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Submit Request</button>
                </form>
            @else
                <h2 style="
                color: red;
                text-align: center;
            ">PLEASE LOG IN TO
                    SCHEDULE AN APPOINTMENT</h2>
            @endauth
        @endif
    </div>
</div> --}}




<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'normal')">Normal</button>
    <button class="tablinks" onclick="openTab(event, 'vip')">VIP</button>
</div>

<div id="normal" class="tabcontent">
    <h1 class="text-center wow fadeInUp">Make an Appointment </h1>
    @if (Route::has('login'))
        @auth
            <form class="main-form" action="{{ url('request-appointment') }}" method="POST">
                @csrf

                <div class="row mt-5 ">
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                        <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}"
                            readonly>
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
                        <input type="date" class="form-control" name="date" id="datePicker" min="<?php echo date('Y-m-d'); ?>">

                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                        <select name="specialty_id" id="specialty_id" class="custom-select">
                            @foreach ($listSpecialty as $specialty)
                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <input type="text" name="phone" class="form-control" placeholder="Number..">
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Submit Request</button>
            </form>
        @else
            <h2 style="
            color: red;
            text-align: center;
        ">PLEASE LOG IN TO
                SCHEDULE AN APPOINTMENT</h2>
        @endauth
    @endif
</div>

<div id="vip" class="tabcontent">
    <h1 class="text-center wow fadeInUp">Make an Appointment For VIP</h1>
    @if (Route::has('login'))
        @auth
            <form class="main-form" action="{{ url('request-appointment-VIP') }}" method="POST">
                @csrf

                <div class="row mt-5 ">
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}ssss"
                            readonly>
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                        <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}"
                            readonly>
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
                        <input type="date" class="form-control" name="date" id="datePicker" min="<?php echo date('Y-m-d'); ?>"
                            required>

                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                        <select name="specialty_id" id="specialty_id" class="custom-select" required
                            onchange="loadDoctors(this)">
                            <option>--Select Specialty--</option>
                            @foreach ($listSpecialty as $specialty)
                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                        <select name="doctor_id" id="doctor-list" class="custom-select"></select>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <input type="text" name="phone" class="form-control" placeholder="Number.." required>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.." required></textarea>
                    </div>
                </div>
                <input type="number" value="100000" name="amount" hidden>

                <button name="redirect" type="submit" class="btn btn-primary mt-3 wow zoomIn">Pay 100.000 VND</button>
            </form>
        @else
            <h2 style="
            color: red;
            text-align: center;
        ">PLEASE LOG IN TO
                SCHEDULE AN APPOINTMENT</h2>
        @endauth
    @endif
</div>

<script>
    document.getElementById("normal").style.display = "block";
    document.getElementById("vip").style.display = "none";

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

<script>
    function loadDoctors(specialtyIdvalue) { 
        let specialtyId = specialtyIdvalue.value;
        console.log(specialtyId)
        $.ajax({
            url: '/get-doctors-by-specialty/' + specialtyId,
            type: 'GET',
            cache: false,  
            success: function(data) {
                var doctorList = document.getElementById("doctor-list");
                doctorList.innerHTML = "";
                data.forEach(function(doctor) {
                    var option = document.createElement("option");
                    option.value = doctor.id;
                    option.text = doctor.name;
                    doctorList.appendChild(option);

                });

            },
            error: function(error) {
                console.log(error);
            }
        });
        specialtyId ='';

    }
</script>
