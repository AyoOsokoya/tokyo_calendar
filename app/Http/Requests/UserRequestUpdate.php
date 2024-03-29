<?php

namespace App\Http\Requests;

use App\Domains\Users\Enums\EnumUserAccountType;
use App\Domains\Users\Enums\EnumUserActivityStatus;
use App\Domains\Users\Enums\EnumUserStaffRole;
use App\Domains\Users\Models\Tables\TableUser as u;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO: Check if user is authorized to make this request
        return true;
    }

    public function rules(): array
    {
        return [
            u::name => 'required|string',
            u::email => 'required|email|unique:users',
            u::handle => 'unique:users', // TODO: Don't allow normal user to change handle
            u::password => 'required|string',
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
            // TODO: Don't allow normal user to change account_type
            u::account_type => [
                // 'required',
                'nullable',
                Rule::enum(EnumUserAccountType::class)
            ],
        ];
    }
}
