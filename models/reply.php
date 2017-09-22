<?php
  class Reply {
    // define attributes
    // they are public so that we can access them using $reply->nodeid directly
    public $nodeid;
    public $publishdate;
    public $parentid;
    public $text;

    public function __construct($nodeid, $publishdate, $parentid, $text) {
      $this->nodeid         = $nodeid;
      $this->publishdate    = date('Y/m/d H:i:s', $publishdate);
      $this->parentid       = $parentid;
      $this->text           = $text;
    }

    public static function getAll($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT t1.nodeid, publishdate, parentid, rawtext 
                           FROM node t1 LEFT JOIN text t2 ON t1.nodeid = t2.nodeid 
                           WHERE t1.parentid = :id'
                         );
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      // we create a list to store objects from the database results
      $list = [];
      foreach($req->fetchAll() as $reply) {
        $list[] = new Reply($reply['nodeid'], $reply['publishdate'], $reply['parentid'], $reply['rawtext'] );
      }

      return $list;
    }
  }
?>