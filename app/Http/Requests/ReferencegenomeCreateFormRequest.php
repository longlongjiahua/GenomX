<?php namespace GenomeX\Http\Requests;

use GenomeX\Http\Requests\Request;

class ReferencegenomeCreateFormRequest extends Request {

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
          'genomename' => 'required',
         'type' => 'required',
          'file' => 'required'
        ];
	}

}
