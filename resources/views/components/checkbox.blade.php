@props(["label", "name", "value", "id"])
<div>
    <input class="form-check-input @error($name) error-input @enderror" type="radio" value="{{ $value }}" name="{{ $name }}" id="{{ $id }}" {{ old($name, $gender ?? '') == $value ? 'checked': '' }}>
    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}
    </label>
</div>