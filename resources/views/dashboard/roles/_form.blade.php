@props([
    'deny_all'=>false
])
<div class="card-body">
    <x-form.input element="Role" type='text' name='name' value="{{ $role->name ?? '' }}" />
    <fieldset>
        <legend>{{__('Abilities')}}</legend>
        @foreach (app('abilities') as $ability_code => $ability_name)
            <div class="row mb-2">
                <div class="col-md-6">
                    {{ is_callable($ability_name) ? $ability_name() : $ability_name }}
                </div>
                <div class="col-md-2">
                    <input type="radio" name="abilities[{{ $ability_code }}]" value='allow'
                        @checked(($role_abilities[$ability_code] ?? '') == 'allow')> Allow
                </div>
                <div class="col-md-2">
                    <input type="radio" name="abilities[{{ $ability_code }}]" value='deny'
                        @checked(($role_abilities[$ability_code] ?? '') == 'deny') @if($deny_all) checked @endif> Deny
                </div>
                <div class="col-md-2">
                    <input type="radio" name="abilities[{{ $ability_code }}]" value='inherit'
                        @checked(($role_abilities[$ability_code] ?? '') == 'inherit')> Inherit
                </div>
            </div>
        @endforeach
    </fieldset>
</div>
<!-- /.card-body -->
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Submit' }}</button>
</div>