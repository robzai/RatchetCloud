<?php
  class Topic {
    // define attributes
    // they are public so that we can access them using $topic->nodeid directly
    public $nodeid;
    public $publishdate;
    public $title;
    public $text;

    public function __construct($nodeid, $publishdate, $title, $text) {
      $this->nodeid         = $nodeid;
      $this->publishdate    = date('Y/m/d H:i:s', $publishdate);
      $this->title          = $title;
      $this->text           = $text;
    }

    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT t1.nodeid, publishdate, title, rawtext 
                           FROM node t1 LEFT JOIN text t2 ON t1.nodeid = t2.nodeid 
                           WHERE t1.nodeid = :id'
                         );
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $topic = $req->fetch();

      return new Topic($topic['nodeid'], $topic['publishdate'], $topic['title'], $topic['rawtext']);
    }
  }
?>