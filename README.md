# Video 0.8.22

Embed videos.

<p align="center"><img src="video-screenshot.png?raw=true" alt="Screenshot"></p>

## How to install an extension

[Download ZIP file](https://github.com/GiovanniSalmeri/yellow-video/archive/main.zip) and copy it into your `system/extensions` folder. [Learn more about extensions](https://github.com/annaesvensson/yellow-update).

## How to embed a video

Create a `[video]` shortcut. 

The following arguments are available, all but the first argument are optional:
 
`Id` = file name or address or `id` of [supported video sources](#sources)  
`Style` = video style, e.g. `left`, `center`, `right`  
`Width` = video width, pixel or percent  
`Height` = video height, pixel or percent  

<a id="sources"></a>The following video sources are supported:

+ Local (file name of a local video, in `mp4`, `webm` or `ogg` format)  
+ Url (address of a video, in `mp4`, `webm` or `ogg` format)  
+ [Bilibili](https://www.bilibili.com)  
+ [Bitchute](https://www.bitchute.com)  
+ [DailyMotion](https://www.dailymotion.com)  
+ [Niconico](https://www.nicovideo.jp)  
+ [Odysee](https://odysee.com)  
+ [PeerTube](https://joinpeertube.org/) (`id` and `instance` in the form `id@instance`)  
+ [SoundCloud](https://soundcloud.com/)  
+ [talkies.tv](https://talkies.tv/)  
+ [TEDtalks](https://www.ted.com/talks/)  
+ [Utreon](https://utreon.com) (the `id` is to be prefixed with `>`)  
+ [VidLii](https://www.vidlii.com) (the `id` is to be prefixed with `!`)  
+ [Vimeo](https://vimeo.com/)  
+ [Wistia](https://wistia.net/)  
+ [YouTube](https://www.youtube.com)  

You should know that third-party providers collect personal data and use cookies.

## Examples

Embedding a video, different videos:

    [video my_video.webm]
    [video http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4]
    [video x8fdwjh]
    [video 52db3ab7-81e0-447b-a741-000375a369d9@video.violoncello.ch]
    [video e99D0gnqG-c]

Embedding a video, different sizes:

    [video x8fdwjh right 50%]
    [video x8fdwjh right 200 112]
    [video x8fdwjh right 400 224]

## Settings

The following settings can be configured in file `system/extensions/yellow-system.ini`:

`VideoStyle` = video style, e.g. `flexible`  
`VideoLocation` (default: `/media/videos/`) = location of local videos  

## Acknowledgements

This extension is based on [Youtube](https://github.com/annaesvensson/yellow-youtube) by Anna Svensson. Thank you for the good work. This extension uses [various sources](#sources) for the videos. Thank you for the free services.

## Developer

Giovanni Salmeri. [Get help](https://datenstrom.se/yellow/help/).
