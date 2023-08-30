@error('invalid')
    <div class=" alert alert-danger text-center " role="alert" x-data="{show: true}" x-init="setTimeout(()=>show = false, 10000)" x-show="show">
        {{ $message }}
    </div>
@enderror
