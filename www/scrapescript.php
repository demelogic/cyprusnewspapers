<?php
 

//*********************************************
//Function to get image from URL with CURL
//********************************************
 
function GetImageFromUrl($link)
{
 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch,CURLOPT_URL,$link);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result=curl_exec($ch);
	curl_close($ch);
	return $result;
 
}
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
//echo getFullPath().'/simplehtmldom/simple_html_dom.php'.'<BR>';

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
	  
	  if (file_exists($fulldir.$entry)){

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
	//print_r($retval);
    return $retval;
	}
	catch (Exception $e){
		echo $e->getMessage();
		return -1;
	
	}
	
  } 

scrapepapers();

//**********************************************************
//* Function that Adjusts the names of the smaller pictures 
//* links in order to get the bigger picture link image
//**********************************************************
function phpImageReplace($image){

$f=$image;

$f=str_replace('-s.jpg','-b.jpg',$f);
$f=str_replace('-S.jpg','-B.jpg',$f);
$f=str_replace('_s.jpg','_b.jpg',$f);
$f=str_replace('_s.jpg','-b.jpg',$f);           
$f=str_replace('sm.jpg','big.jpg',$f);
$f=str_replace('s.jpg','b.jpg',$f);          
$f=str_replace('S.jpg','B.jpg',$f);  
//$f=str_replace('S.jpg','b.jpg',$f);        
//echo 'phpimage replace'.'<BR>';

return $f;

}

function unicode_mk_cyr($str) {
     $encode = "";

     for ($ii=0;$ii<strlen($str);$ii++) {
         $xchr=substr($str,$ii,1);
         if (ord($xchr)>191) {
             $xchr=ord($xchr)+848;
             $xchr="&#" . $xchr . ";";
         }
         if(ord($xchr) == 129) {
               $xchr = "&#1027;";
         }
         if(ord($xchr) == 163) {
               $xchr = "&#1032;";
         }     
         if(ord($xchr) == 138) {
               $xchr = "&#1033;";
         }
         if(ord($xchr) == 140) {
               $xchr = "&#1034;";
         }
         if(ord($xchr) == 143) {
               $xchr = "&#1039;";
         }
         if(ord($xchr) == 141) {
               $xchr = "&#1036;";
         }   
         if(ord($xchr) == 189) {
               $xchr = "&#1029;";
         }                               
          
         if(ord($xchr) == 188) {
               $xchr = "&#1112;";
         }
         if(ord($xchr) == 131) {
               $xchr = "&#1107;";
         }
         if(ord($xchr) == 190) {
               $xchr = "&#1109;";
         }
         if(ord($xchr) == 154) {
               $xchr = "&#1113;";
         }
         if(ord($xchr) == 156) {
               $xchr = "&#1114;";
         }
         if(ord($xchr) == 159) {
               $xchr = "&#1119;";
         }
         if(ord($xchr) == 157) {
               $xchr = "&#1116;";
         }                                                   
         $encode=$encode . $xchr;
   }
     return $encode;
}
function scrapepapers()
{
  echo "Scraping Newspapers".'<BR>';
  $today = getdate(date("U"));
  $date = $today['mday'].'_'.$today['month'].'_'.$today['year'];
 
  //Display server timezone & time
  $servertimezone = date_default_timezone_get();
  echo "The current server timezone is: " . $servertimezone;
  $servertime = date(" H:i:s a");
  echo $servertime.'<BR>';
  echo str_replace("_"," ",$date)."<BR><BR>";
  
  //Display Cyprus Local Time
  date_default_timezone_set('Europe/Nicosia');
  $timezone = date_default_timezone_get();
  echo "The Local timezone is: " . $timezone;
  $time_cy = date(" H:i:s a");                         // 17:16:18
  echo "Local Time is: " .$time_cy.'<BR>';
  $datecy = date("j_F_Y");
  echo str_replace("_"," ",$datecy)."<BR><BR>";
  //create a dir with name date as subfolder under root pathname
  $dir = $datecy;
  
  $html = new simple_html_dom();

  // load the html file
  $html = file_get_html('http://www.kathimerini.com.cy/index.php?pageaction=kat&modid=1&sctid=40');

//***************************************************************
//*For Kathimerini's newspapers                              /
//***************************************************************

   ////root pathname to store the dated directory under (directories Big/Small)
   $rootpathname = getFullPath().'/images/cyprusnewspapers/small';
   echo 'Creating Small Dir:'.'<BR>';
   $rootpathname_bg = getFullPath().'/images/cyprusnewspapers/big';
   echo 'Creating Big Dir:'.'<BR>';
 
   //path where images are to reside under i.e. the date directory
   $dirpath = $rootpathname."/".$dir;
   echo 'Date Dir for small images' . '<BR>';
   $dirpath_bg = $rootpathname_bg."/".$dir;
   echo 'Date Dir for Big images' . '<BR>';
  
  $img_index=0;
 
//Get url for image being scraped save the image locally with 
//a different path and name
foreach($html->find('img') as $element)
	{
		//If the image has the text 'covers' in it save it in orig_img_path
		if (strpos($element->src,'covers')!==FALSE)
		{
		    
			$orig_img_path = 'http://www.kathimerini.com.cy/' .$element->src;
			$orig_img_path_bg = phpImageReplace('http://www.kathimerini.com.cy/' .$element->src);
			echo $orig_img_path."<BR>";
			echo $orig_img_path_bg."<BR>";
			//Store the image url in variable $contents 
			$contents=GetImageFromUrl($orig_img_path);			
			$contents_bg=GetImageFromUrl($orig_img_path_bg);
			
			//name of image file with an index
			$imagename = 'image'.$img_index.'.jpg';
			$imagename_bg = 'image'.$img_index.'.jpg';
			
			//full file path of the image to reside
			$filepathname = $dirpath ."/".'image'.$img_index.'.jpg';
			echo $dirpath ."/".'image'.$img_index.'.jpg'.'<BR>';
			$filepathname_bg = $dirpath_bg ."/".'image'.$img_index.'.jpg';
			echo $dirpath_bg ."/".'image'.$img_index.'.jpg'.'<BR>';
			
			//From this folder, I want to create a subfolder in the format: "23_Aug_2011".  
			//Also, I want to try and make this folder world-writable (CHMOD 0777). AND check if folder already exists..  
			if(!file_exists($rootpathname."/".$dir) OR !is_dir($rootpathname."/".$dir))
			{ 
			    mkdir($rootpathname."/".$dir, 0777);  
                echo 'Successfully Made dir' .$rootpathname. "/".$dir. '<BR>';				
			}  
			if(!file_exists($rootpathname_bg."/".$dir) OR !is_dir($rootpathname_bg."/".$dir))
			{ 
				mkdir($rootpathname_bg."/".$dir, 0777);  
                echo 'Successfully Made dir' .$rootpathname_bg. "/".$dir.'<BR>';				
			} 
			//save the cypriot news papers only (seven of them)
            if($img_index <7)
            {
              $savefile = fopen($filepathname, 'w');
			  $savefile_bg = fopen($filepathname_bg, 'w');
			  //write to dir
			  fwrite($savefile, $contents);
			  fclose($savefile);
			  fwrite($savefile_bg, $contents_bg);
			  fclose($savefile_bg);
            }
                        
			$img_index++;
                 
		}//endif	
	}//end for
 
echo 'end';
}//end
?>
