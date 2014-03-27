<?php

namespace Article\Entity;
use Illuminate\Database\Eloquent\Model as Model;

class Article extends Model
{
  private $id;

  private $title;

  public function getId()
  {
    return $this->id;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

}


