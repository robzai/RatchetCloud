<?php
  class Node {
    // define attributes
    // they are public so that we can access them using $node->nodeid directly
    public $nodeid;
    public $contenttypeid;
    public $publishdate;
    public $title;
    public $parentid;
    public $lastcontent;
    public $lastcontentid;


    public function __construct($nodeid, $contenttypeid, $publishdate, $title, $parentid, $lastcontent, $lastcontentid) {
      $this->nodeid         = $nodeid;
      $this->contenttypeid  = $contenttypeid;
      $this->publishdate    = $publishdate;
      $this->title          = $title;
      $this->parentid       = $parentid;
      $this->lastcontent    = $lastcontent;
      $this->lastcontentid  = $lastcontentid;
    }


    public static function insert($id) {
      $db = Db::getInstance();
      //insert a new node
      $req = $db->prepare('INSERT INTO node (contenttypeid, publishdate, title, parentid)
                           VALUES (23, :publishdate, \'\', :parentid)'
                         );
      $insertTime = time();
      $req->execute(array('publishdate' => $insertTime, 'parentid' => $id) );
      $lastInsertId = $db->lastInsertId();
      //update its parient's lastcontent and lastcontentid
      $req = $db->prepare('UPDATE node
                           SET lastcontent = :lastcontentInsertTime, lastcontentid = :lastInsertId
                           WHERE nodeid = :id'
                          );
      $req->execute(array('lastcontentInsertTime' => $insertTime, 'lastInsertId' => $lastInsertId, 'id' => $id) );
      return $lastInsertId;
    }
    
  }
?>