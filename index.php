<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel="manifest" href="manifest.json">
  <!--Import materialize.css-->
  	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection" data-noprefix/>
  	<link type="text/css" rel="stylesheet" href="css/main.css"  media="screen,projection"/>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
</head>

<body>
	
	<nav>
    	<div class="nav-wrapper">
	      <a href="#!" class="brand-logo">Life</a>
	      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
	      <ul class="right hide-on-med-and-down">
	        <li><a href="sass.html">Sass</a></li>
	        <li><a href="components.html">Components</a></li>
	        <li><a href="javascript.html">Javascript</a></li>
	        <li><a href="mobile.html">Mobile</a></li>
	      </ul>
	      <ul class="side-nav" id="mobile-demo">
	        <li><a href="sass.html">Sass</a></li>
	        <li><a href="components.html">Components</a></li>
	        <li><a href="javascript.html">Javascript</a></li>
	        <li><a href="mobile.html">Mobile</a></li>
	      </ul>
    	</div>
  	</nav>
	
	
	<div class="main">
		
		<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
		    <a class="btn-floating btn-large red">
		      <i class="mdi-image-add-to-photos"></i>
		    </a>
		    <ul>
		      <li onclick="$('#fileToUpload').trigger('click');">
		      	<a class="btn-floating green"><i class="large mdi-image-camera-alt"></i></a>
		      </li>
		    </ul>
  		</div>
		
		
		<button class="js-push-button">
			Enable notifications
		</button>
		<p id="console"></p>
		
		
		<div class="card add_card">
        	<div class="card-image">
            	<canvas id="PhotoEdit"></canvas>
              	<p contenteditable="true" class="card-title">Title</p>
              	<button class="image_button" id="sharpen_button" onclick="sharpen(0.25)">HDR</button>
              	<button class="image_button" id="restore_button" onclick="restore_canvas()">Restore</button>
            </div>
            <div class="card-content">
            	<p contenteditable="true">Description</p>
            	<div id="post_button">
            		
            		<span  class="btn btn-primary" onclick="uploadFile()">Post</span>
            	</div>
            	
            </div>
            <div id="add_cover_holder">
            	<div class="add_card_cover">
	            	<div class="loader"></div>
	            </div>
            </div>
            
            
        </div>
		
		<div class="main_cards">
			
			<?php
			$link = mysqli_connect('localhost', '', '', 'test');
			$query = "SELECT * FROM imager ORDER BY id DESC LIMIT 20";
			$result = mysqli_query($link, $query);
			while ($r = mysqli_fetch_assoc($result)){
				$id = $r['id'];	
				$image = $r['image'];
				$title = $r['title'];
				$description = $r['description'];
				?>
				<div class="card" data-id='<?php echo $id; ?>'>
	            	<div class="card-image">
	              		<img src="<?php echo $image; ?>" >
	              		<span class="card-title"><?php echo $title; ?></span>
	            	</div>
	            	<div class="card-content">
	              		<p>
	              			<?php echo $description; ?>
	              		</p>
	            	</div>
	          	</div>
				<?php
			}
			?>
				
			<br><br><br><br>
		</div>
		
		
		<!--- Hidden Elemets ------------------>
		 
		<form id="form1" enctype="multipart/form-data" method="post" action="savetofile.php">
		 	 <input type="file" name="fileToUpload" id="fileToUpload" onchange="fileSelected();" accept="image/*" />
		     <input type="button" onclick="uploadFile()" value="Upload" />
		 	<div id="details"></div>
		    <div id="progress"></div>
		</form>
		
		<div class="card skeleton">
	    	<div class="card-image">
	      		<img src="">
	      		<span class="card-title"></span>
	    	</div>
	    	<div class="card-content">
	      		<p>
	      			
	      		</p>
	    	</div>
	  	</div>
		
		
	</div>
	
	
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="js/jquery-2.1.1.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script src="js/exif2.js" type="text/javascript"></script>
  <script src="js/hammer.js" type="text/javascript"></script>
  <script src="js/prefixfree.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script>
  	
  	  	
	var myElement = document.getElementById('PhotoEdit');
	var hammertime = new Hammer(myElement);
	hammertime.on('pan', function(ev) {
    	
    	//console.log(ev);
    	
    	if (ev.direction == 4){
    		//console.log(ev.deltaX);
    		change = ev.deltaX / canvas.width;
    		//console.log('change value', change);
    		brightness(change);
    	}
    	if (ev.direction == 2){
    		//console.log(ev.deltaX);
    		change = ev.deltaX / canvas.width;
    		//console.log('change value', change);
    		brightness(change);
    	}
    	
	});
  	
  	
  	  	
  	
  	
  	$(document).on('focus','.add_card .card-title',function(){
  		//check if still default title
  		if ( $(this).text().trim() == 'Title' ){
  			$(this).text('');
  		}
  		$(this).removeClass('complete');
  	});
  	$(document).on('focus','.add_card .card-content p',function(){
  		if ( $(this).text().trim() == 'Description' ){
  			$(this).text('');
  		}
  	});	
  	
  	$(document).on('blur','.add_card .card-title',function(){
  		//check if still default title
  		if ( $(this).text().trim() == '' || $(this).text().trim() == 'Title' ){
  			$(this).text('Title').removeClass('complete');
  		} else {
  			$('.add_card .card-title').addClass('complete');
  		}
  		
  	});
  	
  	$(document).on('blur','.add_card .card-content p',function(){
  		if ( $(this).text().trim() == '' || $(this).text().trim() == 'Description' ){
  			$(this).text('Description');
  		}
  		
  		
  	});	
  	
  	$(document).on('keyup','.add_card .card-title, .add_card .card-content p',function(){
  		check_new_card_complete();
  	});
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	// ---------      PUSH NOTIFICATIONS    -----------------------------
  	
  	
  	var isPushEnabled = false;
	
	
	if ('serviceWorker' in navigator) {
		navigator.serviceWorker.register('sw.js').then(function(registration) {
				// Registration was successful
				console.log('ServiceWorker registration successful with scope: ',    registration.scope);
		}).catch(function(err) {
				// registration failed :(
				console.log('ServiceWorker registration failed: ', err);
		});
	}
	
	
	window.addEventListener('load', function() {
		  var pushButton = document.querySelector('.js-push-button'); 
		  pushButton.addEventListener('click', function() {  
		    if (isPushEnabled) {  
		      unsubscribe();  
		    } else { 
		      subscribe();  
		    }  
		  });
	});
	
	
	// Once the service worker is registered set the initial state  
	function initialiseState() {  
		
	  // Are Notifications supported in the service worker?  
	  if (!('showNotification' in ServiceWorkerRegistration.prototype)) {  
	    console.warn('Notifications aren\'t supported.');  
	   
	    return;
	  }
	
	  // Check the current Notification permission.  
	  // If its denied, it's a permanent block until the  
	  // user changes the permission  
	  if (Notification.permission === 'denied') {  
	    console.warn('The user has blocked notifications.');  
	    
	    return;  
	  }
	
	  // Check if push messaging is supported  
	  if (!('PushManager' in window)) {  
	    console.warn('Push messaging isn\'t supported.');  
	    
	    return;  
	  }
	
	  // We need the service worker registration to check for a subscription  
	  navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {  
	  	
	    // Do we already have a push message subscription?  
	    serviceWorkerRegistration.pushManager.getSubscription()  
	      .then(function(subscription) {  
	        // Enable any UI which subscribes / unsubscribes from  
	        // push messages.  
	        var pushButton = document.querySelector('.js-push-button');  
	        pushButton.disabled = false;
	
	        if (!subscription) {
	        	console.log('no saved subscription');  
	          // We aren't subscribed to push, so set UI  
	          // to allow the user to enable push  
	          return;  
	        }
	        
	        // Keep your server in sync with the latest subscriptionId
	        //sendSubscriptionToServer(subscription);
			console.log(subscription);
	        // Set your UI to show they have subscribed for  
	        // push messages  
	        pushButton.textContent = 'Disable Push Messages';  
	        isPushEnabled = true;  
	      })  
	      .catch(function(err) {  
	        console.warn('Error during getSubscription()', err);  
	      });  
	  });  
	}
  	
  	
  	
  	function subscribe() {  
	  // Disable the button so it can't be changed while  
	  // we process the permission request  
	  var pushButton = document.querySelector('.js-push-button');  
	  pushButton.disabled = true;
	
	  navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {  
	    serviceWorkerRegistration.pushManager.subscribe()  
	      .then(function(subscription) {  
	      	
	        // The subscription was successful  
	        isPushEnabled = true;  
	        pushButton.textContent = 'Disable Push Messages';  
	        pushButton.disabled = false;   
	          
	          console.log('subscription details: ',subscription);
	          //end
	        // TODO: Send the subscription.subscriptionId and   
	        // subscription.endpoint to your server  
	        // and save it to send a push message at a later date   
	        //return sendSubscriptionToServer(subscription);  
	      })  
	      .catch(function(e) {  
	        if (Notification.permission === 'denied') {  
	          // The user denied the notification permission which  
	          // means we failed to subscribe and the user will need  
	          // to manually change the notification permission to  
	          // subscribe to push messages  
	          console.warn('Permission for Notifications was denied');  
	          pushButton.disabled = true;  
	        } else {  
	          // A problem occurred with the subscription; common reasons  
	          // include network errors, and lacking gcm_sender_id and/or  
	          // gcm_user_visible_only in the manifest.  
	          console.error('Unable to subscribe to push.', e);  
	          pushButton.disabled = false;  
	          pushButton.textContent = 'Enable Push Messages';  
	        }  
	      });  
	  });  
	};
  

  	$(function(){
  		$(".button-collapse").sideNav();
  	});
  </script>
</body>
  </html>