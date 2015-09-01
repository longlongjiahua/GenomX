<?php namespace GenomeX\Http\Requests;

use GenomeX\Http\Requests\Request;

class TaskCreateFormRequest extends Request {

    public function rules()
    {
        return [
          'name' => 'required',
          'due' => 'required'
        ];
    }

    public function authorize()
    {
      return true;
    }

}
