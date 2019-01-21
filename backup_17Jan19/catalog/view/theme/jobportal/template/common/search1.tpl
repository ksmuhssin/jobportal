<div class="slidercaption1">
  <div class="off"></div>
     <h1>Register &amp; Find Your Job</h1>
	 <form method="post" enctype="multipart/form-data" id="category">
	   <div class="btn-group">
		  <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <span class="text">All Category </span><i class="fa fa-angle-down"></i></button>								<ul class="dropdown-menu dropdown-menu-right">
            <li><a href="#">Category 1</a></li>
            <li><a href="#">Category 2</a></li>
            <li><a href="#">Category 3</a></li>
            <li><a href="#">Category 4</a></li>
		  </ul>
       </div>
       <div class="btn-group">
		<button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="text">Select Location </span><i class="fa fa-angle-down"></i></button>
		<ul class="dropdown-menu dropdown-menu-right">
          <li><a href="#">Location 1</a></li>
          <li><a href="#">Location 2</a></li>
          <li><a href="#">Location 3</a></li>
          <li><a href="#">Location 4</a></li>
		</ul>
      </div>
      <div class="btn-group">
	    <input type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_search; ?>" class="form-control input-lg" />
	  </div>
      <div class="btn-group">
        <button type="button" class="btn" onclick="location.href='jobs.html'"><i class="fa fa-search" aria-hidden="true"></i>SEARCH</button>
	  </div>
	  <div class="center">
		<button class="btn-default">ADVANCE JOB SEARCH <i class="fa fa-plus-square-o" aria-hidden="true"></i></button>
	  </div>
	 </form>
</div>