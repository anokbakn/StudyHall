<?php
/**
*@author: Armand Nokbak
**/

?>
<div class="col-md-4">
</div>

<div class="col-md-4">
	<h3> Create forum topics here</h3>
	<form action="../forums/processNewTopic" method="POST" class="form-inline" role="form">
	  <div class="form-group">
	    <label >Forum name: </label>
	    <input type="text" class="form-control" name="forumName">
	  </div>
	  <div class="form-group">
	    <label >Forum description:</label>
	    <textarea class="form-control" rows="6" cols="22" name="forumDescription" > </textarea>
	  </div>
	  <div class="form-group" style="margin-top:10px">
	  <button type="submit" class="btn btn-primary">Submit</button>
	  </div>
	</form>
</div>

<div class="col-md-4">
</div>