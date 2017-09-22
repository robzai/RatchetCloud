<?php
  class Text {
    // define attributes
    // they are public so that we can access them using $text->nodeid directly
    public $nodeid;
    public $rawtext;

    public function __construct($nodeid, $rawtext) {
      $this->nodeid   = $nodeid;
      $this->rawtext  = $rawtext;
    }


    public static function insert($id, $text) {
      $db = Db::getInstance();
      $req = $db->prepare('INSERT INTO text (nodeid, rawtext)
                           VALUES (:nodeid, :rawtext)'
                         );
      $req->execute(array('nodeid' => $id, 'rawtext' => $text) );
      $id = $db->lastInsertId();
    }
    
  }
?>