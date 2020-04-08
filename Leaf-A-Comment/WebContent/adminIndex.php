<?php
	session_start();

	$servername = "localhost";
	$dbUsername = "root";
	$password = "";
	$dbName = "test";
	$keyword = null;

	if (isset($_REQUEST["usersearch"])){
	    $keyword = $_REQUEST["usersearch"];
	}
	if (is_null($keyword))
	{
		$keyword = "%%";
	}
	else
	{
		$keyword = "%".$keyword."%";
	}

	$conn = mysqli_connect($servername,$dbUsername,$password,$dbName);
	$sql = "select * FROM users where username like '$keyword'";
	$result = mysqli_query($conn,$sql);
	

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Leaf A Comment</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/forall.css">
<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<header id="top">
		<img id="logo" alt="whoops" src="images/logo.png">
		<nav>
			<ul>
				<li class="navButton"><a href="main.php"><button>Home</button></a></li>
				<?php 
				    echo "<li class='navButton'><a href='manageaccount.html'><button>Account</button></a></li>";
					echo "<li class='navButton'><a href='logout.php'><button>Log Out</button></a></li>";
				?>
			</ul>	
		</nav>
	</header>
	
	<main>
		<p>
		<form id="anotherSearch" method="get" action="adminIndex.php">
			<button type="submit">Search User</button><input id="searchBar" type="text" name="usersearch" placeholder="type in username">
		</form>
		</p>
		</br>	
		
		<?php
			while($getData = mysqli_fetch_assoc($result))
			{
				$username = $getData["username"];
				$uid = $getData["uid"];
				echo "<p>";
				echo "<a href='deleteUser.php?uid=".$uid."'>Remove</a>";
				echo $username."</p>";
			}
			mysqli_close($conn); 

		?>

	</main>
	
	<footer>
		<nav>
			<ul>
				<li class="navButton"><a href="main.php"><button>Home</button></a></li>
				<?php 
					echo "<li class='navButton'><a href='manageaccount.html'><button>Account</button></a></li>";
					echo "<li class='navButton'><a href='logout.php'><button>Log Out</button></a></li>";
				?>
			</ul>
		</nav>
		<p>2020 &copy; Leaf A Comment</p>
		<a href="#top">back to top</a></span></p>
	</footer>
</body>
</html>

