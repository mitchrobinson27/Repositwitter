<html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!--- Navbar --->
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    <a class="navbar-brand" href="#">
        <img alt="Brand" src="https://www.seeklogo.net/wp-content/uploads/2011/06/twitter-bird-vector-400x400.png" width = 32; height = 32;>
        
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Home</a>
    </div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<body>
<!-- Banner and profile picture -->
<div class="parent">
    <img src="https://i.ytimg.com/vi/mJP5qFwTprk/maxresdefault.jpg" alt="Nanalan" class="img-rounded" width="1270" height="300">
    <div class="inner"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/Smiley.svg/2000px-Smiley.svg.png" class="img-thumbnail" alt="Smiley face" width="128" height="128" /></div>
</div>
<style>
.parent{
    width:170px;
    height:360px;
    position:absolute;
    z-index:0;
}

.inner{
    position:absolute;
    z-index:1;
    bottom:0;
    right:0;
}
</style>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!--- Following Panel --->
    <div class="row">
        <div class="col-md-2">
    <div class="panel panel-primary">
    <div class="panel-heading">Following</div>
    <div class="panel-body">...</div>
    </div></div>
    <!--- Tweet Panel --->
        <div class="col-md-6 col-md-offset-1">
    <div class="panel panel-primary">
    <div class="panel-heading">Tweets</div>
    <div class="panel-body">xddddddd</div>
    </div></div>
	<!--- Trending Panel --->
        <div class="col-md-2 col-md-offset-10">
    <div class="panel panel-primary">
    <div class="panel-heading">Trending</div>
    <div class="panel-body">#Bootstrap</div>
</div></div></div>
	<?php
	    // pass in some info;
		require("../../../../../Applications/MAMP/htdocs/common.php"); 
		
		if(empty($_SESSION['user'])) { 
  
			// If they are not, we redirect them to the login page. 
			$location = "http://" . $_SERVER['HTTP_HOST'] . "/login.php";
			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
			//exit;
         
        	// Remember that this die statement is absolutely critical.  Without it, 
        	// people can view your members-only content without logging in. 
        	die("Redirecting to login.php"); 
    	} 
		
		// To access $_SESSION['user'] values put in an array, show user his username
		$arr = array_values($_SESSION['user']);
		echo "Welcome " . $arr[2];

		// open connection
		$connection = mysql_connect($host, $username, $password) or die ("Unable to connect!");

		// select database
		mysql_select_db($dbname) or die ("Unable to select database!");

		// create query
		$query = "SELECT * FROM symbols";
       
		// execute query
		$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());

		// see if any rows were returned
		if (mysql_num_rows($result) > 0) {

    		// print them one after another
			echo "<div class='panel panel-default'>";
			echo "<div class='panel-heading'>Countries National Animal</div>";
    		echo "<table cellpadding=10 border=1 class='table'>";
    		while($row = mysql_fetch_row($result)) {
        		echo "<tr>";
				echo "<td>".$row[0]."</td>";
        		echo "<td>" . $row[1]."</td>";
        		echo "<td>".$row[2]."</td>";
				echo "<td><a href=".$_SERVER['PHP_SELF']."?id=".$row[0].">Delete</a></td>";
        		echo "</tr>";
    		}
		    echo "</table>";

		} else {
			
    		// print status message
    		echo "No rows found!";
		}

		// free result set memory
		mysql_free_result($result);

		// set variable values to HTML form inputs
		$country = mysql_escape_string($_POST['country']);
    	$animal = mysql_escape_string($_POST['animal']);
		
		// check to see if user has entered anything
		if ($animal != "") {
	 		// build SQL query
			$query = "INSERT INTO symbols (country, animal) VALUES ('$country', '$animal')";
			// run the query
     		$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
			// refresh the page to show new update
	 		echo "<meta http-equiv='refresh' content='0'>";
		}
		
		// if DELETE pressed, set an id, if id is set then delete it from DB
		if (isset($_GET['id'])) {

			// create query to delete record
			echo $_SERVER['PHP_SELF'];
    		$query = "DELETE FROM symbols WHERE id = ".$_GET['id'];

			// run the query
     		$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
			
			// reset the url to remove id $_GET variable
			$location = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
			exit;
			
		}
		
		// close connection
		mysql_close($connection);

	?>
    
    <!-- This is the HTML form that appears in the browser -->
   	<form action="<?=$_SERVER['../../../../../Applications/MAMP/htdocs/PHP_SELF']?>" method="post">
    	Country: <input type="text" name="country">
    	National animal: <input type="text" name="animal">
    	<input type="submit" name="submit">
    </form>
    <form action="../../../../../Applications/MAMP/htdocs/logout.php" method="post"><button>Log out</button></form>
	</body>
</html>