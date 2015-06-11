var dataURL;
var canvas = $('#PhotoEdit')[0];
var ctx = canvas.getContext("2d");

function fileSelected() {
 
	
	var upload = document.getElementById('fileToUpload');
	if(upload.files.length === 0) return;
    var imageFile = upload.files[0];
	
	var transform = "none";
	var width;
	var height;
	
	
	var binaryReader = new FileReader();
	binaryReader.onload=function(d) {
				
		try{
			var exif2 = new ExifReader();
			exif2.load(d.target.result);
			var allTags = exif2.getAllTags();
							 
			if (allTags.Orientation.value === 8) {
			    transform = "left";
			} else if (allTags.Orientation.value === 6) {
			    transform = "right";
			}
			console.log('have exif data - transform: '+transform);
		}
		catch(e){
			console.log('no EXIF data');
		}
		
		binaryReader = null;
		
		var myURL = window.URL || window.webkitURL;
	    img = new Image();
	    
	    img.src = myURL.createObjectURL(imageFile);
	    img.onload = function () {
	    	
	    	img_width = img.width;
	    	img_height = img.height;
	    	
	    	if (transform !== 'none'){
	    		img_width = img.height;
	    		img_height = img.width;
	    	}
	    	
	    		
	    	var MAX_WIDTH = $('.card:not(.add_card)').innerWidth();
									
			ratio = img_height / img_width;
			console.log('ratio',ratio);
	    	
	        canvas.width = MAX_WIDTH;
	        canvas.height = MAX_WIDTH * ratio;
	        
	        width = MAX_WIDTH;
	        height = MAX_WIDTH * ratio;        
	        
	        w = img_width;
	        h = img_height;
	        
	        var can2 = document.createElement('canvas');
			can2.width = w/2;
			can2.height = h/2;
			var ctx2 = can2.getContext('2d');
			
			//work out how many times to downscale
			x = img_width / 480;
			downscale = 0;
			if (x >= 2){
				downscale = 2;
			}
			if (x >= 4){
				downscale = 4;
			}
			if (x >= 6){
				downscale = 6;
			}
						
			
	        if (transform !== 'none'){
	        	
	        	if (downscale >= 2){
	        		ctx2.drawImage(img, 0, 0, w/2, h/2);
	        	}
	        	if (downscale >= 4){
	        		ctx2.drawImage(can2, 0, 0, w/2, h/2, 0, 0, w/4, h/4);
	        	}
		    	if (downscale >= 6){
	        		ctx2.drawImage(can2, 0, 0, w/4, h/4, 0, 0, w/6, h/6);
	        	}
		    		    		        		        	
	        	ctx.translate(width/2, height/2);
	        	//ctx2.translate(can2.width/2, can2.height/2);
	        	if (transform == 'left'){
		        	ctx.rotate(-90 * Math.PI/180);
		        }
		        if (transform == 'right'){
		        	ctx.rotate(90 * Math.PI/180);
		        }
	        	ctx.translate(-height/2, -width/2);
	        	
	        	if (downscale == 0){
	        		ctx.drawImage(img, 0, 0, height, width);
	        	}
				if (downscale >= 2){
	        		ctx.drawImage(can2, 0, 0, w/2, h/2, 0, 0, height, width);
	        	}
	        	if (downscale >= 4){
	        		ctx.drawImage(can2, 0, 0, w/4, h/4, 0, 0, height, width);
	        	}
		    	if (downscale >= 6){
	        		ctx.drawImage(can2, 0, 0, w/6, h/6, 0, 0, height, width);
	        	}
	        	//ctx.drawImage(can2, 0, 0, w/4, h/4, 0, 0, height, width);
	        } else {
	        	
	        	if (downscale >= 2){
	        		ctx2.drawImage(img, 0, 0, w/2, h/2);
	        	}
	        	if (downscale >= 4){
	        		ctx2.drawImage(can2, 0, 0, w/2, h/2, 0, 0, w/4, h/4);
	        	}
		    	if (downscale >= 6){
	        		ctx2.drawImage(can2, 0, 0, w/4, h/4, 0, 0, w/6, h/6);
	        	}
	        	
	        	if (downscale == 0){
	        		ctx.drawImage(img, 0, 0, width, height);
	        	}
	        	if (downscale >= 2){
	        		ctx.drawImage(can2, 0, 0, w/2, h/2, 0, 0, width, height);
	        	}
	        	if (downscale >= 4){
	        		ctx.drawImage(can2, 0, 0, w/4, h/4, 0, 0, width, height);
	        	}
		    	if (downscale >= 6){
	        		ctx.drawImage(can2, 0, 0, w/6, h/6, 0, 0, width, height);
	        	}
	        }	
	        
	       
	        myURL.revokeObjectURL(img.src);
	        img = null;
			
			dataURL = canvas.toDataURL("image/png");
			
			save_canvas();
						
			//show add card, scroll to top
			$('.main').scrollTop(0);
			$('.add_card').slideDown();
					
	    };

	};
	
	binaryReader.readAsArrayBuffer(imageFile);
	
	
	
}

function uploadFile() {
 	
 	//show cover
 	$('#add_cover_holder').show();
 	
	var fd = new FormData();
    var count = document.getElementById('fileToUpload').files.length;
    for (var index = 0; index < count; index ++){
   		var file = document.getElementById('fileToUpload').files[index];
        //fd.append('myFile', file);
 	}
 	fd.append('myFile', dataURL);
 	title = $('.add_card .card-title').text().trim();
 	description = $('.add_card .card-content p').text().trim();
 	fd.append('title',title);
 	fd.append('description',description);
 	
 	
   	var xhr = new XMLHttpRequest();
    xhr.upload.addEventListener("progress", uploadProgress, false);
    xhr.addEventListener("load", uploadComplete, false);
    xhr.addEventListener("error", uploadFailed, false);
    xhr.addEventListener("abort", uploadCanceled, false);
    xhr.open("POST", "savetofile.php");
    xhr.send(fd);

}
 
function uploadProgress(evt) {
	if (evt.lengthComputable) {
    	var percentComplete = Math.round(evt.loaded * 100 / evt.total);
        document.getElementById('progress').innerHTML = percentComplete.toString() + '%';
        console.log('Percent Complete',percentComplete);
  	} else {
       	document.getElementById('progress').innerHTML = 'unable to compute';
    }
}
 
function uploadComplete(evt) {
   	/* This event is raised when the server send back a response */
    console.log(evt.target.responseText);
       
    //fetch latest updates
    get_recent_after();
   
    
}
 
function uploadFailed(evt) {
   	alert("There was an error attempting to upload the file.");
}

function uploadCanceled(evt) {
  	alert("The upload has been canceled by the user or the browser dropped the connection.");
}

function check_new_card_complete(){
	valid = true;
	title = $('.add_card .card-title').text().trim();
	if (title == 'Title' || title == ''){
		valid = false;
	}
	description = $('.add_card .card-content p').text().trim();
	
	if (description == 'Description' || description == ''){
		valid = false;
	}

	if (valid){
		//show option to save
		$('#post_button').addClass('show');
	} else {
		$('#post_button').removeClass('show');
	}
}


function get_recent_after(){
	last_id = $('.card:not(.add_card)').data('id');
	$.post('get_recent.php',{last_id:last_id},function(data){
		console.log(data);
		 //hide the new post
    	$('.add_card').hide();
		$('#add_cover_holder').hide();
		$('#post_button').removeClass('show');
		//clear add card filter
	    // TODO canvas.clearRect(0,0,canvas.width, canvas.height);
	    $('.add_card .card-title').text('Title').removeClass('complete');
	    $('.add_card .card-content p').text('Description');
		
		json = JSON.parse(data);
		
		for (var i=0; i < json.length; i++) {
			
			$clone = $('.card.skeleton').clone();
			$clone.attr('data-id',json[i].id);
			$clone.find('img').attr('src',json[i].image);
			$clone.find('.card-title').text(json[i].title);
			$clone.find('.card-content p').text(json[i].description);
			$clone.removeClass('skeleton');
			$('.main_cards').prepend($clone);
			
		};
		
	});
	
}

var cached_img_data;
function save_canvas(){
	cached_img_data = ctx.getImageData(0,0,canvas.width,canvas.height);
}
function restore_canvas(){
	ctx.putImageData(cached_img_data, 0, 0);
	$('#restore_button').removeClass('show');
	$('#sharpen_button').removeClass('fadeOut');
}

function brightness(adjustment){
	ctx = canvas.getContext("2d");
	img_data = ctx.getImageData(0,0,canvas.width,canvas.height);
	d = img_data.data;
	//brightness
	
	for (var i = 0; i < d.length; i += 4){
		d[i] += adjustment;
		d[i+1] += adjustment;
		d[i+2] += adjustment;
	}
	
	ctx.putImageData(img_data, 0, 0); 
	
}


/// sharpen image:
/// USAGE:
///    sharpen(context, width, height, mixFactor)
///  mixFactor: [0.0, 1.0]
function sharpen(mix) {
	
	w = canvas.width;
	h = canvas.height;
	
    var weights = [0, -1, 0, -1, 5, -1, 0, -1, 0],
        katet = Math.round(Math.sqrt(weights.length)),
        half = (katet * 0.5) | 0,
        dstData = ctx.createImageData(w, h),
        dstBuff = dstData.data,
        srcBuff = ctx.getImageData(0, 0, w, h).data,
        y = h;

    while (y--) {

        x = w;

        while (x--) {

            var sy = y,
                sx = x,
                dstOff = (y * w + x) * 4,
                r = 0,
                g = 0,
                b = 0,
                a = 0;

            for (var cy = 0; cy < katet; cy++) {
                for (var cx = 0; cx < katet; cx++) {

                    var scy = sy + cy - half;
                    var scx = sx + cx - half;

                    if (scy >= 0 && scy < h && scx >= 0 && scx < w) {

                        var srcOff = (scy * w + scx) * 4;
                        var wt = weights[cy * katet + cx];

                        r += srcBuff[srcOff] * wt;
                        g += srcBuff[srcOff + 1] * wt;
                        b += srcBuff[srcOff + 2] * wt;
                        a += srcBuff[srcOff + 3] * wt;
                    }
                }
            }

            dstBuff[dstOff] = r * mix + srcBuff[dstOff] * (1 - mix);
            dstBuff[dstOff + 1] = g * mix + srcBuff[dstOff + 1] * (1 - mix);
            dstBuff[dstOff + 2] = b * mix + srcBuff[dstOff + 2] * (1 - mix)
            dstBuff[dstOff + 3] = srcBuff[dstOff + 3];
        }
    }

    ctx.putImageData(dstData, 0, 0);
    
    $('#restore_button').addClass('show');
    $('#sharpen_button').addClass('fadeOut');
    
}






