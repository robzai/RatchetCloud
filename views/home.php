<h3>TOPIC LIST:</h3>

<table class="table table-striped">
    <tr>
      <th>Topic</th>
      <th>Date</th> 
      <th>Replies</th>
      <th>Last Reply</th>
    </tr>

	<?php foreach($topics as $line) { ?>
	  <tr>
	  	<td> <a href='?controller=topic&action=show&id=<?php echo $line->nodeid; ?>'> <?php echo $line->title; ?> </a> </td>
	    <?php echo "<td>$line->publishdate</td>"; ?>
	    <?php echo "<td>$line->replies</td>"; ?>
	    <?php echo "<td>$line->lastcontent</td>"; ?>	    
	  </tr>
	<?php } ?>
  
</table>

