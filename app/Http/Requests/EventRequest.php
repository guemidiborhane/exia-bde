<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
                break;
            case 'POST':
                return [
                    'name' => 'required|max:255',
                    'planned_on' => 'required|date',
                    'description' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif'
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|max:255',
                    'planned_on' => 'required|date',
                    'description' => 'required',
                ];
                break;
            default:break;
        }
    }
}
