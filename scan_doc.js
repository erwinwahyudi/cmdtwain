var base_url = 'http://localhost/cmdtwain/scanned_doc/';
var file_name = new Array;
var i = 1;

var scan_button = document.getElementById('scan');
var scan_button_from_ax = document.getElementById('scan_js');
var upload_button = document.getElementById('upload_img');

scan_button.addEventListener('click', function(){
	console.log('scanning...');
	$.ajax({
		type: 'post',
		url: 'scan_doc.php',
		data: {scan: 'true'},
		dataType: 'json'
	}).done(function(data){
		console.log(data);
		file_name[i] = data.file_name;
		i++;

		var image = '<img src="http://localhost/cmdtwain/scanned_doc/'+data.file_name+'" width="200px" id="scanned_img[]"></img>';
		$('#image_load').append(image);
		console.log('done');
	});
	console.log('scanning complete...');
}, false);


function convertImgToBase64(url, callback, outputFormat){
	var canvas = document.createElement('CANVAS');
	var ctx = canvas.getContext('2d');
	var img = new Image;
	img.crossOrigin = 'Anonymous';
	img.onload = function(){
		canvas.height = img.height;
		canvas.width = img.width;
	  	ctx.drawImage(img,0,0);
	  	var dataURL = canvas.toDataURL(outputFormat || 'image/png');
	  	callback.call(this, dataURL);
        // Clean up
	  	canvas = null; 
	};
	img.src = url;
}


upload_button.addEventListener('click', function(){
	console.log(file_name);

	imageUrl = base_url + file_name[1];
	console.log(imageUrl);
    convertImgToBase64(imageUrl, function(base64Img){
    	$.ajax({
	    	type: 'post',
	    	url: 'upload.php',
	    	data: {img_file: base64Img}
	    }).done(function(data){
	    	console.log(data);
	    });
    });
});


