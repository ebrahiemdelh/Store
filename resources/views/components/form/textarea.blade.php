<div class="form-group">
    <label for="description">Description</label>
    @if (old('description'))
        @php
            $data = old('description');
        @endphp
    @elseif(!isset($data))
        @php
            $data = '';
        @endphp
    @endif
    <textarea class="form-control" name="description" placeholder="Description">{{ $data }}</textarea>
</div>
