document.observe('dom:loaded', function(){
    $$('.form-buttons button').each(function(button)  {
        var title = button.readAttribute('title');
        if (title == 'Ship') {
            var click = button.readAttribute('onclick');
            button.setAttribute('onclick', click.replace('setLocation','checkPhoto'));
        }
    });
});


function checkPhoto(targetUrl) {
    var order_id;
    $$('#sales_order_view_tabs_order_info_content input[type="hidden"][name="order_id"]').each(function(input){
        order_id = input.value;
    });
    var url = window.location.href;
    url =   '/orderphoto/check/order/id/'+order_id;
    new Ajax.Request(url,
        {
            method:'get',
            parameters:{isAjax: true},
            onSuccess: function(transport){
                var response = transport.responseText || "no response text";
                if (response == order_id) {
                    setLocation(targetUrl);
                } else {
                    insertBox(targetUrl, response);
                }
            },
            onFailure: function(){ alert('Something went wrong...') }
        });
}

function insertBox(targetUrl, html) {


    $('sales_order_view_tabs_order_info_content').insert({top:html});

    // Grab elements, create settings, etc.
    var canvas = document.getElementById("canvas"),
        context = canvas.getContext("2d"),
        video = document.getElementById("video"),
        videoObj = { "video": true },
        errBack = function(error) {
            console.log("Video capture error: ", error.code);
        };

    // Put video listeners into place
    if(navigator.getUserMedia) { // Standard
        navigator.getUserMedia(videoObj, function(stream) {
            video.src = stream;
            video.play();
        }, errBack);
    } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
        navigator.webkitGetUserMedia(videoObj, function(stream){
            video.src = window.webkitURL.createObjectURL(stream);
            video.play();
        }, errBack);
    }
    else if(navigator.mozGetUserMedia) { // Firefox-prefixed
        navigator.mozGetUserMedia(videoObj, function(stream){
            video.src = window.URL.createObjectURL(stream);
            video.play();
        }, errBack);
    }
    // Trigger photo take
    document.getElementById("snap").addEventListener("click", function() {
        context.drawImage(video, 0, 0, 640, 480);
    });

    document.getElementById("savePhoto").addEventListener("click", function() {
        savePhotoAjax(targetUrl);
    });

}

function savePhotoAjax(targetUrl) {
    var order_id;
    $$('#sales_order_view_tabs_order_info_content input[type="hidden"][name="order_id"]').each(function(input){
        order_id = input.value;
    });
    var url =   '/orderphoto/save/photo/id/'+order_id;
    var canvas = document.getElementById('canvas');
    new Ajax.Request(url,
        {
            method:'post',
            parameters:{canvas: canvas.toDataURL('image/png')},
            onSuccess: function(transport){
                var response = transport.responseText || "no response text";
                if (response == order_id) {
                    setLocation(targetUrl);
                }
            },
            onFailure: function(){ alert('Something went wrong...') }
        });
}