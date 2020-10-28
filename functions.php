<?php
/*----------------------------------------
Fetch rss feed from external web site and parse XML to extract attributes.
Write this code within functions.php of WordPress theme files.
----------------------------------------*/
function show_rss() {
    $html = "";
    // URL containing rss feed
    $url = "https://note.com/u5_asai/rss"; // Put URL which rss feed wanted to be fetched.
    $xml = simplexml_load_file($url); // Details -> php.net/manual/en/function.simplexml-load-file.php
    for($i = 0; $i < 5; $i++){ // Declare how much posts shoud be called with "for" syntax max value.
      
        $title = $xml->channel->item[$i]->title;
        $link = $xml->channel->item[$i]->link;
        $description = $xml->channel->item[$i]->description;
        $pubDate = $xml->channel->item[$i]->pubDate;
        $thumbnail = $xml->channel->item[$i]->children('media', true)->thumbnail; // For <Media:something> tag, need to declare "children(media, true) first to parse it. "
        
    
        $html .= "<a target='_blank' href='$link'><b>$title</b></a>"; // Title of post
        $html .= "$description"; // Description
        $html .= "<br />$pubDate<br /><br />"; // Date Published
        $html .= "<img src=$thumbnail alt='Thumbnail' style='width: 400px; height: auto;'>"; // Thumbnail of post
    }
    echo "$html<br />";
    }