<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"lms");

$id=$_GET["id"];
mysqli_query($link,"update s_registration set status='no' where id=$id");
?>

  
          <script type="text/javascript">
		window.location="student_info_page.php";
		</script>