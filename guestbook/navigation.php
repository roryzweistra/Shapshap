<?php 
include_once("incs/config.inc.php");

mysql_connect("$host","$user","$password");
mysql_select_db("$db");

$tabel = "guestbook"; 

echo "<table align=\"center\" width=\"100%\"><tr>"; 
    if (empty($perpage)) $perpage = 10; 
    if (empty($pperpage)) $pperpage = 9;    //!!! ALLEEN 5,7,9,11,13 !!!! 
    if (empty($sort)) $sort = "desc"; 
    if (empty($offset)) $offset = 0; 
    if (empty($poffset)) $poffset = 0; 
    $amount = mysql_query("SELECT count(*) FROM $tabel"); 
    $amount_array = mysql_fetch_array($amount); 
    $pages = ceil($amount_array["0"] / $perpage); 
    $actpage = ($offset+$perpage)/$perpage; 
    $maxoffset = ($pages-1)*$perpage; 
    $maxpoffset = $pages-$pperpage; 
    $middlepage=($pperpage-1)/2; 
    if ($maxpoffset<0) {$maxpoffset=0;} 
    echo "<td>\n<center>"; 
    if ($pages) {  // alleen wanneer $pages>0 

        echo "$ad_pages\n"; 
    if ($offset) { 
            $noffset=$offset-$perpage; 
            $npoffset = $noffset/$perpage-$middlepage; 
        if ($npoffset<0) {$npoffset=0;} 
            if ($npoffset>$maxpoffset) {$npoffset = $maxpoffset;} 
        echo "<a href=\"$PHP_SELF?offset=0&poffset=0\"><<</a> "; 
        echo "<a href=\"$PHP_SELF?offset=$noffset&poffset=$npoffset\"><</a> "; 
        } 
        for($i = $poffset; $i< $poffset+$pperpage && $i < $pages; $i++) { 
        $noffset = $i * $perpage; 
            $npoffset = $noffset/$perpage-$middlepage; 
            if ($npoffset<0) {$npoffset = 0;} 
            if ($npoffset>$maxpoffset) {$npoffset = $maxpoffset;} 
        $actual = $i + 1; 
            if ($actual==$actpage) { 
         echo "| <b>$actual</b> | "; 
            } else { 
         echo "| <a href=\"$PHP_SELF?offset=$noffset&poffset=$npoffset\">$actual</a> | "; 
        } 
    } 
    if ($offset+$perpage<$amount_array["0"]) { 
            $noffset=$offset+$perpage; 
            $npoffset = $noffset/$perpage-$middlepage; 
            if ($npoffset<0) {$npoffset=0;} 
            if ($npoffset>$maxpoffset) {$npoffset = $maxpoffset;} 
        echo "<a href=\"$PHP_SELF?offset=$noffset&poffset=$npoffset\">></a> "; 
        echo "<a href=\"$PHP_SELF?offset=$maxoffset&poffset=$maxpoffset\">>></a> "; 
        } 
    } 
    echo "</center></td></tr>\n"; 
    echo "</table>\n"; 
?> 