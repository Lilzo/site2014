<?php

//FUNKCIJE- prikazivanje samo odredjenog broja rije�i iz stringa- koristi se u novostima

/* 	function citava_rijec( $str, $wordCount) 
  {
  return implode(
  '',
  array_slice(
  preg_split(
  '/([\s,\.;\?\!]+)/',
  $str,
  $wordCount*2+1,
  PREG_SPLIT_DELIM_CAPTURE
  ),
  0,
  $wordCount*2-1
  )
  );
  } */

function truncate($text, $length) {
    $length = abs((int) $length);
    if (strlen($text) > $length) {
        $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
    }
    return($text);
}

//velicina fajla 
function Size($path) {
    $bytes = sprintf('%u', filesize($path));
    if ($bytes > 0) {
        $unit = intval(log($bytes, 1024));
        $units = array('B', 'KB', 'MB', 'GB');

        if (array_key_exists($unit, $units) === true) {
            return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
        }
    }
    return $bytes;
}

function shortenText($nekiTekst, $brojacRijeci) {
    return implode(
            '', array_slice(
                    preg_split(
                            '/([\s,\.;\?\!]+)/', $nekiTekst, $brojacRijeci * 2 + 1, PREG_SPLIT_DELIM_CAPTURE
                    ), 0, $brojacRijeci * 2 - 1
            )
    );
}

?>