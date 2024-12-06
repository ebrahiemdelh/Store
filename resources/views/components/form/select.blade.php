<div class="form-group form-select">
    <label for={{ $name }}>{{ $element }} Category</label>
    <select @class(['form-control', 'is-invalid' => $errors->has($name)]) id={{ $name }} name={{ $name }}>
        <option value="" selected disabled>Select Parent Category</option>
        @foreach ($value as $value)
            <option value="{{ $value->id }}" @selected(old($name) == $value->id)>
                {{ $value->name }}</option>
        @endforeach
    </select>
</div>
