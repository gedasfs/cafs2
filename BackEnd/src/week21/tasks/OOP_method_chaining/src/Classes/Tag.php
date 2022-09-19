<?php

namespace App\Classes;

use App\Traits;

class Tag
{
    use Traits\HtmlTag;

    private string $tagName;
    private string $text = '';
    private array $attributes;
    private bool $needsClosingTag = false;
    
    private const CLOSING_TAGS = [
        'a',
        'label',
        'p',
        'div',
        'span',
        'form',
        'button'
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

    public function get() : string
    {
        return $this->buildElement($this->tagName, $this->attributes, $this->text, $this->needsClosingTag);
    }

    public function show()
    {
        echo $this->get();
    }

}