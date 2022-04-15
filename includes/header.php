 
  <link href="../static/css/bootstrap.css" rel="stylesheet">
  <link rel="shortcut icon" href="../static/images/pos.jpg">
  <link rel="stylesheet" type="text/css" href="../static/css/DT_bootstrap.css">
  <link rel="stylesheet" href="../static/css/font-awesome.min.css">
  <style type="text/css">
.sidebar-nav {
    padding: 9px 0;
}
  </style>
  <link href="../static/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="../static/css/style.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="../static/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="../static/lib/jquery.js" type="text/javascript"></script>
  <script src="../static/src/facebox.js" type="text/javascript"></script>

  <script type="text/javascript">
jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
        loadingImage: '../static/src/loading.gif',
        closeImage: '../static/src/closelabel.png'
    })
})
  </script>

  <?php
function createRandomPassword()
{
 $chars = "003232303232023232023456789";
 srand((double) microtime() * 1000000);
 $i = 0;
 $pass = '';
 while ($i <= 7) {

  $num = rand() % 33;

  $tmp = substr($chars, $num, 1);

  $pass = $pass . $tmp;

  $i++;

 }
 return $pass;
}
$finalcode = 'RS-' . createRandomPassword();
?>

  <script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
<!-- Begin
var timerID = null;
var timerRunning = false;

function stopclock() {
    if (timerRunning)
        clearTimeout(timerID);
    timerRunning = false;
}

function showtime() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds()
    var timeValue = "" + ((hours > 12) ? hours - 12 : hours)
    if (timeValue == "0") timeValue = 12;
    timeValue += ((minutes < 10) ? ":0" : ":") + minutes
    timeValue += ((seconds < 10) ? ":0" : ":") + seconds
    timeValue += (hours >= 12) ? " P.M." : " A.M."
    document.clock.face.value = timeValue;
    timerID = setTimeout("showtime()", 1000);
    timerRunning = true;
}

function startclock() {
    stopclock();
    showtime();
}
window.onload = startclock;
// End -->
  </SCRIPT>
  </head>