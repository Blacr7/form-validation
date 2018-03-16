<?php include('inc/header.php');?>
					
	<section class="content">				
						
			<?php if(count($error) != 0 || $_SERVER['REQUEST_METHOD'] != 'POST'){?>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="loginForm" novalidate>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" value="<?php echo $username;?>" placeholder="Username">
					<span class="error"><?php if(isset($error['username'])) echo $error['username'];?></span>
				</div>
				
				<div class="form-group">
					<label for="password">Password</label>
					<input type="text" name="password" id="password" placeholder="password">
					<span class="error"><?php if(isset($error['password'])) echo $error['password'];?></span>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Login">
					<span class="error"></span>
				</div>
			</form>
			
			<aside>
				<?php 
					echo "<p>Username: $loginDetails[0], Password: $loginDetails[1]</p>
							<p>Username: $loginDetails[2], Password: $loginDetails[3]</p>
							<p>Username: $loginDetails[4], Password: $loginDetails[5]</p>";
				?>
			</aside>
			
	<?php 
		} else{
			if(isset($_POST['submit'])){
				
				//$_SESSION["name"] == true;
				//echo "Hello " . $_SESSION['name']; 
				header('Location: upload.php');
				
			}
		}
	?>
</section>
<?php include('inc/footer.php');?>
					