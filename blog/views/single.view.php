<div id="wrapper">

	<div id="maincontent"> 

		<!-- This is a single Post -->	
		<? //print_r($post); ?>	<!--$post is an array of arrays -->    

		<div id="aboutTitle" >
			<h1><?= $post['title']; ?></h1>
		</div>
		
		<div id="aboutText"><p class="regTxt"><?= $post['body']; ?></p></div>

		<p><a href="index.php">Back</a></p>
		
		<div id="aboutWork" >
	    	<h1 >Check out my <span class="accent">latest work</span></h1>
	    </div>

		<div id="latestWork">
		    <a href="work.html" ><img src="../images/mpSml.png" class="smImg"/></a>
		    <a href="work.html" ><img src="../images/amsSml.png" class="smImg"/></a>
		    <a href="work.html" ><img src="../images/ccSml.png" class="smImg"/></a>
    	</div>
	</div>
</div>