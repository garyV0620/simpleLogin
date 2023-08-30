@if(session()->has('message'))
    <div class=" alert alert-success text-center " role="alert" x-data="{show: true}" x-init="setTimeout(()=>show = false, 3000)" x-show="show">
        {{ session('message') }}
    </div>
@endif
