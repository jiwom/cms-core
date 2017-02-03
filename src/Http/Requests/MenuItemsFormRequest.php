<?php

namespace Yajra\CMS\Http\Requests;

class MenuItemsFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->authorizeResource('menu');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'        => 'required|max:255',
            'parent_id'    => 'required',
            'extension_id' => 'required',
            'url'          => 'required|max:255',
            'order'        => 'required|numeric|max:100',
        ];
    }
}
