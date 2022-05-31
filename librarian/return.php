<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"lms");
$a=ate("D-M-y");
$id=$_GET["id"];
$res=$res= mysqli_query($link,"update issue_book set book_return_date='$a' where id=$id ");
$books_name="";
$res=mysqli_query($link,"select * from issue_books where id=$id");
while($row= mysqli_fetch_array($res))
{
$books_name=$row["books_name"]; 
}
mysqli_query($link,"update add_books set available_qtr= available_qtr + 1 where books_name='$books_name'"); 

?>
<script type="text/javascript">
alert("books issue sucessfull");
window.location.href="return_book.php";
</script>
											