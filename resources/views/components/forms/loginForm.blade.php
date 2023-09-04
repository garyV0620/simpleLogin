@props(['action', 'userId'])

<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @method(isset($userId) ? 'PUT' : 'POST')
    <!-- 2 column grid layout with text inputs for the first and last names -->

    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <input placeholder="First Name" value="{{ old('firstName', $firstName ?? '') }}" type="text" id="firstName" name="firstName" 
          {{-- other way to show error on class  --}}
          {{-- class="@error('firstName') error-input @enderror form-control" /> --}}
          @class(['form-control', 'error-input'=> $errors->has('firstName')]) />

          <x-errorSpan :field="_('firstName')" />
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="form-outline">
          <input placeholder="Last Name" value="{{ old('lastName', $lastName ?? '') }}" type="text" id="lastName" name="lastName" 
          @class(['form-control', 'error-input'=> $errors->has('lastName')]) />

          <x-errorSpan :field="_('lastName')" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <x-checkbox :label="_('Male')" :name="_('gender')" :value="_('male')" :id="_('g_male')"/>
      </div>
      <div class="col-md-6">
        <x-checkbox :label="_('Female')" :name="_('gender')" :value="_('female')" :id="_('g_female')"/>
      </div>
      <x-errorSpan :field="_('gender')" :errorMessage="_('Gender is required')"/>
    </div>

    <div class="form-outline mb-4">
    </div>
    

    <!-- Email input -->
    <div class="form-outline mb-4">
      <input type="email" id="email" value="{{ old('email', $email ?? '') }}" name="email"  
      @class(['form-control', 'error-input'=> $errors->has('email')]) />
      
      <x-errorSpan :field="_('email')" />
      <label class="form-label" for="email">Email address</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
      <input type="password" id="password" value="{{ old('password', $password ?? '') }}" name="password"
      @class(['form-control', 'error-input'=> $errors->has('password')]) />
      
      <x-errorSpan :field="_('password')" />
      <label class="form-label" for="password">Password</label>
    </div>

    <div class="form-outline mb-4">
      <input type="password" id="password_confirmation"  name="password_confirmation" 
      @class(['form-control', 'error-input'=> $errors->has('password')]) />
      
      <x-errorSpan :field="_('password_confirmation')" />

      <label class="form-label" for="password_confirmation">Confirm Password</label>
    </div>
    <div class="form-outline mb-4 d-flex justify-content-center">
      <img id="imagePreview" src="{{ asset(session('tempImagePath')) }}" alt="Image Preview" style=" @if(!session('tempImagePath')) display: none; @endif max-width: 200px; max-height: 400px;">
    </div>
    <div class="form-outline mb-4">
      <div class="input-group mb-3">
        <input type="file" class="form-control" id="image" name="image" onchange="previewImage(this)" >
        <label class="input-group-text" for="image">Upload</label>
      </div>
      <x-errorSpan :field="_('image')" />
    </div>
    
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4 form-control">
      Sign up
    </button>
    <p>Already have an Account? <a href="@if(!isset($userId)) {{ route('login') }}  @else  {{ route('dashboard') }} @endif">Login Now</a></p>
  </form>
  <script>
    function previewImage(input) {
    var preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
  </script>