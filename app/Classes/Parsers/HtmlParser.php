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
    public function __construct($url)
    {
        libxml_use_internal_errors(true);
        $this->doc = $doc = new \DomDocument();
        $doc->loadHTML(file_get_contents($url));
        $this->xpath = new \DOMXPath($doc);
    }

    /**
     * $element = div/span/...
     * $attribute = class/id/...
     * $attributeValue = row/col-md-6/...
     * $searchAttribute = class/id/... 
     *
     * Returns the value of $searchAttribute attribute
     */
    public function getDomAttVal($element, $attribute, $attributeValue, $searchAttribute)
    {
        $query = '//' . $element . '[@' . $attribute . '="' . $attributeValue . '"]/@' . $searchAttribute;
        $div = $this->xpath->query($query);
        $div = $div->item(0);
        return $div->value;
    }

    public function getDomContent($element, $attribute, $attributeValue)
    {
        $query = '//' . $element . '[@' . $attribute . '="' . $attributeValue . '"]/text()[1]';
        $div = $this->xpath->query($query);
        $div = $div->item(0);
        return $this->doc->saveXML($div);
    }

    private function startsWith($haystack, $needle)
    {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
}
