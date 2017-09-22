<?php
  class TopicController {

    public function show() {
      // here expect a url of form ?controller=topicController&action=show&id=x
      // without an id we just redirect to the error page as we need the id to find it in the database
      if (!isset($_GET['id'])){
        return call('pages', 'error');
      }

      //use the given id to get the right topic and its text
      $topic = Topic::find($_GET['id']);
      require_once('views/topic.php');
      //use the given id to get its replies
      $replies = Reply::getAll($_GET['id']);
      require_once('views/reply.php');
      //shows the from for new reply
      require_once('views/replyBox.php');
    }

    public function reply() {
      //these two insert should be inside a transaction, try fix this if have time
      $lastInsertId = Node::insert($_POST["parentid"]);
      Text::insert($lastInsertId, $_POST["text"]);
      header("Location: http://localhost/ratchet/?controller=topic&action=show&id=" . $_POST["parentid"]);
    }

  }
?>