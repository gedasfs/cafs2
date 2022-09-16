<?php

namespace App\Traits;

trait HtmlTag
{
    private function buildElement(string $tagName, array $attributes = [], string $elTxt = '', bool $closingTag = false)
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

        return $elementStr;
    }
}