<?php

namespace App\Traits;

trait HtmlTag
{
    public function buildElement(string $tagName, array $attributes = [], string $elTxt = '', bool $closingTag = false, bool $breakLine = false)
    {
        $attributesStr = '';

        foreach ($attributes as $name => $value) {
            $attributesStr .= "{$name}=\"{$value}\" ";
        }

        $elementStr = "<{$tagName} {$attributesStr}>";

        if ($closingTag) {
            $elementStr .= "{$elTxt}";
            $elementStr .= "</{$tagName}>";
        }

        if ($breakLine) {
            $elementStr .= "<br>";
        }

        return $elementStr;
    }
}