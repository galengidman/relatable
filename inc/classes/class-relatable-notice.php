<?php

class Relatable_Notice {

    public $message;
    public $type;

    public function __construct($message, $type = 'info') {
        global $relatable_notices;

        $this->message = $message;
        $this->type = $type;

        $relatable_notices[] = $this;
    }

    public function html() {
        $html = [];

        $html[] = "<div class='notice notice-{$this->type}'>";
        $html[] = "<p>{$this->message}</p>";
        $html[] = '</div>';

        return join('', $html);
    }

}
