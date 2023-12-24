<?php

namespace App\Http\Requests;

use App\Domains\Users\Enums\EnumUserAccountType;
use App\Domains\Users\Enums\EnumUserActivityStatus;
use App\Domains\Users\Enums\EnumUserStaffRole;
use App\Domains\Users\Models\Tables\TableUser as u;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserRequestCreate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
             u::name => 'required|string|max:32',
             u::email => 'required|string|lowercase|email|max:255|unique:'.User::class,
             u::handle => 'required|unique:users',
             u::password =>  ['required', 'confirmed', Rules\Password::defaults()],
             u::avatar => 'nullable|url',
             u::staff_role => [
                 // 'required',
                 'nullable',
                 Rule::enum(EnumUserStaffRole::class)
             ],
             u::activity_status => [
                 // 'required',
                 'nullable',
                 Rule::enum(EnumUserActivityStatus::class)
             ],
             u::account_type => [
                 // 'required',
                'nullable',
                 Rule::enum(EnumUserAccountType::class)
             ],
        ];
    }
}
