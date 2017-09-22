<?php
  class PagesController {
    public function home() {
      // using the getAll() function of TopicList to get all the topics
      $topics = TopicList::getAll();
      require_once('views/home.php');
    }

    public function error() {
      require_once('views/error.php');
    }
  }
?>