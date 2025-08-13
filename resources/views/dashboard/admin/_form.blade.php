@props([
    'button_label' => 'Submit',
    'title' => 'Create Admin'
])
<div class="card-body">
    <x-form.input element="Admin" type='text' name='name' value="{{ $admin->name ?? '' }}" />
    <div class="form-group">
        <x-form.input element="Admin" type='email' name='email' value="{{ $admin->email ?? '' }}" />
    </div>
    <div class="form-group">
        <label for="roles">Roles</label>
        @foreach ($roles as $role)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="roles[]" id="role_{{ $role->id }}"
                    value="{{ $role->id }}"
                    @if($title == 'Update Admin'){{ $admin->roles->contains($role) ? 'checked' : '' }}@endif>
                <label class="form-check-label" for="role_{{ $role->id }}">
                    {{ $role->name }}
                </label>
            </div>
        @endforeach
    </div>
    <!-- /.card-body -->
    <button type="submit" class="btn btn-primary">{{ $button_label }}</button>
</div>