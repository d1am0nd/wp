<?php

namespace App\Classes\Twitter;

class Message
{

    private $text, $tags, $url;

    /**
     * $text = Message to be sent. Will be shortened if needed, before message is sent
     * $tags = array of tags to include in the message, without # (exaple: ['hearthstone'])
     * $url = Link to be added (which will then be shortened to t.co and lenght will be 23, leaving 117 chars for tweet)
     */
    public function __construct($text, $tags = null, $url = null, $at = null) 
    {
        $this->text = $text;
        $this->tags = $tags;
        $this->url = $url;
        $this->at = $at;
    }

    /**
     * Setters
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    public function setTags($tags)
    {
        if(isset($this->tags) && is_array($tags))
            $this->tags = $tags;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Send Twitter message composed of $text, $tags and $url (if set).
     */
    public function compose()
    {
        return $this->composeMessage($this->text, $this->tags, $this->url, $this->at);
    }

    /**
     * Composes message form $text, $tags and $url.
     * Shortens $text accordingly.
     */
    private function composeMessage($text, $tags = null, $url = null, $at = null)
    {
        $tagsText = $this->makeTagsString($tags);
        $atsText = $this->makeAtString($at);
        $url = $url ? ' ' . $url : '';
        $urlLen = $url === '' ? 0 : 23;
        $at = $at ? $at : '';

        $messageText = $text . $tagsText . $url;
        // t.co twitters domain takes 23 chars for the url
        $messageTextLen = strlen($text . $tagsText . $atsText) + $urlLen;

        // Amount of chars to be shortened (if positive)
        $toShorten = $messageTextLen - 140;
        if($toShorten > 0){
            $toChar = strlen($text) - $toShorten;
            /**
             * If tags and link together take 140 chars
             * then post 'Check our www.wizard-poker.com #hearthstone' instead;
             */
            if($toChar < 0)
                $messageText = 'Check our www.wizard-poker.com #hearthstone';
            else
                $messageText = substr($text, 0, $toChar) . 
                    $tagsText . 
                    $url;
        }
        return $messageText;
    }

    /**
     * Takes array of tags and generates 
     */
    private function makeTagsString($tags)
    {
        return $this->makeCompositeString($tags, '#');
    }

    /**
     * Takes array of tags and generates 
     */
    private function makeAtString($ats)
    {
        return $this->makeCompositeString($ats, '@');
    }

    /**
     * Takes array of tags and generates 
     */
    private function makeCompositeString($array, $start)
    {
        if(isset($array) && is_array($array)){
            $arrayText = ' ';
            $arrayLen = count($array) - 1;
            foreach($array as $index => $item){
                $arrayText = $arrayText . $start . $item;
                // If there are tags to come, append space at the end
                if($index != $arrayLen)
                    $arrayText = $arrayText . ' ';
            }
            return $arrayText;
        }
        return '';
    }
}
