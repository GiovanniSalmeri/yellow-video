<?php
// Video extension, https://github.com/GiovanniSalmeri/yellow-video

class YellowVideo {
    const VERSION = "0.8.22";
    public $yellow;         // access to API

    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("videoStyle", "flexible");
        $this->yellow->system->setDefault("videoLocation", "/media/videos/");
    }

    // Handle page content of shortcut
    public function onParseContentShortcut($page, $name, $text, $type) {
        $output = null;
        if ($name=="video" && ($type=="block" || $type=="inline")) {
            list($id, $style, $width, $height) = $this->yellow->toolbox->getTextArguments($text);
            $services = [
                "url" => [ "/^\w+:.+/", "@0", "video" ],
                "local"=> [ "/^.+\.(?:mp4|webm|ogg)$/i", "@path@0", "video" ],
                "peertube" => [ "/^([A-Za-z0-9]{22}|[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12})@([A-Za-z0-9\-_]+(?:\.[A-Za-z0-9\-_]+)*)$/", "https://@2/videos/embed/@1?warningTitle=0", "iframe" ],
                "vimeo" => [ "/^[1-9][0-9]{0,8}$/", "https://player.vimeo.com/video/@0?dnt=1&texttrack=@lang&portrait=0", "iframe" ],
                "niconico" => [ "/^(?:sm|so|nm)[1-9][0-9]{0,7}$/", "https://embed.nicovideo.jp/watch/@0", "iframe" ],
                "youtube" => [ "/^[A-Za-z0-9_\-]{11}$/", "https://www.youtube.com/embed/@0?hl=@lang&modestbranding=1&rel=0", "iframe" ],
                "bilibili" => [ "/^(BV[A-Za-z0-9]{10})|av([1-9][0-9]{0,8})$/", "https://player.bilibili.com/player.html?aid=@1&danmaku=0&high_quality=1", "iframe" ],
                "dailymotion" => [ "/^([a-z0-9]{6,7}|[A-Za-z0-9]{19})(?:_.+)?$/", "https://www.dailymotion.com/embed/video/@1?subtitles-default=@lang&ui-logo=0", "iframe" ],
                "bitchute" => [ "/^[A-Za-z0-9]{12}$/", "https://www.bitchute.com/embed/@0/", "iframe" ],
                "tedtalks" => [ "/^[a-z0-9](?:[a-z0-9]|(?<!_)_){13,}[a-z0-9]$/", "https://embed.ted.com/talks/lang/@lang/@0", "iframe" ],
                "utreon" => [ "/^>([A-Za-z0-9_\-]{11})$/", "https://utreon.com/embed/@1", "iframe" ], // with prefix
                "vidlii" => [ "/^!([A-Za-z0-9_\-]{11})$/", "https://www.vidlii.com/embed?v=@1&a=0", "iframe" ], // with prefix
                "odysee" => [ "/^@[A-Za-z0-9\.\-_]+:./[A-Za-z0-9\.\-_]+:.$/", "https://odysee.com/$/embed/@0", "iframe" ],
                "wistia" => [ "/^[a-z0-9]{10}$/", "https://fast.wistia.net/embed/iframe/@0", "iframe" ],
                "talkies" => [ "/^[a-z0-9]{1,5}$/", "https://talkies.tv/embed/@0", "iframe" ],
            ];
            $templates = [
                "video" => "<video class=\"@type\" src=\"@src\" controls=\"controls\" preload=\"metadata\"@dim><p>@src</p></video>",
                "iframe" => "<iframe class=\"video @type\" src=\"@src\" frameborder=\"0\" allow=\"accelerometer; encrypted-media; gyroscope; picture-in-picture; fullscreen\" loading=\"lazy\" sandbox=\"allow-scripts allow-same-origin\"@dim><p>@src</p></iframe>",
            ];
            if (is_string_empty($style)) $style = $this->yellow->system->get("videoStyle");
            if (is_string_empty($height)) $height = $width;
            $width = $this->convertValueAndUnit($width, 640);
            $height = $this->convertValueAndUnit($height, 360);
            $output = "<div class=\"".htmlspecialchars($style)."\">";
            foreach ($services as $videoType=>list($pattern, $sourceTemplate, $element)) {
                if (preg_match($pattern, $id, $matches)) {
                    $sourceTemplate = str_replace("@lang", $page->get("language"), $sourceTemplate);
                    $path = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("videoLocation");
                    $sourceTemplate = strtr($sourceTemplate, array_combine([ "@path", "@0", "@1", "@2" ], array_pad(array_merge([ $path ], $matches), 4, "")));
                    $template = $templates[$element];
                    $template = str_replace("@type", "video-".$videoType, $template);
                    $template = str_replace("@dim", $width && $height ? " width=\"".htmlspecialchars($width)."\" height=\"".htmlspecialchars($height)."\"" : "", $template);
                    $template = str_replace("@src", htmlspecialchars($sourceTemplate), $template);
                    $output .= $template;
                    break;
                }
            }
            $output .= "</div>";
        }
        return $output;
    }

    // Return value according to unit
    public function convertValueAndUnit($text, $valueBase) {
        $value = $unit = "";
        if (preg_match("/([\d\.]+)(\S*)/", $text, $matches)) {
            $value = $matches[1];
            $unit = $matches[2];
            if ($unit=="%") $value = $valueBase * $value / 100;
        }
        return intval($value);
    }

    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            $extensionLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreExtensionLocation");
            $output .= "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$extensionLocation}video.css\" />\n";
        }
        return $output;
    }
}
