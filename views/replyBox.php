<form action="http://localhost/ratchet/?controller=topic&action=reply" method="post">
  <div class="form-group">
  	<label for="text">Reply:</label>
  	<textarea id="text" name="text" class="form-control" rows="6"></textarea>
  </div>
  <input type="hidden" name="parentid" value=<?php echo $topic->nodeid; ?>>
  <input type="submit" class="btn btn-default">
</form>