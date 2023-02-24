<?php
  require_once("Connect.php"); 
  session_start();
  $User=$_SESSION['User_ID'];
$SUser_id=$_POST['SUser_id'];

require('fpdf/fpdf.php');
require_once 'FPDI/fpdi.php';
 

class PDF_Rotate extends FPDI {

var $angle = 0;

function Rotate($angle, $x = -1, $y = -1) {
    if ($x == -1)
        $x = $this->x;
    if ($y == -1)
        $y = $this->y;
    if ($this->angle != 0)
        $this->_out('Q');
    $this->angle = $angle;
    if ($angle != 0) {
        $angle*=M_PI / 180;
        $c = cos($angle);
        $s = sin($angle);
        $cx = $x * $this->k;
        $cy = ($this->h - $y) * $this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
    }
}

function _endpage() {
    if ($this->angle != 0) {
        $this->angle = 0;
        $this->_out('Q');
    }
    parent::_endpage();
}

}





class PDF extends PDF_Rotate {

var $_tplIdx;
 public $xp=0;public $yp=0;
 function SetAlpha($alpha, $bm='Normal')
    {
    	// set alpha for stroking (CA) and non-stroking (ca) operations
    	$gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
    	$this->SetExtGState($gs);
    }
    
    function AddExtGState($parms)
    {
    	$n = count($this->extgstates)+1;
    	$this->extgstates[$n]['parms'] = $parms;
    	return $n;
    }
    
    function SetExtGState($gs)
    {
    	$this->_out(sprintf('/GS%d gs', $gs));
    }
function Header() {
    global $fullPathToFile;
    
    //Put the watermark
    //$this->Image('logo_resized.jpg', 40, 100, 100, 0, 'JPG');
    $this->SetFont('Arial', '', 20);
    $this->SetTextColor(169,169,169);
     $watermarkText = 'New PDF Watermark - PHP';

   

    if (is_null($this->_tplIdx)) {

        // THIS IS WHERE YOU GET THE NUMBER OF PAGES
        $this->numPages = $this->setSourceFile($fullPathToFile);

        $this->_tplIdx = $this->importPage(1);
         
    }
 
      $this->useTemplate($this->_tplIdx, 0, 0, 210); 
  $this->RotatedText(20, 290, 'SafeZone    SafeZone   SafeZone    SafeZone    SafeZone    SafeZone    SafeZone  ', 75);
  $this->RotatedText(40, 290, 'SafeZone    SafeZone   SafeZone    SafeZone    SafeZone    SafeZone    SafeZone  ', 75);
 $this->RotatedText(60, 290, 'SafeZone    SafeZone   SafeZone    SafeZone    SafeZone    SafeZone    SafeZone  ', 75);
  $this->RotatedText(80, 290, 'SafeZone    SafeZone   SafeZone    SafeZone    SafeZone    SafeZone    SafeZone  ', 75);
 $this->RotatedText(100, 290, 'SafeZone    SafeZone   SafeZone    SafeZone    SafeZone    SafeZone    SafeZone  ', 75);
  $this->RotatedText(20, 50, 'SafeZone    SafeZone   SafeZone    SafeZone    SafeZone    SafeZone    SafeZone  ', 75);
 $this->RotatedText(30, 20, 'SafeZone    SafeZone   SafeZone    SafeZone    SafeZone    SafeZone    SafeZone  ', 75);
  $this->RotatedText(50, 50, 'SafeZone    SafeZone   SafeZone    SafeZone    SafeZone    SafeZone    SafeZone  ', 75);
}

function RotatedText($x, $y, $txt, $angle) {
    //Text rotated around its origin
    $this->Rotate($angle, $x, $y);
    $this->Text($x, $y, $txt);
    $this->Rotate(0);
}

}

function resize($original,$destination,$max = 1000)
{
	//resize image
if(exif_imagetype($original)=="3")
   $source = imagecreatefrompng($original);
else 
$source = imagecreatefromjpeg($original);

	
	$width = imagesx($source);
	$height = imagesy($source);

	if($width >= $height){

		$new_width = $max;
		$ratio = $height / $width;
		$new_height = $max * $ratio;
	}else{
		$new_height = $max;
		$ratio = $width / $height;
		$new_width = $max * $ratio;
	}

	$image = imagecreatetruecolor($new_width, $new_height);
	imagecopyresampled($image, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	
	imagejpeg($image,$destination);
	imagedestroy($image);
	imagedestroy($source);
}

function add_logo($source_file,$logo_file,$output)
{
$source =null;
  if(exif_imagetype($source_file)==3)
   $source = imagecreatefrompng($source_file);
else 
$source = imagecreatefromjpeg($source_file);

	$source_width = imagesx($source);
	$source_height = imagesy($source);

	//$logo = imagecreatefromjpeg($logo_file);
	//$logo_width = imagesx($logo);
	//$logo_height = imagesy($logo);

	$centerX = ($source_width ) / 2;
	$centerY = ($source_height)-50;

	//imagecopymerge($source, $logo, $centerX, $centerY, 0, 0, $logo_width, $logo_height, 60);
	//imagecopyresampled(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
	$textcolor = imagecolorallocatealpha($source, 0, 0, 0, 100);
      // $textcolor = imagecolorallocate($source, 0, 0, 0);
  putenv('GDFONTPATH=' . realpath('.'));

// Name the font to be used (note the lack of the .ttf extension)
 $font_file = '/xampp/htdocs/SafeZone/DataBase/geo_1.ttf';

  
  $custom_text = "SafeZone";
  for( $i=1;$i<$centerY;$i++){
for( $j=1;$j<$source_width;$j++){
$j=$j+200;
  imagettftext($source, 50, 50, $j,$i, $textcolor, $font_file, $custom_text);

}
$i=$i+200;
}
	imagejpeg($source,$output);
	imagedestroy($source);
	
}
if($_POST['WithSig']=='1'){

$stetment = $con -> prepare("select FileName,file_Type from user_upload where ID=?");
                $stetment -> execute(array($_POST['file_ID']));
                $count    = $stetment -> fetch();
                $FileName='uploads/'.$count['FileName'];
                $fullPathToFile = $FileName;
                
		resize("logo.jpg","logo_resized.jpg",200);
if($count['file_Type']=='pdf'){


  $pdf = new PDF();
 $format = 'L';  // Entweder '' (horizontal) oder 'L' (Landscape!)
$pdf->AddPage();
$pdf->SetAlpha(1);
$pdf->SetFont('Arial', '', 12);
$pdf->SetAutoPageBreak(false);
//$pdf->Output();
$pdf->Output($FileName, 'F');


}
else{
                // resize($FileName,$FileName,1000);
		add_logo($FileName,"logo_resized.jpg",$FileName);
}

}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$pass= password_hash($_POST['Password'] , PASSWORD_DEFAULT); 


         $stmt = $con -> prepare("insert into file_share(User_ID,File_ID,SUser_ID,ShareType,password,WithPassword)values('$User','$_POST[file_ID]','$SUser_id','$_POST[ShareType]','$pass','$_POST[WithPassword]')");
        if ($stmt -> execute())
        {
{
 try{
          $stetment = $con -> prepare("select User_Email from users where User_ID=?");
                $stetment -> execute(array($SUser_id));
                $count    = $stetment -> fetch();
            $User_Email=$count['User_Email'];
            
    }
catch(PDOException $e) {

}



$mail = new PHPMailer(true);

try {
 
      session_start();            
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'Safezone.cloud1@gmail.com';                    
    $mail->Password   = 'eugtsqzxymtlkuos';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

  
    $mail->setFrom('Safezone.cloud1@gmail.com', 'SaveZone');

    $mail->addAddress($User_Email);             


    $mail->isHTML(true); 
if($_POST['WithPassword']=='1')  {                              
    $mail->Subject = 'share file with Password';
    $mail->Body    = 'this is  the password <b>:</b>'.$_POST['Password'];
}else {
    $mail->Subject = 'share file ';
    $mail->Body    = 'you have new share file from user:  <b>:</b>'.$_SESSION['User_Name'];
}
    $mail->AltBody = '';

    $mail->send();
    echo 'Message has been sent';
header("refresh:0; url=../Authentication.php"); 
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
echo "<script language='javascript'>alert('Share file Successfully ');
</script>";
header("refresh:0; url=../index.php"); 
         
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($con);
        } 
 
?>