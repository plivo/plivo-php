<?php

namespace Plivo\Util;

// Header class
class Header {
    public $type;
    public $text;
    public $media;

    public function __construct(array $data)
    {
        $this->type = $data['type'] ?? null;
        $this->text = $data['text'] ?? null;
        $this->media = $data['media'] ?? null;
    }
}

// Body class
class Body {
    public $text;

    public function __construct(array $data)
    {
        $this->text = $data['text'] ?? null;
    }
}

// Footer class
class Footer {
    public $text;

    public function __construct(array $data)
    {
        $this->text = $data['text'] ?? null;
    }
}

// Buttons class
class Buttons {
    public $id;
    public $title;
    public $cta_url;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->cta_url = $data['cta_url'] ?? null;
    }
}

// Row class
class Row {
    public $id;
    public $title;
    public $description;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->description = $data['description'] ?? null;
    }
}

// Section class
class Section {
    public $title;
    public $rows;

    public function __construct(array $data)
    {
        $this->title = $data['title'] ?? null;
        $this->rows = array_map(function($row) { return new Row($row); }, $data['rows'] ?? []);
    }
}

// Action class
class Action {
    public $buttons;
    public $sections;

    public function __construct(array $data)
    {
        $this->buttons = array_map(function($btn) { return new Buttons($btn); }, $data['buttons'] ?? []);
        $this->sections = array_map(function($section) { return new Section($section); }, $data['sections'] ?? []);
    }
}

// Interactive class
class Interactive {
    public $type;
    public $header;
    public $body;
    public $footer;
    public $action;

    public function __construct(array $data)
    {
        $this->type = $data['type'] ?? null;
        $this->header = new Header($data['header'] ?? []);
        $this->body = new Body($data['body'] ?? []);
        $this->footer = new Footer($data['footer'] ?? []);
        $this->action = new Action($data['action'] ?? []);
    }

    public function validateInteractive(string $interactive)
    {
        // Additional validation logic can be implemented here if needed
        if(is_null(json_decode($interactive, true))) {
            return "Invalid JSON data for interactive messages!";
        }
        //Instantiate and validate the Interactive class
        $interactive = new Interactive(json_decode($interactive, true));
        return null;
    }
}
