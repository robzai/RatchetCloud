<?php
  function call($controller, $action) {
    // require the file that matches the controller name
    require_once('controllers/' . $controller . '_controller.php');

    // create a new instance of the needed controller
    switch($controller) {
      case 'pages':
        // we need the model to query the database later in the controller
        require_once('models/topicList.php');
        $controller = new PagesController();
      break;
      case 'topic':
        // we need the model to query the database later in the controller
        require_once('models/topic.php');
        require_once('models/reply.php');
        require_once('models/node.php');
        require_once('models/text.php');
        $controller = new TopicController();
      break;
    }

    // call the action
    $controller->{ $action }();
  }

  // just a list of the controllers we have and their actions we consider those "allowed" values
  $controllers = array(
                        'pages' => ['home', 'error'],
                        'topic' => ['show', 'reply']
                      );

  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>