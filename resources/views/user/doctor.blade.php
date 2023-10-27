<div class="page-section">
    <div class="container">
      <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>

     
      <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
        @foreach($listDoctor as $doctor)
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="doctorimage/{{ $doctor->image }}" alt="">
              <div class="meta">
                <a ><span class="mai-call"></span></a>
                <a ><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">{{ $doctor->name }}</p>
              <span class="text-sm text-grey">{{ $doctor->specialty_id }}</span>
            </div>
          </div>
        </div>

          @endforeach
      </div>
     
    </div>
  </div>