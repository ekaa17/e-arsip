<?php

namespace App\Http\Requests\Setting\FileManagement;

use App\Models\SystemSettingModel;
use App\Traits\JsonValidationResponse;
use Illuminate\Foundation\Http\FormRequest;

class StoreFileManagementRequest extends FormRequest
{
    use JsonValidationResponse;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $allowedFormat = getSetting("allowed_file_types", 'pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png');
        $maxFileSize = getSetting('max_file_size', 10000);
        if ($this->method() == "PUT") {
            return [
                'user_id' => 'required|exists:users,id',
                'keterangan' => ['required', 'min:3', 'max:255'],
                'status' => 'required|in:1,0',
                'file' => $this->file('file') ? ['required', 'file', 'mimes:' . $allowedFormat, 'max:' . $maxFileSize] : ["required"]
            ];
        } else {
            return [
                'user_id' => 'required|exists:users,id',
                'keterangan' => ['required', 'min:3', 'max:255'],
                'status' => 'required|in:1,0',
                'file' => ['required', 'file', 'mimes:' . $allowedFormat, 'max:' . $maxFileSize]
            ];
        }
    }
}