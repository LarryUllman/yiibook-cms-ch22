<form class="form-inline" role="form" method="get">
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Email address</label>
    <input type="terms" class="form-control" id="terms" name="terms" placeholder="Search terms"<?php if (!empty($terms)) echo ' value="' . CHtml::encode($terms) . '"';?>>
  </div>
  <button type="submit" class="btn btn-default">Search</button>
</form>
<hr>