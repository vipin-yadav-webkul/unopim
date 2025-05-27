<?php

namespace Webkul\DataTransfer\Validators\JobInstances\Import;

use Webkul\DataTransfer\Rules\SeparatorTypes;
use Webkul\DataTransfer\Validators\JobInstances\Default\JobValidator;

class CategoryJobValidator extends JobValidator
{
    /**
     * Validation rules for job instance
     */
    public function getRules(array $options): array
    {
        $this->rules['file'] = [
            empty($options['id']) ? 'required' : 'nullable',
            'mimes:csv,txt,xlsx,xls,html',
            'extensions:csv,xlsx,xls',
        ];

        $this->rules['field_separator'] = ['required', new SeparatorTypes];

        return $this->rules;
    }

    /**
     * Stores validation rules for data
     */
    protected array $rules = [
        'action'              => 'required:in:append,delete',
        'validation_strategy' => 'required:in:stop-on-errors,skip-errors',
        'allowed_errors'      => 'required|integer|min:0',
    ];

    /**
     * Names to be used for attributes during generation of error message
     */
    protected array $attributeNames = [
        'action'              => 'Action',
        'validation_strategy' => 'Validation Strategy',
        'allowed_errors'      => 'Allowed Errors',
        'field_separator'     => 'Field Separator',
        'file'                => 'File',
    ];

    /**
     * Add Custom error messages for validation
     */
    public function getMessages(array $options): array
    {
        return array_merge(parent::getMessages($options), [
            'file.mimes' => trans('validation.mimes', ['values' => 'csv,xls,xlsx']),
        ]);
    }
}
