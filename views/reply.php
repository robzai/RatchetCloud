<div>Replies: <?php echo count($replies) ?> </div>

<?php foreach($replies as $reply) { ?>
  <div class="panel panel-default">
	<div class="panel-body">
      <div><?php echo $reply->publishdate; ?></div>
      <div><?php echo $reply->text; ?></div>
    </div>
  </div>
<?php } ?> 