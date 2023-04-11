# Video 0.8.22

Embed videos.

<p align="center"><img src="video-screenshot.png?raw=true" alt="Screenshot"></p>

## How to install an extension

[Download ZIP file](https://github.com/GiovanniSalmeri/yellow-video/archive/main.zip) and copy it into your `system/extensions` folder. [Learn more about extensions](https://github.com/annaesvensson/yellow-update).

## How to embed a video

Create a `[video]` shortcut. 

The following arguments are available, all but the first argument are optional:
 
`Source` = video source, [supported video sources](#sources)  
`Style` = video style, e.g. `left`, `center`, `right`  
`Width` = video width, pixel or percent  
`Height` = video height, pixel or percent  

<a id="sources"></a>The following video sources are supported:

`name` of a video (MP4, WEBM or OGG) in the `media/videos` folder  
`url` of a video (MP4, WEBM or OGG)  
`id` of a [bilibili](https://www.bilibili.com) video  
`id` of a [BitChute](https://www.bitchute.com) video  
`id` of a [DailyMotion](https://www.dailymotion.com) video  
`id` of a [Niconico](https://www.nicovideo.jp) video  
`id` of a [Odysee](https://odysee.com) video  
`id` and `instance` of a [PeerTube](https://joinpeertube.org/) video, written as `id@instance`  
`id` of a [talkies.tv](https://talkies.tv/) video  
`id` of a [TED Talks](https://www.ted.com/talks/) video  
`id` of a [Utreon](https://utreon.com) video, prefixed with `>`  
`id` of a [VidLii](https://www.vidlii.com) video, prefixed with `!`  
`id` of a [Vimeo](https://vimeo.com/) video  
`id` of a [Wistia](https://wistia.com/) video  
`id` of a [YouTube](https://www.youtube.com) video  

The `id` is the last part of the link with which the video is accessed.

You should know that third-party providers collect personal data and use cookies.

## Examples

Embedding a video, different videos:

    [video my_video.webm]
    [video https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4]
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
`VideoLocation` (default: `/media/videos/`) = location for videos  

## Acknowledgements

This extension is based on [Youtube](https://github.com/annaesvensson/yellow-youtube) by Anna Svensson. Thank you for the good work. This extension uses [various sources](#sources) for the videos. Thank you for the free services.

## Developer

Giovanni Salmeri. [Get help](https://datenstrom.se/yellow/help/).
