<?php

namespace App\Http\Requests;

use App\Domains\Users\Enums\EnumUserAccountType;
use App\Domains\Users\Enums\EnumUserActivityStatus;
use App\Domains\Users\Enums\EnumUserStaffRole;
use App\Domains\Users\Models\Tables\TableUser as u;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequestCreate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
             u::name_first => 'required|string',
             u::name_last => 'required|string',
             u::email => 'required|email|unique:users',
             u::name_handle => 'required|unique:users',
             u::password => 'required|string',
             u::avatar => 'nullable|url',
             u::staff_role => ['required', Rule::enum(EnumUserStaffRole::class)],
             u::activity_status => ['required', Rule::enum(EnumUserActivityStatus::class)],
             u::account_type => ['required', Rule::enum(EnumUserAccountType::class)],
        ];
    }
}
