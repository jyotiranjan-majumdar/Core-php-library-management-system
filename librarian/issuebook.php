<?php
session_start();
include "header.php";
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"lms");
?>
<HTML>

        <!-- page content area main -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>issue books</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>issue books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                
                                <form name="form1" action="" method="post">
                                <table>
                                <tr>
                                <td>
                                <select name="enrollmentno" class="form-control selectpiker">
								<?php
								$res=mysqli_query($link,"select enrollmentno from s_registration");
								while($row = mysqli_fetch_array($res))
								{
								echo "<option>";
								echo $row["enrollmentno"]; 
								echo "</option>";
						}
									?>
                                </select>
                                
                                </td>
                                <td>
                                 <input type="submit" value="search" name="submit1" class=" form-control btn btn-default" style="margin-top: 5px;">
                                </td>
                                </tr>
                                 </table>
                                
                                <?php
                               
							   if(isset($_POST["submit1"]))
							   {
								     
								         $res5= mysqli_query($link,"select * from s_registration where enrollmentno='$_POST[enrollmentno]'");
								         while($row5= mysqli_fetch_array($res5)){
									  
										  $firstname=$row5["firstname"];
										  $lastname=$row5["lastname"];
										  $username=$row5["username"];
										  $email=$row5["email"];
										  $contact=$row5["contact"];
										  $sem=$row5["sem"];
										  $enrollmentno=$row5["enrollmentno"];
										  $session["enrollmentno"]= $enrollmentno;
										  $session["username"]= $username;

									  }
                                ?>
								
                                 <table class="table table-bordered"> 
                  				 	   <tr>
                   					   <td>
                     				      <input type="text" class="form-control" placeholder="enrollmentno" name="enrollmentno" 
                                          value="<?php echo $enrollmentno; ?>" disabled> 
                     				</td>
                     				</tr>
                                
                                		<tr>
                   					   <td>
                     				      <input type="text" class="form-control" placeholder="student name" name="studentname" 
                                          value="<?php echo $firstname. ' ' .$lastname; ?>" required> 
                     						</td>
                     						</tr>

                                    		
                                            <tr>
                   					 		 <td>
                     				      <input type="text" class="form-control" placeholder="student sem" name="studentsem" 
                                          value="<?php echo $sem; ?>" required> 
                     						</td>
                     						</tr>
                                    
                                   			 <tr>
                   						     <td>
                     				      <input type="text" class="form-control" placeholder="student contact" name="studentcontact" 
                                          value="<?php echo $contact; ?>" required> 
                     						</td>
                     						</tr>
                                            
                                            <tr>
                   					   <td>
                     				      <input type="text" class="form-control" placeholder="student email" name="studentemail" 
                                          value="<?php echo $email; ?>" required> 
                     						</td>
                     						</tr>
                                  		    
                                            <tr>
                   					        <td>
                     				      		<select name="booksname" class=" form-control btn btn-default">
                                                <?php
                                                $res= mysqli_query($link,"select books_name from add_books");
												while($row= mysqli_fetch_array($res))
												{
														echo "<option>";
														echo $row["books_name"];
														echo "</option>";
												}
												?>
                                                
                                                </select>
											</td>
                     						</tr>
                                            <tr>
                   					        <td>
                     				      <input type="text" class="form-control" placeholder="books issue date" name="booksissuedate"   
                                          value="<?php echo date("D-M-y"); ?>" required> 
                     						</td>
                     						</tr>
                                            <tr>
                   					        <td>
                     				      <input type="text" class="form-control" placeholder="student username" name="username"  
                                          value="<?php echo $username ?>"; disabled> 
                     						</td>
                     						</tr>
                                            <tr>
                                             <td>
                                             <input type="submit" value="issuebook" name="submit2" class="form-control btn btn-default" 
                                             style="background-color:blue; color:white" > 
                                            </td>
                                            </tr>
                                        
                                    
								    </table>
								
								<?php
								
							   }
                                
								?>
                                
                                </form> 
                                
                                <?php
                                
								if(isset($_POST["submit2"]))
								{
									
											$qty;
									     $res=mysqli_query($link,"select * from add_books where books_name='$_POST[booksname]'");
										  while($row= mysqli_fetch_array($res)){
										  $qty=$row["available_qtr"];
										  
										  }
										  
										  if($qty==0)
										  {
											  ?>
                                             <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                            <strong style="color:white">
                                            This book is not available in stock
                                            </strong>
                                        </div>
                                        <?php
											  
										   }
										   
										   else
										   {
									
									     mysqli_query($link,"insert into issue_book values('','$_session[enrollmentno]','$_POST[studentname]','$_POST[studentsem]','$_POST[studentcontact]','$_POST[studentemail]','$_POST[booksname]','$_POST[booksissuedate]','','$_session[username]')");
								
				mysqli_query($link,"update add_books set available_qtr=	available_qtr-1 where books_name='$_POST[booksname]'"); 
									
											?>
                                            
											<script type="text/javascript">
											alert("books issue sucessfull");
											window.location.href=window.location.href;
											</script>
										
                                        	<?php
										   }
								}
								
                                
                                ?>
 
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

<?php

include "footer.php";
?>

      </html>