<?php

namespace App\Classes;

use App\Traits\HtmlTag;

class FormBuilder
{
    use HtmlTag;
    
    public function open(string $action, string $method) : string
    {
        return $this->buildElement('form', ['action' => $action, 'method' => $method]);
    }

    public function close() : string
    {
        return $this->buildElement('/form');
    }

    public function label(string $idName, string $labelTxt) : string
    {
        return $this->buildElement('label', ['for' => $idName], $labelTxt, true);
    }

    public function input(string $type, ?string $placeholder = null, ?string $name = null, ?string $id = null) : string
    {   
        $attributes = $this->cleanArray(get_defined_vars());
        $inputStr = $this -> buildElement('input', $attributes, '');

        return $inputStr;
    }

    public function password(?string $placeholder = null, ?string $name = null, ?string $id = null) : string
    {
        return $this->input('password', $placeholder, $name, $id);
    }

    public function textarea(?string $placeholder = null, ?string $name = null, ?string $id = null, ?int $rows = null, ?int $cols = null) : string
    {
        $attributes = $this->cleanArray(get_defined_vars());
        $inputStr = $this -> buildElement('textarea', $attributes, '', true);

        return $inputStr;
    }
    
    public function checkbox(?string $name = null, ?string $id = null, bool $checked = false) : string
    {
        $attributes = $this->cleanArray(get_defined_vars());
        $attributes['type'] = 'checkbox';

        if ($checked) {
            $attributes['checked'] = '';
        }

        return $this->buildElement('input', $attributes);
    }
    
    public function submit(string $btnTxt) : string
    {
        return $this -> buildElement('button', [], $btnTxt, true);
    }

    private function cleanArray(array $arr)
    {
        return array_filter($arr, function ($v) {
            return $v != null;
        });
    }
}