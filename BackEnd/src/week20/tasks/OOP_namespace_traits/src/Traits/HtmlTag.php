<?php

namespace App\Traits;

trait HtmlTag
{
    private function buildElement(string $tagName, array $attributes = [], string $elTxt = '', bool $closingTag = false)
    {
        $attributesStr = '';

        foreach ($attributes as $name => $value) {
            $attributesStr .= sprintf('%s="%s"', $name, $value);
        }

        $elementStr = sprintf('<%s %s>', $tagName, $attributesStr);

        if ($closingTag) {
            $elementStr .= sprintf('%s</%s>', $elTxt, $tagName);
        }

        return $elementStr;
    }
}