<?php
	session_start();
	require("conection/connect.php");
	//Establish Connection
	if (isset($_SESSION['id'])) {
	$id=$_SESSION['id'];
	$result=mysqli_query($link, "SELECT * FROM student WHERE regno='$id'");
	
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	
	// Load the whole row of values from student table matching the Reg no stored as session
	
	$id=$row['regno'];
	$name=$row['name'];
	$roll_no=$row['rollno'];
	$dob=$row['dob'];
	$gender=$row['gender'];                
	$mailid=$row['mailid'];
	$sno=$row['stud_num'];
	$fno=$row['fath_num'];
	$mno=$row['moth_num'];
	$addr=$row['addr'];
	}
	
	
	//Conventional Some sort of usage for the gender I guess?
	if($gender == 'M'){$respect='Mr.';}
	else {$respect='Ms.';}
	
	//Making the most of our college code
	$start_year = substr($id, 4, 2);
	$deptcode = substr($id, 6, 3);
	$type = substr($id, 9, 1);
	$digit = substr($id, 10, 2);
	$c=1;
	
	//Calculate (Assumed) year of leaving
	$end_year=$start_year+4;  
	
	//Department Finding code 
	if($deptcode==104){$dept="CSE";$url="https://drive.google.com/open?id=0BwgIhR5adxOCRG5mcVFVcVROcHc";}
	else if($deptcode==205){$dept="IT";$url="https://drive.google.com/open?id=0BwgIhR5adxOCV1VoZEh0VFllZXM";}
	else if($deptcode==106){$dept="ECE";$url="https://drive.google.com/open?id=0BwgIhR5adxOCR0cyNEh1d0gyZDg";}
	else if($deptcode==105){$dept="EEE";$url="https://drive.google.com/open?id=0BwgIhR5adxOCRWY0UFJFVjlQNDQ";}
	else if($deptcode==114){$dept="MECH";$url="https://drive.google.com/open?id=0BwgIhR5adxOCaFFLcG9IaDlobUk";}
	
	//Calculate age
	$dob=explode("-",$dob); 
	$curMonth = date("m");
	$curDay = date("j");
	$curYear = date("Y");
	$age = $curYear - $dob[0]; 
	if($curMonth<$dob[1] || ($curMonth==$dob[1] && $curDay<$dob[2])) 
	$age--; 
	
	//Calculate Year and sem
	$year=$curYear-(2000+$start_year);
	if($curMonth<6){$sem=2*$year;}
	else {$year+=1;$sem=2*$year-1;}
	
	//Just in cae for latreal entries
	if($type==3){$start_year+=1;}
	?>
<!doctype html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,900' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<script src="js/modernizr.js"></script> 
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<!--<script type='text/javascript'>var isCtrl = false;document.onkeyup=function(e){if(e.which == 17)isCtrl=false;}document.onkeydown=function(e){if(e.which == 17)isCtrl=true;if(((e.which == 65) || (e.which == 67)||(e.which == 80) ||(e.which == 85) ||(e.which == 86) || (e.which == 97) || (e.which == 99) ||(e.which == 112) || (e.which == 117) || (e.which == 118) &amp;&amp; isCtrl == true) || (e.which == 123)||(event.ctrlKey &amp;&amp; event.shiftKey &amp;&amp; event.keyCode==73)){alert(&quot;Sorry I have disabled them... ?(-.-)?&quot;);return false;}}var isNS = (navigator.appName == &quot;Netscape&quot;) ? 1 : 0;if(navigator.appName == &quot;Netscape&quot;) document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);function mischandler(){return false;}function mousehandler(e){var myevent = (isNS) ? e : event;var eventbutton = (isNS) ? myevent.which : myevent.button;if((eventbutton==2)||(eventbutton==3)) return false;}document.oncontextmenu = mischandler;document.onmousedown = mousehandler;document.onmouseup = mousehandler;</script>-->
		<title>LICET | Steffin</title>
	</head>
	<body>
		<main>
			<div class="sr-image-block">
				<ul class="sr-images-list">
					<li class="is-selected">
						<a href="#0">
							<h2>Welcome my fellow Licetian <i class="fa fa-heart-o" aria-hidden="true"></i></h2>
						</a>
					</li>
					<li>
						<a href="#0">
							<h2>So you are from the <?php echo $dept;?> department?</h2>
						</a>
					</li>
					<li>
						<a href="#0">
							<h2>
								Assessement Tips &amp; Tricks <i class="fa fa-cogs" aria-hidden="true"></i>
								<!--<p style="text-align:right;"><span style="font-family:Garamond;font-size:22px;font-style:normal;text-decoration:none;font-variant:small-caps;color:000000;">If any clarifications or corrections on the credits awarded please approach the corresponding staff. Trust me, they don't bite!!!</span></p>-->
							</h2>
						</a>
					</li>
					<li>
						<a href="#0">
							<h2>Leaving Already?</h2>
						</a>
					</li>
				</ul>
				<!-- .sr-images-list -->
			</div>
			<!-- .sr-image-block -->
			<div class="sr-content-block">
				<ul>
					<li class="is-selected">
						<div>
							<h2>Hello, and welcome to your LICET profile: <br/><?php echo $respect." ".$name;?>!</h2>
							<div class="container">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<table class="table" >
										<thead class="thead-inverse">
											<tr>
												<th>#</th>
												<th>Attribute</th>
												<th>Value</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th scope="row">1</th>
												<td>Name</td>
												<td><?php echo $name;?></td>
											</tr>
											<tr>
												<th scope="row">2</th>
												<td>Register Number</td>
												<td><?php echo $id;?></td>
											</tr>
											<tr>
												<th scope="row">3</th>
												<td>Roll Number</td>
												<td><?php echo $roll_no;?></td>
											</tr>
											<tr>
												<th scope="row">4</th>
												<td>Department</td>
												<td><?php echo $dept;?></td>
											</tr>
											<tr>
												<th scope="row">5</th>
												<td>Year</td>
												<td><?php echo $year;?></td>
											</tr>
											<tr>
												<th scope="row">6</th>
												<td>Semester</td>
												<td><?php echo $sem;?></td>
											</tr>
											<tr>
												<th scope="row">7</th>
												<td>Mail ID</td>
												<td><?php echo $mailid;?></td>
											</tr>
											<tr>
												<th scope="row">8</th>
												<td>Student Number</td>
												<td><?php echo $sno;?></td>
											</tr>
											<tr>
												<th scope="row">9</th>
												<td>Father Number</td>
												<td><?php echo $fno;?> </td>
											</tr>
											<tr>
												<th scope="row">10</th>
												<td>Mother Number</td>
												<td><?php echo $mno;?> </td>
											</tr>
											<tr>
												<th scope="row">11</th>
												<td>Address</td>
												<td><?php echo $addr;?> </td>
											</tr>
										</tbody>
									</table>
									<p style="text-align:center;">
										Noticed some mishaps in the details displayed? Let us know and we will get back to you!!!<br/><br/>
										<a href="#" class="btn btn-info btn-lg">
										<span class="glyphicon glyphicon-edit"></span> Request Edit
										</a>
									</p>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div>
							<h2>Might as well know what you have signed up for!</h2>
							<div class="container">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<?php
										$sql = "SELECT * FROM R_2013 WHERE sem='$sem' and dept='$deptcode'" ;
										$result=mysqli_query($link, $sql);
										// output data of each row  
										if ($result->num_rows > 0) {
										?>
									<table class="table" >
										<thead class="thead-inverse">
											<tr>
												<th>#</td>
												<th>CODE</th>
												<th>NAME</th>
												<th>CREDIT</th>
											</tr>
										</thead>
										<tbody>
											<?php
												while($row = $result->fetch_assoc()) {
												echo "<tr><th scope='row'>".$c."</th><td>".$row['code']."</td><td>".$row['name']."</td><td>".$row['credit']."</td></tr>";
												$c+=1;
												}?>
										</tbody>
									</table>
									<p style="text-align:center;">                
										Or rather would you like the whole year's Syllabus?<br /><br />
										<a href="<?php echo $url;?>" class="btn btn-info btn-lg" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  View Syllabus</a>
									</p>
								</div>
							</div>
							<?php
								} else {
								echo "0 results";
								}
								?>
						</div>
					</li>
					<li>
						<div>
							<h2>Wow! Would you look at that, your internals just got uploaded!!!</h2>
							<div class="container">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<p>Nah, just kidding! I am not that job less entering such minute details. But you get the idea of what is to be displayed here right?</p>
									<h2>Instead would you like to know some of the inside outs on how you are assessed by the college!!!</h2>
									<p>When Anna University publishes results for a student, the External Marks (Theory Examination written by the student out of 100 marks) is converted to 80 marks and the Internal Marks got by the student out of 20 is added to the 80 marks (so, 80+20=100 marks) and the final results are published in Grades. Refer the below table :<br/><br/></p>
									<table class="table" >
										<thead class="thead-inverse">
											<tr>
												<th>Grade</th>
												<th>Points</th>
												<th>Range</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td >S</td>
												<td >10</td>
												<td >91-100</td>
											</tr>
											<tr>
												<td >A</td>
												<td >9</td>
												<td >81-90</td>
											</tr>
											<tr>
												<td >B</td>
												<td >8</td>
												<td >71-80</td>
											</tr>
											<tr>
												<td >C</td>
												<td >7</td>
												<td >61-70</td>
											</tr>
											<tr>
												<td >D</td>
												<td >6</td>
												<td >57-60</td>
											</tr>
											<tr>
												<td >E</td>
												<td >5</td>
												<td >50-56</td>
											</tr>
											<tr>
												<td >U</td>
												<td >0</td>
												<td ><50</td>
											</tr>
										</tbody>
									</table>
									<p style="text-align:center;">Formula Used : Total = External Exam Marks(Out Of 80) + Internal Marks(Out Of 20)</p>
									<p>The following is the table that comprises of the minimum marks that is needed to be scored in the external exam (The Sem finals) given the internal marks aquired!!!</p>
									<table class="table" >
										<thead class="thead-inverse">
											<tr>
												<th>Internals Aquired</th>
												<th>E</th>
												<th>D</th>
												<th>C</th>
												<th>B</th>
												<th>A</th>
												<th>S</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td >20 Mark</td>
												<td >45</td>
												<td >47</td>
												<td >52</td>
												<td >64</td>
												<td >77</td>
												<td >89</td>
											</tr>
											<tr>
												<td >19 Mark</td>
												<td >45</td>
												<td >48</td>
												<td >53</td>
												<td >65</td>
												<td >78</td>
												<td >90</td>
											</tr>
											<tr>
												<td >18 Mark</td>
												<td >45</td>
												<td >49</td>
												<td >54</td>
												<td >67</td>
												<td >79</td>
												<td >92</td>
											</tr>
											<tr>
												<td >17 Mark</td>
												<td >45</td>
												<td >50</td>
												<td >55</td>
												<td >68</td>
												<td >80</td>
												<td >93</td>
											</tr>
											<tr>
												<td >16 Mark</td>
												<td >45</td>
												<td >52</td>
												<td >57</td>
												<td >69</td>
												<td >82</td>
												<td >94</td>
											</tr>
											<tr>
												<td >15 Mark</td>
												<td >45</td>
												<td >53</td>
												<td >58</td>
												<td >70</td>
												<td >83</td>
												<td >95</td>
											</tr>
											<tr>
												<td >14 Mark</td>
												<td >45</td>
												<td >54</td>
												<td >59</td>
												<td >72</td>
												<td >84</td>
												<td >97</td>
											</tr>
											<tr>
												<td >13 Mark</td>
												<td >47</td>
												<td >55</td>
												<td >60</td>
												<td >73</td>
												<td >85</td>
												<td >98</td>
											</tr>
											<tr>
												<td >12 Mark</td>
												<td >48</td>
												<td >57</td>
												<td >62</td>
												<td >74</td>
												<td >87</td>
												<td >99</td>
											</tr>
											<tr>
												<td >11 Mark</td>
												<td >49</td>
												<td >58</td>
												<td >63</td>
												<td >75</td>
												<td >88</td>
												<td >100</td>
											</tr>
											<tr>
												<td >10 Mark</td>
												<td >50</td>
												<td >59</td>
												<td >64</td>
												<td >77</td>
												<td >89</td>
												<td >N/A</td>
											</tr>
											<tr>
												<td >09 Mark</td>
												<td >52</td>
												<td >60</td>
												<td >65</td>
												<td >78</td>
												<td >90</td>
												<td >N/A</td>
											</tr>
											<tr>
												<td >08 Mark</td>
												<td >53</td>
												<td >62</td>
												<td >67</td>
												<td >79</td>
												<td >92</td>
												<td >N/A</td>
											</tr>
											<tr>
												<td >07 Mark</td>
												<td >54</td>
												<td >63</td>
												<td >68</td>
												<td >80</td>
												<td >93</td>
												<td >N/A</td>
											</tr>
											<tr>
												<td >06 Mark</td>
												<td >55</td>
												<td >64</td>
												<td >69</td>
												<td >82</td>
												<td >94</td>
												<td >N/A</td>
											</tr>
											<tr>
												<td >05 Mark</td>
												<td >57</td>
												<td >65</td>
												<td >70</td>
												<td >83</td>
												<td >95</td>
												<td >N/A</td>
											</tr>
											<tr>
												<td >04 Mark</td>
												<td >58</td>
												<td >67</td>
												<td >72</td>
												<td >84</td>
												<td >97</td>
												<td >N/A</td>
											</tr>
											<tr>
												<td >03 Mark</td>
												<td >59</td>
												<td >68</td>
												<td >73</td>
												<td >85</td>
												<td >98</td>
												<td >N/A</td>
											</tr>
											<tr>
												<td >02 Mark</td>
												<td >60</td>
												<td >69</td>
												<td >74</td>
												<td >87</td>
												<td >99</td>
												<td >N/A</td>
											</tr>
											<tr>
												<td >01 Mark</td>
												<td >62</td>
												<td >70</td>
												<td >75</td>
												<td >88</td>
												<td >100</td>
												<td >N/A</td>
											</tr>
											<tr>
												<td >00 Mark</td>
												<td >63</td>
												<td >72</td>
												<td >77</td>
												<td >89</td>
												<td >N/A</td>
												<td >N/A</td>
											</tr>
										</tbody>
									</table>
									<p style="text-align:center;">
										How to read the table?<br/><br/>
									</p>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div>
							<h2>Hope you won't forget to visit here again later?</h2>
							<div class="container">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<p>
										<a href="logout.php" class="btn btn-info btn-lg">
										<span class="glyphicon glyphicon-log-out"></span> Log out
										</a>									
									</p>
								</div>
							</div>
						</div>
					</li>
				</ul>
				<button class="sr-close">Close</button>
			</div>
			<!-- .sr-content-block -->
			<ul class="block-navigation">
				<li><button class="sr-prev inactive">&larr; Prev</button></li>
				<li><button class="sr-next">Next &rarr;</button></li>
			</ul>
			<!-- .block-navigation -->
		</main>
		<!-- .sr-main -->
		<script src="js/jquery-2.1.4.js"></script>
		<script src="js/main.js"></script> <!-- Resource jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>	
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>      
	</body>
</html>
<?php
	} else {
	
	header("location: index.php");
	
	}
	?>