<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class DownloadFileRequest extends FormRequest
{
    public function downloadFile()
    {
        $id = $this->route('id');

        $fileName = "$id.pdf";

        if (Storage::disk('restrict_files')->missing($fileName)) {
            return abort(404);
        } else {
            return Storage::disk('restrict_files')->download($fileName);
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
