<script type="text/javascript">       
        $(function() {
            $('.image').each(function() {
                $(this).hover(
                    function() {
                    $('.title', this).animate({ opacity: 1 })
                    },
                    function() {
                       $('.title', this).stop().animate({ opacity: 0});
                   })
                });
        });
</script>

<?php
 
//******************************************************************
//* Function to get the Full URL path in order to display images to
//******************************************************************
function getMyFullURL(){

try{
$pageURL = 'http';

 if (in_array("HTTPS",$_SERVER) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
 
 }
 catch (Exception $e){
    return "";
 }
}
//******************************************************************
//* Function to get the Full Path or Current Working Dir
//* in order to display images to
//******************************************************************

function getFullPath(){
return getcwd();
}
//Including the SimpleHtmlDom
include(getFullPath().'/simplehtmldom/simple_html_dom.php');

//*******************************************************
//* Funtion my_mine_content made as this was not 
//* supported by PHP ver 5.2
//*******************************************************

function my_mime_content_type($filename) {
 
        $mime_types = array(
 
            'txt' => 'text/plain',
             'htm' => 'text/html',
             'html' => 'text/html',
             'php' => 'text/html',
             'css' => 'text/css',
             'js' => 'application/javascript',
             'json' => 'application/json',
             'xml' => 'application/xml',
             'swf' => 'application/x-shockwave-flash',
             'flv' => 'video/x-flv',
 
            // images
             'png' => 'image/png',
             'jpe' => 'image/jpeg',
             'jpeg' => 'image/jpeg',
             'jpg' => 'image/jpeg',
             'gif' => 'image/gif',
             'bmp' => 'image/bmp',
             'ico' => 'image/vnd.microsoft.icon',
             'tiff' => 'image/tiff',
             'tif' => 'image/tiff',
             'svg' => 'image/svg+xml',
             'svgz' => 'image/svg+xml',
 
            // archives
             'zip' => 'application/zip',
             'rar' => 'application/x-rar-compressed',
             'exe' => 'application/x-msdownload',
             'msi' => 'application/x-msdownload',
             'cab' => 'application/vnd.ms-cab-compressed',
 
            // audio/video
             'mp3' => 'audio/mpeg',
             'qt' => 'video/quicktime',
             'mov' => 'video/quicktime',
 
            // adobe
             'pdf' => 'application/pdf',
             'psd' => 'image/vnd.adobe.photoshop',
             'ai' => 'application/postscript',
             'eps' => 'application/postscript',
             'ps' => 'application/postscript',
 
            // ms office
             'doc' => 'application/msword',
             'rtf' => 'application/rtf',
             'xls' => 'application/vnd.ms-excel',
             'ppt' => 'application/vnd.ms-powerpoint',
 
            // open office
             'odt' => 'application/vnd.oasis.opendocument.text',
             'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
         );
 
        $ext = strtolower(array_pop(explode('.',$filename)));
         if (array_key_exists($ext, $mime_types)) {
             return $mime_types[$ext];
         }
         elseif (function_exists('finfo_open')) {
             $finfo = finfo_open(FILEINFO_MIME);
             $mimetype = finfo_file($finfo, $filename);
             finfo_close($finfo);
             return $mimetype;
         }
         else {
             return 'application/octet-stream';
         }
     }
 
//***************************************************************
// Function to get images from local directory 
// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.
//***************************************************************
function getImages($dir)
{
	try{
    //global $imagetypes;
	$imagetypes = array("image/jpeg", "image/gif");

    // array to hold return value
    $retval = array();

    // add trailing slash if missing
    if(substr($dir, -1) != "/") $dir .= "/";
    // full server path to directory
   $fulldir = str_replace("//","/",getFullPath().$dir);
   $fulldir = str_replace("\\","/",getFullPath().$dir);
   
    $d = @dir($fulldir) or die("getImages: Failed opening directory $dir for reading");
	
    while(false !== ($entry = $d->read())) 
	{
      // skip hidden files
      if($entry == ".") continue;

      // check for image files
	  if (file_exists($fulldir.$entry)){
	  //echo "found it";
	  }    
	  if(in_array(my_mime_content_type($fulldir.$entry), $imagetypes)) 
	  {
        $retval[] = array(
         "file" => getMyFullURL().$dir.$entry,
         "size" => getimagesize($fulldir.$entry)
        );
      }
    }
    $d->close();

    return $retval;
	}
	catch (Exception $e){
		echo $e->getMessage();
		return -1;
	
	}
	
  } 

function showPapers(){
$html = new simple_html_dom();
// load the html file
  $html = file_get_html('http://www.kathimerini.com.cy/index.php?pageaction=kat&modid=1&sctid=40');
  
    //Display Cyprus Local Date
    date_default_timezone_set('Europe/Nicosia');
    $timezone = date_default_timezone_get();
	//echo Cyprus Local Date
    echo date('l jS \of F Y'). "<BR><BR>";
      
    //Get Date Stamp for files
    $today = getdate(date("U"));
    $date = $today['mday'].'_'.$today['month'].'_'.$today['year'];
    $displayDate = $today['mday'].' '.$today['month'].' '.$today['year'];
    //create a dir with name date as subfolder under root pathname
    $dir = $date;
	//echo $displayDate . "<BR><BR>";

	//Filetypes to display
	$imagetypes = array("image/jpeg", "image/gif");

	//Fetch image calling getImages function passing path
	$images_sm = getImages("http://cyprusnewspapers.eu/images/cyprusnewspapers/small/".$dir);
	$images_bg = getImages("http://cyprusnewspapers.eu/images/cyprusnewspapers/big/".$dir);
    
	//sort them so they print out in order
	sort($images_sm);
	sort($images_bg);
	
    //get the titles of the papers
    $ti=array();
	$index_t = 0;
    foreach($html->find('td[class=title2]') as $title_t)
    {
	   //save the cypriot news papers titles only (seven of them)
	   if ($index_t < 7)
	   {
         $ti[]=$title_t->plaintext;
		 $index_t++;
	   }
	}
	//Display image on page
	//For Cyprus Papers there are 8
	for ($i=0;$i< count($images_sm);$i++)
	{  
		echo '{modal url='.$images_bg[$i]['file'].'}<img alt='.$ti[$i].' title='.$ti[$i].' src="'.$images_sm[$i]['file'].'" width="120" height="198">{/modal}';  	
		//120x198			
	}
 } 
//end 

 ?>
 