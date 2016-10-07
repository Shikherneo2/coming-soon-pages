<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Travmunity - Travelling Community And Marketplace </title>
<script language="javascript" src="scripts/scripts.js"></script>
<link rel="stylesheet" type="text/css" href="style-sheets/promotional_style.css"/>
</head>
<body style="background:url(images/bg.jpg) no-repeat;background-size:cover;">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div align="center" class="header" dir="ltr"> <a href="index.php"><img src="images/logo_initial.png" style="width:270px; position:absolute; top:13px; left:20px;"></a> <a href="about_us.html"><div class='header_section' style="right:0px;">About Us</div></a> <a href="wishlist.php"><div class='header_section' style="right:100px; width:120px;">Wishlist</div></a>
<a href="how_it_works.html"><div class='header_section' style="right:220px;width:140px;">How It works</div></a>
</div>
<br><br>
<center>
<br><br><br><br><font face="Segoe UI, Verdana" color="#FFF" size=7><span style="background:#000;padding-left:10px;padding-right:10px;opacity:0.90;filter:alpha(opacity=90);">Experience Exotic Locales Like Never Before</span></font>
<br><br>
<font face="Segoe UI, Verdana" color="#FFF" size=5><span style="background:#000;padding-left:10px;padding-right:10px;opacity:0.90;filter:alpha(opacity=90);">Stop receiving any emails from us by Unsubscribing.</span></font>
<br><br><br>
<div style="position:relative; width:630px;">
<div class="bg_holder"></div>
<div style="position:absolute; left:0px; right:0px; top:15px;width:630px;">
<form action="unsubscribe.php" method="post" id="formMain">
<input type="text" value="Enter Your Email" id="email" name="email" onFocus="this.select()" onMouseUp="return false" onBlur="isEmpty(this)"> &nbsp;<input type="button" value="Unsubscribe" onclick="validateForm()"></form></div>
</div>
<br>
<a class="social_link" href="https://twitter.com/travmunity"><img src="images/Twitter-icon.png" height="40px"></a>&nbsp;&nbsp;&nbsp;<a class="social_link" href="https://www.facebook.com/travmunity"><img src="images/Facebook-icon.png" height="40px"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<fb:like href="https://www.facebook.com/travmunity" width="200" colorscheme="light" layout="standard" action="like" show_faces="false" send="false"></fb:like><br>

<?php 
	if(isset($_POST["email"])){
		
		$lengthOK = ( strlen($_POST['email']) <= 50 )? 1 :0;
		if( $lengthOK )
			$entryOK = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); 
			
		if( $lengthOK && $entryOK ){
			$db = new PDO('sqlite:newsletter_contacts.sqlite') or die("Oops. That is Embarrasing. Could You Try That Again");	
			
			$query = $db->prepare("SELECT id FROM contacts WHERE email=:email");
			$query->bindParam(':email', $_POST['email']);
			$result = $query->execute(); 
				
			if($result){
				$row = $query->fetch(PDO::FETCH_ASSOC);
				if(!$row)
					echo '<br><br><br><br><span style="font-family:Verdana, Geneva, sans-serif; font-size:18px;color:#FFF;background-color:#CB2834;border-radius:3px;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;" id="response">You Are Not Subscribed To Any Newsletter</span>';
				else{
					$qry = $db->prepare("DELETE FROM contacts WHERE email=:email");
					$qry->bindParam(':email', $_POST['email']);
					$result = $qry->execute();
					
					if($result === FALSE)
						echo '<br><br><br><br><span style="font-family:Verdana, Geneva, sans-serif; font-size:18px;color:#FFF;background-color:#CB2834;border-radius:3px;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;" id="response">Oops. That is Embarrasing. Could You Try That Again</span>';	
					else
						echo '<br><br><br><br><span style="font-family:Verdana, Geneva, sans-serif; font-size:18px;color:#FFF;background-color:#009754;border-radius:3px;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;" id="response">You Have Been Unsubscribed From The Newsletter</span>';
				}
			}
			else
				echo '<br><br><br><br><span style="font-family:Verdana, Geneva, sans-serif; font-size:18px;color:#FFF;background-color:#CB2834;border-radius:3px;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;" id="response">Oops. That is Embarrasing. Could You Try That Again</span>';	
			
		}
		else
			echo '<br><br><br><br><span style="font-family:Verdana, Geneva, sans-serif; font-size:18px;color:#FFF;background-color:#CB2834;border-radius:3px;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;" id="response">The Email you entered appears invalid. Please Try Again. Carefully this time.</span>';
	}
	else
		echo '<br><br><br><br><span style="font-family:Verdana, Geneva, sans-serif; font-size:18px;color:#FFF;background-color:#CB2834;border-radius:3px;" id="response"></span>';
?>
</font></span>
</center>

<span id="footer2">
<a href="mailto:contact@travmunity.com">contact@travmunity.com</a> &nbsp;|&nbsp; <a href="privacy_policy.html">Privacy Policy</a>
</span>
</body>
</html>
