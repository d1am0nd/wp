<?php

namespace App\Classes\Parsers;

class HtmlParser
{

    /**
     * @var string
     */
    protected $xpath, $doc; 

    /**
     * Constructor
     * $parser = new HtmlParser()
     *
     * @param array $params
     * @throws \Exception
     */
    public function __construct($html, $contextOptions = null)
    {
        libxml_use_internal_errors(true);
        $this->doc = $doc = new \DomDocument();
        $doc->loadHTML($html);
        $this->xpath = new \DOMXPath($doc);
    }

    /**
     * $element = div/span/...
     * $attribute = class/id/...
     * $attributeValue = row/col-md-6/...
     * 
     * Returns the value of $searchAttribute attribute
     */
    public function getDomAttVal($element, $attribute, $attributeValue, $searchAttribute)
    {
        $query = '//' . $element . '[@' . $attribute . '="' . $attributeValue . '"]/@' . $searchAttribute;
        $div = $this->xpath->query($query);
        $div = $div->item(0);
        if(!$div)
            return null;
        return $div->value;
    }

    /**
     * $element = div/span/...
     * $attribute = class/id/...
     * $attributeValue = row/col-md-6/...
     * 
     * Returns the content (stuff between <something></something>) of $searchAttribute attribute
     */
    public function getDomContent($element, $attribute, $attributeValue)
    {
        $query = '//' . $element . '[@' . $attribute . '="' . $attributeValue . '"]/text()[1]';
        $div = $this->xpath->query($query);
        $div = $div->item(0);
        if(!$div)
            return null;
        return $this->doc->saveXML($div);
    }

    public function getTitle()
    {
        $div = $this->xpath->query('//title')->item(0);
        if(!$div)
            return null;
        return $div->textContent;
    }
}
