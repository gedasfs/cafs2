<?php

namespace App\Classes;

use App\Traits\HtmlTag;

class FormBuilder
{
    use HtmlTag;
    
    public function open(string $action, string $method) : string
    {
        return $this->buildFormElement('form', ['action' => $action, 'method' => $method]);
    }

    public function close() : string
    {
        return $this->buildFormElement('/form');
    }

    public function label(string $idName, string $labelTxt) : string
    {
        return $this->buildFormElement('label', ['for' => $idName], $labelTxt, true, true);
    }

    public function input(string $type, ?string $placeholder = null, ?string $name = null, ?string $id = null) : string
    {   
        $attributes = $this->cleanArray(get_defined_vars());
        $inputStr = $this -> buildFormElement('input', $attributes, '', false, true);

        return $inputStr;
    }

    public function password(?string $placeholder = null, ?string $name = null, ?string $idName = null) : string
    {
        return $this->input('password', $placeholder, $name, $idName);
    }

    public function textarea(?string $placeholder = null, ?string $name = null, ?string $idName = null, int $rows = null, ?int $cols = null) : string
    {
        $attributes = $this->cleanArray(get_defined_vars());
        $inputStr = $this -> buildFormElement('textarea', $attributes, '', true, true);

        return $inputStr;
    }
    
    public function checkbox(?string $name = null, ?string $id = null, bool $checked = false) : string
    {
        $attributes = $this->cleanArray(get_defined_vars());
        $attributes['type'] = 'checkbox';

        if ($checked) {
            $attributes['checked'] = '';
        }

        return $this->buildFormElement('input', $attributes);
    }
    
    public function submit(string $btnTxt) : string
    {
        return $this -> buildFormElement('button', [], $btnTxt, true, false);
    }


    private function cleanArray(array $arr)
    {
        return array_filter($arr, function ($v) {
            return $v != null;
        });
    }
}