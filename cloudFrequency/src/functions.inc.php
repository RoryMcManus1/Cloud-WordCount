<?php
function totalfreq($paragraph, $word)
{
$freq = substr_count(strtolower($paragraph), strtolower($word));

return $freq;
}
