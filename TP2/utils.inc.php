<?php
function start_page ($Title)
{
    echo '<! DOCTYPE html>
            <html lang = fr>
                <head>
                    <title>' . $Title . '</title>
                </head>
                <body>' . "\n";
};

function end_page()
{
    echo '</body></html>';
};
?>