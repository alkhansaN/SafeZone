<!DOCTYPE php>
<php lang="en">
<head>
  <meta charset="UTF-8">
  <title>Safe zone </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="style/style.css">

<script language="javascript">
var noPrint=true;
var noCopy=true;
var noScreenshot=true;
var autoBlur=true;
</script>

<script type="text/javascript" src="https://pdfanticopy.com/noprint.js"></script>


</head>
<body>
<?php $ext = pathinfo($_GET['url'], PATHINFO_EXTENSION);
 if($ext=="pdf"){
echo "<iframe src='$_GET[url].'#toolbar=0''
 frameborder='0'  width='100%' height='500px'></iframe>";
?>
  <?php } else {?>
<img src="<?php echo $_GET['url'].'#toolbar=0';?>" 
 >
<?php } ?>
<script>
 document.addEventListener("keyup", function (e) {
    var keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode == 44) {
                stopPrntScr();
            }
        });
function stopPrntScr() {

            var inpFld = document.createElement("input");
            inpFld.setAttribute("value", ".");
            inpFld.setAttribute("width", "0");
            inpFld.style.height = "0px";
            inpFld.style.width = "0px";
            inpFld.style.border = "0px";
            document.body.appendChild(inpFld);
            inpFld.select();
            document.execCommand("copy");
            inpFld.remove(inpFld);
        }
       function AccessClipboardData() {
            try {
                window.clipboardData.setData('text', "Access   Restricted");
            } catch (err) {
            }
        }
        setInterval("AccessClipboardData()", 300);
</script>
</body>
</html>
