<?php
  class TopicList {
    // define attributes
    // they are public so that we can access them using $topicList->nodeid directly
    public $nodeid;
    public $contenttypeid;
    public $publishdate;
    public $title;
    public $parentid;
    public $lastcontent;
    public $lastcontentid;
    public $replies;

    public function __construct($nodeid, $contenttypeid, $publishdate, $title, $parentid, $lastcontent, $lastcontentid, $replies = 0) {
      $this->nodeid         = $nodeid;
      $this->contenttypeid  = $contenttypeid;
      $this->publishdate    = date('Y/m/d H:i:s', $publishdate);
      $this->title          = $title;
      $this->parentid       = $parentid;
      $this->lastcontent    = date('Y/m/d H:i:s', $lastcontent);
      $this->lastcontentid  = $lastcontentid;
      if (is_null($replies)){
        $this->replies      = 0;
      }else{
        $this->replies      = $replies;
      }
    }


    public static function getAll() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * 
                         FROM
                            (SELECT * FROM node WHERE contenttypeid=22) s1
                         LEFT JOIN
                            (SELECT COUNT(nodeid) AS replies, parentid FROM node WHERE parentid != 81 GROUP BY parentid) s2
                         ON s1.nodeid = s2.parentid;
                       ');

      // we create a list of objects from the database results
      foreach($req->fetchAll() as $line) {
        $list[] = new TopicList($line['nodeid'], $line['contenttypeid'], $line['publishdate'],
                                $line['title'], $line['parentid'], $line['lastcontent'], $line['lastcontentid'], $line['replies'] );
      }

      return $list;
    }
    
  }
?>