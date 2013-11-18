<!--

Create Post
This view is where the user can submit a new post. 

They can only access this page if they have logged in. 

-->

<div id="wrapper">
	<div id="maincontent"> 

	
        
    <div id="aboutTitle" >
	    <h1 style="float:left;">Create Post</h1>
	    <!--short tag echoing Log out Button-->
		<? if( is_logged_in() ) : ?>
		    <?= '<a href="../logout.php"><input type="button" value="Logout" style="width: 70px; float:right;"></a>';?>
		<? endif; ?>
    </div>
    
    <div id="contactform" class="folded">
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
			<ul>
				<li>
					<label for="title">Title: </label>
					<input type="text" name="title" id="title">

				</li>

				<li>
					<label for="body">Body: </label>
					<textarea name="body" id="title"></textarea>
				</li>

				<li>
					<input type="submit" value="Create Post">
				</li>

			</ul>

			<? if( isset($status) ) : ?>
				<p><?= $status; ?></p>
			<? endif ?>
        </form>
    </div>
	</div>

</div>