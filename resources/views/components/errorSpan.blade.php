@props(['field', 'errorMessage' => Null])
<div>
        @error($field)
            @if($errorMessage)
                <span class="error-messages"> {{ '*'. $errorMessage }} </span> <br>
            @else
                <span class="error-messages"> {{ '*'. $message }} </span> <br>
            @endif
        @enderror
</div>