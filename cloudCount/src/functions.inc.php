<?php
function totalcount($paragraph)
  {
      $wordcount = str_word_count($paragraph);
      return $wordcount;
  }
