<?php
// Video extension, https://github.com/GiovanniSalmeri/yellow-video

class YellowVideo {
    const VERSION = "0.9.2";
    public $yellow;         // access to API

    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("videoStyle", "flexible");
        $this->yellow->system->setDefault("videoLocation", "/media/videos/");
    }

    // Handle page content element
    public function onParseContentElement($page, $name, $text, $attributes, $type) {
        $output = null;
        if ($name=="video" && ($type=="block" || $type=="inline")) {
            list($name, $style, $width, $height) = $this->yellow->toolbox->getTextArguments($text);
            if (is_string_empty($style)) $style = $this->yellow->system->get("videoStyle");
            if (is_string_empty($height)) $height = $width;
            $width = $this->convertValueAndUnit($width, 640);
            $height = $this->convertValueAndUnit($height, 360);
            if (preg_match("/^\w+:.+/", $name)) {
                $src = $this->yellow->lookup->normaliseUrl("", "", "", $name);
            } elseif (preg_match("/^.+\.(?:mp4|webm|ogg)$/i", $name)) {
                $path = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("videoLocation");
                $src = $path.$name;
            } else {
                return null;
            }
            $output = "<div class=\"".htmlspecialchars($style)."\">";
            $dim = $width && $height ? " width=\"".htmlspecialchars($width)."\" height=\"".htmlspecialchars($height)."\"" : "";
            $output .= "<video class=\"".htmlspecialchars($style)."\" src=\"{$src}\" controls=\"controls\" preload=\"metadata\"{$dim}><p>{$src}</p></video>";
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
            $assetLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreAssetLocation");
            $output .= "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$assetLocation}video.css\" />\n";
        }
        return $output;
    }
}
