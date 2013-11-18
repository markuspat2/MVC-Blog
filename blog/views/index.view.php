<!-- 
	This is our view. A view is stupid.
	All it has is structure, no logic. 

-->


<div id="wrapper">

	<div id="maincontent"> 
		    
		<div id="aboutTitle" >
			<h1>Adventures in PHP</h1>
		</div>
		<!-- 

			This is a short way to write a for each loop. 

			This type of php can be loaded in a view because it is
			not performing any logic. It is simply looping around a 
			given array and displaying content.

		 -->

		<? foreach($posts as $post) : ?>
			<? //print_r($post); What's in this post? ?>
		    <article>
		        <!--Post Title-->
	            <!-- dynamic link wrapping the title of that specific post-->
	            <div id="aboutText">
	            	<a href="single.php?id=<?= $post['id']; ?>">
	                	<div id="aboutText"><h2><?= $post['title']; ?></h2></div>
	            	</a>
		        
		        <!--Post Body-->
		        
		        	<div id="aboutText"><p class="regTxt"><?= $post['body']; ?></p></div>
		        </div>

		    </article>
		<? endforeach; ?>

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

