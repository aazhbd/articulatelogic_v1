<?php
mysql_connect("localhost", "articulatelogic", "pass#100");
mysql_select_db("articulatelogic_main");

//mysql_connect("localhost", "root", "");
//mysql_select_db("alogicdbnew");

if(isset($_GET['f']))
    $url = $_GET['f'];

if($url == "")
    return;
    
$q = "select files.id as id, ftitle, filename, filepath, hitcount, category_id, files.uid as uid, email, remarks, meta_tags, files.date_inserted as date_inserted, files.date_updated as date_updated, files.state as state from files, categories, users where users.id = files.uid and category_id = categories.id and url = '$url'";

if($rs = mysql_query($q)){
    while($line = mysql_fetch_assoc($rs)){
        $data = $line;
    }
    
    if(count($data) == 0)
        return;
    
    $dcount = (int)$data['hitcount'] + 1;
    
    $qu = "update files set hitcount = $dcount , date_updated = '".date("Y-m-d H:i:s")."' where id = " . $data['id'];
    if(mysql_query($qu) === false)
        return;
        
    $file = "directories/fs/".trim($data['filepath']);
    
    if( !file_exists($file))
        return;
    
    $size = filesize($file);

    header('Content-Description: File Transfer'); 
    header("Content-type: application/force-download");
    header('Content-Disposition: inline; filename="' .trim($data['filename']) . '"');
    header("Content-Transfer-Encoding: Binary");
    header("Content-length: ".$size);
    header('Content-Type: application/octet-stream');            
    header("Content-Disposition: attachment; filename=" . trim($data['filename']) . "");
    header("Cache-control: private");
    readfile($file);
}
else
    return;
?>