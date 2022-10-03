<?php

namespace App\Classes;

class Tag
{

    protected string $tagName;
    protected string $text = '';
    protected array $attributes;
    protected bool $needsClosingTag = false;
    
    protected const CLOSING_TAGS = [
        'a',
        'label',
        'p',
        'div',
        'span',
        'form',
        'button',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
    ];

    public function __construct($tagName)
    {
        $this->tagName = $tagName;
        $this->needsClosingTag = in_array(strtolower($tagName), self::CLOSING_TAGS);
    }

    public function setText(string $text) : Tag
    {
        $this->text = $text;

        return $this;
    }

    public function setAttr(string $name, string $value) : Tag
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    public function setMultAttrs(array $attributes) : Tag
    {   
        foreach ($attributes as $name => $value) {
            $this->attributes[$name] = $value;
        }

        return $this;
    }

    public function get() : string
    {
        return $this->buildElement($this->tagName, $this->attributes, $this->text, $this->needsClosingTag);
    }

    public function show() : void
    {
        echo $this->get();
    }

    public function buildElement(string $tagName, array $attributes = [], string $elTxt = '', bool $closingTag = false)
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