<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wishlist</title>
<link rel="stylesheet" type="text/css" href="style-sheets/promotional_style.css"/>
<script src="scripts/wishlist_script.js"></script>
</head>

<body style="background:url(images/bg-blurred.jpg) fixed no-repeat;background-size:cover;">

<div align="center" class="header" dir="ltr"> <a href="index.php"><img src="images/logo_initial.png" style="width:270px; position:absolute; top:13px; left:20px;"></a> <a href="about_us.html"><div class='header_section' style="right:0px;">About Us</div></a> <a href="index.php"><div class='header_section' style="right:100px; width:120px;">Home</div></a>
<a href="how_it_works.html"><div class='header_section' style="right:220px;width:140px;">How It works</div></a>
</div>
<center>
<div style="border-radius:4px;background:#F0F0F0;text-align:justify; color:#3A3A3A; font-family:'Lucida 'Lucida Sans Unicode', 'Lucida Grande', sans-serif'; font-size:18px; margin:80px 180px 30px 180px; padding:30px 40px 20px 40px;-moz-box-shadow: 0 0 10px #000;-webkit-box-shadow: 0 0 10px #000;box-shadow: 0 0 10px #000;">
<strong><span style="color:#CB2834; font-size:22px;">We take your opinions seriously.<br>Tell us what you would like to see from a Travel Platform and we will do our best to give you the best Experience.</span></strong><br><br><hr size="1" ><br>
<span style="font-family:Verdana, Geneva, sans-serif; font-size:18px; color:#FF5151" id="response">

<?php

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['wishlist'])){

	if( $_POST['name'] == '' )
		echo 'You Left The Name Field Blank';
	else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) )
		echo 'The Email you entered appears invalid. Please Try Again. Carefully this time.';
	else if( $_POST['wishlist'] == '' )
		echo 'You Left The Suggestion Box Blank';
		
	else{
		$db = new PDO('sqlite:newsletter_contacts.sqlite') or die("Oops. That is Embarrasing. Could You Try That Again");	
			
		$query = $db->prepare("INSERT INTO wishlist VALUES(:name, :email, :wishlist)");
		$query->bindParam(':email', $_POST['email']);
		$query->bindParam(':name', $_POST['name']);
		$query->bindParam(':wishlist', $_POST['wishlist']);
		$result = $query->execute(); 
				
		if(!$result)
			echo 'Oops. That is Embarrasing. Could You Try That Again';
		
		else if(!isset($_POST['newsletter']))
			echo '<font color="#004000">Thank You for sharing your thoughts with us.</font>';
		
		else{	
				$query = $db->prepare("SELECT id FROM contacts WHERE email=:email");
				$query->bindParam(':email', $_POST['email']);
				$result = $query->execute(); 
				
				if($result){
					$row = $query->fetch(PDO::FETCH_ASSOC);
					
					if(!$row){
						$id = rand(1000000, 9999999);
						$query = $db->prepare("INSERT INTO contacts VALUES(:email, :uid,0)");
						$query->bindParam(':email', $_POST['email']);
						$query->bindParam(':uid', $id);
						
						if($query->execute())
							echo '<font color="#004000">Thank You for sharing your thoughts with us. You have been subscribed to our Newsletter.</font>';
						else
							echo "Oops. That is Embarrasing. Could You Try That Again<br>";
					}
					else
						echo '<font color="#004000">Thank You for sharing your thoughts with us. You are already subscribed to our Newsletter.</font>'; 
				}
				else
					echo "Oops. That is Embarrasing. Could You Try That Again<br>";
		}
	}
}

?>

</span>
<br><br>
<form method="post" action="wishlist.php" id="mainForm">
Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text id="name" name="name" onfocus="this.select()" onMouseUp="return false"><br><br>
Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text id="email" name="email" onfocus="this.select()" onMouseUp="return false"><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea id="wishlist" name="wishlist" onfocus="this.select()" onMouseUp="return false" onblur="textarea_blur(this)"> List out your suggestions is less than 150 words.</textarea><br><br> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name="newsletter" checked=true id="newsletter">&nbsp;&nbsp;<span style="cursor:pointer;" onclick="check()">Sign Me up for the Newsletter</span>
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input onClick="validate()" type=button value="Submit">
</form>
</div>
</center>
<br><br><br>
<span id="footer">
<a href="mailto:contact@travmunity.com">contact@travmunity.com</a> &nbsp;|&nbsp; <a href="unsubscribe.php">Unsubscribe</a> &nbsp;|&nbsp; <a href="privacy_policy.html">Privacy Policy</a>
</span>
</body>
</html>
