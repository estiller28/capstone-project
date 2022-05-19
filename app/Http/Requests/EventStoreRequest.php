<?php

namespace App\Http\Requests;

use App\Models\Events;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventStoreRequest extends FormRequest
{
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
        $event_name = Rule::unique('events', 'event_name');
        if ($this->method() !== 'POST') {
            $event_name->ignore($this->events->id);
        }
        return [
            'event_name' => ['required', 'max:255', $event_name],
            'start_date' => 'required',
            'end_date'   => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i',
            'purpose'    => 'required',
        ];
    }

    public function messages()
    {
       return[
           'event_name.required' => 'Event name must have a value',
       ];
    }
}
