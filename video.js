// Video extension, https://github.com/GiovanniSalmeri/yellow-video

"use strict";
window.addEventListener("DOMContentLoaded", function() {
    var iframes = document.querySelectorAll("iframes.video");
    iframes.forEach(function(iframe) {
        iframe.src = iframe.dataset.videoSrc || iframe.src;
    });
});
