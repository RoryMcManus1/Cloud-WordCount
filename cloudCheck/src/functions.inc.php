<?php
function check($paragraph, $word)
{
    if (strpos(strtolower($paragraph), strtolower($word)) !== false)
        return 1;
    else
        return 0;
}
