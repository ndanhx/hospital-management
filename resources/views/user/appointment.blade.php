<div class="page-section">
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
                {{-- de lai chua lam --}}
                <h2 style="
                color: red;
                text-align: center;
            ">PLEASE LOG IN TO
                    SCHEDULE AN APPOINTMENT</h2>
            @endauth
        @endif
    </div>
</div>
