<x-loginLayout>
  <!-- Section: Design Block -->
<section class="text-center text-lg-start signinForm">
  <!-- Jumbotron -->
  <div class="container py-4">
    <div class="row g-0 align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0 cascading-right">
        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4 img-signin"
          alt="" />
      </div>
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card " style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
          <div class="card-body p-5 shadow-5 text-center">
            {{-- message on register success --}}
            <x-alerts.success />
            <x-alerts.error />
            <h2 class="fw-bold mb-5">Enter Credentials</h2>
            <form method="POST" action="{{ route('authenticate') }}" enctype="multipart/form-data">
              @csrf
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" id="email" value="{{ old('email', $email ?? '') }}" name="email"  class="form-control @error('email') error-input @enderror" />
               
                <x-errorSpan :field="_('email')" />
                <label class="form-label" for="email">Email address</label>
              </div>
          
              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="password" value="{{ old('password', $password ?? '') }}" name="password" class="form-control @error('password') error-input @enderror" />
                
                <x-errorSpan :field="_('password')" />
                <label class="form-label" for="password">Password</label>
              </div>
          
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4 form-control">
                Sign up
              </button>
              <span>No account yet? Register <a href="{{ route('showRegister') }}">here</a></span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
</x-loginLayout>
