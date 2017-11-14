<?php

namespace Jsvrcek\ICS\Model;

/**
 * See https://tools.ietf.org/html/rfc5545#section-3.8.1.1
 *
 * Class CalendarAlarm
 * @package Jsvrcek\ICS\Model
 */

class CalendarAttach {

  private $uri;
  private $mimetype;
  private $content;
  private $name;

  public function setName($name) {
    $this->name = $name;
  }

  public function setContent($content) {
    $this->content = $content;
  }

  public function setMimeType($mimetype) {
    $this->mimetype = $mimetype;
  }

  public function setUri($uri) {
    $this->uri = $uri;
  }

  public function getString() {
    $this->buildContent();
    $output = 'ATTACH';
    if ($this->mimetype) {
      $output .= ';FMTTYPE=' . $this->mimetype;
    }
    if ($this->content) {
      $output .= ';ENCODING=BASE64;VALUE=BINARY';
      $output .= ':' . base64_encode($this->content);
    }
    return $output;
  }

  protected function buildContent() {
    if (is_null($this->content) && !is_null($this->uri)) {
      $this->content = file_get_contents($this->uri);
    }
  }

}
