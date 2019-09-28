<?php
function head ($title, $desc, $keywords, $css, $scripts)
{
    echo
        '<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<meta name="author" content="Kurt Savio"/>
		<meta name="description" content="' . $desc . '"/>
		<meta name="keywords" content="' . $keywords . '"/>
		<title>' . $title . '</title>
		<link rel="icon" type="image/svg+xml" href= "images/favicon.svg"
		sizes="any"/>
		<link rel="icon" type="image/png" href= "images/favicon64.png"
		sizes="64x64"/>
		<link rel="icon" type="image/png" href= "images/favicon32.png"
		sizes="32x32"/>
		<link rel="icon" type="image/png" href= "images/favicon16.png"
		sizes="16x16"/>
		<link rel="icon" type="image/svg+xml" href= "images/favicon.svg"
		sizes="any"/>
		<link rel="stylesheet" type="text/css" href="';
    echo 'css/' . ((!($css)) ? 'style.css' : $css ) .'"/>';
    echo "\n";
    for ($i = 0; $i < count($scripts); $i++)
    {
        echo
            '		<script type="text/javascript" src="' . $scripts[$i] . '"></script>' . "\n";
    }
    echo
        '	</head>';
}
function foot ()
{
    echo '	    <footer>
		</footer>
    </body>
</html>';
}