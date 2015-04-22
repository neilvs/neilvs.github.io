<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel="manifest" href="manifest.json">
  <!--Import materialize.css-->
  	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
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
		      <i class="large mdi-editor-mode-edit"></i>
		    </a>
		    <ul>
		      <li><a class="btn-floating red"><i class="large mdi-editor-insert-chart"></i></a></li>
		      <li><a class="btn-floating yellow darken-1"><i class="large mdi-editor-format-quote"></i></a></li>
		      <li><a class="btn-floating green"><i class="large mdi-editor-publish"></i></a></li>
		      <li><a class="btn-floating blue"><i class="large mdi-editor-attach-file"></i></a></li>
		    </ul>
  		</div>
		
		<button class="js-push-button">
			Enable notifications
		</button>
		<p id="console"></p>
		<div class="card">
	        <div onclick="Materialize.showStaggeredList('#comments')" class="card-image waves-effect waves-block waves-light">
	          <img class="activator" src="img/traffic.jpg">
	        </div>
	        <div class="card-content">
	          <span class="card-title activator grey-text text-darken-4">Eskom Issues <i class="mdi-navigation-more-vert right"></i></span>
	          <p>What happens when there is a power out</p>
	        </div>
	        <div class="card-reveal">
	          <span class="card-title grey-text text-darken-4">Eskom Issues <i class="mdi-navigation-close right"></i></span>
	          <ul class="staggered_list" id='comments'>
	          	<li>
	          		Comment 1
	          	</li>
	          	<li>
	          		Comment 2
	          	</li>
	          	<li>
	          		Comment 1
	          	</li>
	          	<li>
	          		Comment 2
	          	</li>
	          	<li>
	          		Comment 1
	          	</li>
	          	<li>
	          		Comment 2
	          	</li>
	          </ul>
	        </div>
      	</div>
		
		<div class="card">
	        <div class="card-image waves-effect waves-block waves-light effect">
	          <img class="activator" src="img/hipster.jpg">
	          <img class="activator filtre--r" src="img/hipster.jpg">
	        </div>
	        <div class="card-content">
	          <span class="card-title activator grey-text text-darken-4">Hipster High <i class="mdi-navigation-more-vert right"></i></span>
	          <p>What will become of us???</p>
	        </div>
	        <div class="card-reveal">
	          <span class="card-title grey-text text-darken-4">Card Title <i class="mdi-navigation-close right"></i></span>
	          <p>Here is some more information about this product that is only revealed once clicked on.</p>
	        </div>
      	</div>
		
		<br><br><br><br>
		
		
	</div>
	
	
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="js/jquery-2.1.1.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script>
  
  	var isPushEnabled = false;

	window.addEventListener('load', function() {
		  var pushButton = document.querySelector('.js-push-button'); 
		  pushButton.addEventListener('click', function() {  
		    if (isPushEnabled) {  
		      unsubscribe();  
		    } else { 
		       
		      subscribe();  
		    }  
		  });
		
		  // Check that service workers are supported, if so, progressively  
		  // enhance and add push messaging support, otherwise continue without it.  
		  if ('serviceWorker' in navigator) {
			  navigator.serviceWorker.register('sw.js').then(function(registration) {
			    // Registration was successful
			    console.log('ServiceWorker registration successful with scope: ',    registration.scope);
			    $('#console').text('ServiceWorker registration successful with scope: ',    registration.scope);
			  }).catch(function(err) {
			    // registration failed :(
			    console.log('ServiceWorker registration failed: ', err);
			    $('#console').text('ServiceWorker registration failed: '+ err);
			  });
			}
	});
	
	
	// Once the service worker is registered set the initial state  
	function initialiseState() {  
		
	  // Are Notifications supported in the service worker?  
	  if (!('showNotification' in ServiceWorkerRegistration.prototype)) {  
	    console.warn('Notifications aren\'t supported.');  
	    $('#console').text('Notifications aren\'t supported.');
	    return;
	  }
	
	  // Check the current Notification permission.  
	  // If its denied, it's a permanent block until the  
	  // user changes the permission  
	  if (Notification.permission === 'denied') {  
	    console.warn('The user has blocked notifications.');  
	    $('#console').text('The user has blocked notifications');
	    return;  
	  }
	
	  // Check if push messaging is supported  
	  if (!('PushManager' in window)) {  
	    console.warn('Push messaging isn\'t supported.');  
	    $('#console').text('Push messaging isn\'t supported.');
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
	          $('#console').text(subscription.subscriptionId);//end
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
	}
  
  
  
  
  
  
  
  
  
  
  
  	$(function(){
  		$(".button-collapse").sideNav();
  	})
  </script>
</body>
  </html>