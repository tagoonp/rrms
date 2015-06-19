<?php
 	include "connect.php";
	$RDay = '';
	if($RDay<1) { $RDay=$day; }
	else { $RDay=$RDay%7; }
	
	function getTimeCode($a){
		$re = "0.00";
		if($a==0){
			$re = "7.00";
		}else if($a==1){
			$re = "7.30";
		}else if($a==2){
			$re = "8.00";
		}else if($a==3){
			$re = "8.30";
		}else if($a==4){
			$re = "9.00";
		}else if($a==5){
			$re = "9.30";
		}else if($a==6){
			$re = "10.00";
		}else if($a==7){
			$re = "10.30";
		}else if($a==8){
			$re = "11.00";
		}else if($a==9){
			$re = "11.30";
		}else if($a==10){
			$re = "12.00";
		}else if($a==11){
			$re = "12.30";
		}else if($a==12){
			$re = "13.00";
		}else if($a==13){
			$re = "13.30";
		}else if($a==14){
			$re = "14.00";
		}else if($a==15){
			$re = "14.30";
		}else if($a==16){
			$re = "15.00";
		}else if($a==17){
			$re = "15.30";
		}else if($a==18){
			$re = "16.00";
		}else if($a==19){
			$re = "16.30";
		}else if($a==20){
			$re = "17.00";
		}else if($a==21){
			$re = "17.30";
		}else if($a==22){
			$re = "18.00";
		}else if($a==23){
			$re = "18.30";
		}else if($a==24){
			$re = "19.00";
		}
		
		return $re;
	}
	
	function getRoom($a){
		$re = "";
		if($a==1){
			$re = "CR1";
		}else if($a == 2){
			$re = "CR2";
		}else if($a==3){
			$re = "MR";	
		}
		return $re;
	}
?>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#EAEAEA" width="100%">
 <tr align="center">
 <?php
  $start=1;
  while($start<=$weekday)
  { 
   echo "<td width=\"110px\" height=\"70px\" align=\"left\">&nbsp;</td>";
   $start++;
  }
  $weekday++;
  while($day<=$last_days)
  {
   if(date('j')==$day)
   {
	   $fdate = $year."-".$month."-".$day;
	    if($rid==0){
				$sql = "select * from tb_reserv where res_date = '$fdate' order by res_start";
			}else if($rid==1){
				$sql = "select * from tb_reserv where res_date = '$fdate' and res_room = 1 order by res_start";	
			}else if($rid==2){
				$sql = "select * from tb_reserv where res_date = '$fdate' and res_room = 2 order by res_start";	
			}else if($rid==3){
				$sql = "select * from tb_reserv where res_date = '$fdate' and res_room = 3 order by res_start";
		}
	   $brec = mysql_query($sql);
	   if($brec){
		   $rowscount = mysql_num_rows($brec);
		   echo "<td width=\"110px\" height=\"70px\"  align=\"center\" valign=\"top\" bgcolor=\"#4c4c4c\">
					<div style=\"width:100%; height:100%;\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
				  <tr>
					<td height=\"24px\" align=\"left\">&nbsp;<font color=\"#fff\"><strong>$day</strong></font><br><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

						if($rowscount<=3){
							while($r2 = mysql_fetch_array($brec)){
								$bg = "";
								/*if($r2['res_type']==1){
									$bg = "bgcolor = #FFCC33";
								}else if($r2['res_type']==3){
									$bg = "bgcolor = #66FF66";
								}*/
								
								$st = getTimeCode($r2["res_start"]);
								$et = getTimeCode($r2["res_end"]);
								$rr = getRoom($r2["res_room"]);
								
								echo "<tr>
								<td>
									<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
									  <tr>
										<td $bg align=\"left\"><a href=\"index.php?date=$day&mon=$month&years=$year&comm=1\">&nbsp;$st-$et : $rr</a></td>
									  </tr>
									</table>
								</td>
							  </tr>";
							}
						}else{
							$count = 0;
							while(($r2 = mysql_fetch_array($brec)) && ($count <3)){
								$bg = "";
								/*if($r2['res_type']==1){
									$bg = "bgcolor = #FFCC33";
								}*/
								
								$st = getTimeCode($r2["res_start"]);
								$et = getTimeCode($r2["res_end"]);
								$rr = getRoom($r2["res_room"]);
								//$title = "Time : ".$st."-".$et." Room : $rr";
								echo "<tr>
								<td>
									<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
									  <tr>
										<td $bg  align=\"left\"><a href=\"index.php?date=$day&mon=$month&years=$year&comm=1\">$st-$et : $rr</a></td>
									  </tr>
									</table>
								</td>
							  </tr>";
							  $count++;
							}
							$rw = $rowscount-3;
							echo "<tr>
								<td>
									<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
									  <tr>
										<td align=\"left\" ><a href=\"index.php?date=$day&mon=$month&years=$year&comm=1\">More $rw : Show</a></td>
									  </tr>
									</table>
								</td>
							  </tr>";
							
						}
				echo "</table>
					</td>
				  </tr>
				</table></div>
			</td>";

		}else{
			echo "<td width=\"110px\" height=\"70px\" bgcolor=\"#AED8EE\" align=\"center\"  valign=\"top\" onmouseover=over(this) onmouseout=out(this)>
					&nbsp;
				</td>";
				
		}
   }else{
	   $fdate = $year."-".$month."-".$day;
	    if($rid==0){
				$sql = "select * from tb_reserv where res_date = '$fdate' order by res_start";
			}else if($rid==1){
				$sql = "select * from tb_reserv where res_date = '$fdate' and res_room = 1 order by res_start";	
			}else if($rid==2){
				$sql = "select * from tb_reserv where res_date = '$fdate' and res_room = 2 order by res_start";	
			}else if($rid==3){
				$sql = "select * from tb_reserv where res_date = '$fdate' and res_room = 3 order by res_start";
		}
	   $brec = mysql_query($sql);
	   if($brec){
		   $rowscount = mysql_num_rows($brec);
		   echo "<td  width=\"110px\" height=\"80px\" align=\"center\" bgcolor=\"#b3b3b3\" valign=\"top\" onmouseover=over(this) onmouseout=out(this)>
					<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
					  <tr>
						<td height=\"24px\" align=\"left\">&nbsp;$day<br><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";	
						if($rowscount<=3){
							while($r2 = mysql_fetch_array($brec)){
								$bg = "";
								
								$st = getTimeCode($r2["res_start"]);
								$et = getTimeCode($r2["res_end"]);
								$rr = getRoom($r2["res_room"]);
								
								echo "<tr>
								<td>
									<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\">
									  <tr>
										<td $bg align=\"left\" bgcolor=\"#333333\"><a href=\"index.php?date=$day&mon=$month&years=$year&comm=1\">&nbsp;$st-$et : $rr</a></td>
									  </tr>
									</table>
								</td>
							  </tr>";
							}
						}else{
							$count = 0;
							while(($r2 = mysql_fetch_array($brec)) && ($count <3)){
								$bg = "";
								/*if($r2['res_type']==1){
									$bg = "";
								}*/
								
								$st = getTimeCode($r2["res_start"]);
								$et = getTimeCode($r2["res_end"]);
								$rr = getRoom($r2["res_room"]);
								//$title = "Time : ".$st."-".$et." Room : $rr";
								echo "<tr>
								<td>
									<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\">
									  <tr>
										<td $bg align=\"left\" bgcolor=\"#333333\"><a href=\"index.php?date=$day&mon=$month&years=$year&comm=1\">&nbsp;$st-$et : $rr</a></td>
									  </tr>
									</table>
								</td>
							  </tr>";
							  $count++;
							}
							$rw = $rowscount-3;
							echo "<tr>
								<td>
									<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
									  <tr>
										<td align=\"left\"><a href=\"index.php?date=$day&mon=$month&years=$year&comm=1\"><strong>&nbsp;View more $rw rows</strong></a></td>
									  </tr>
									</table>
								</td>
							  </tr>";
							
						}echo "</table></td> </tr></table></td>";
		}else{
			echo "<td  width=\"110px\" height=\"80px\" align=\"center\" valign=\"top\" onmouseover=over(this) onmouseout=out(this)>
					<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
		  <tr>
			<td height=\"24px\">&nbsp;$day</td>
		  </tr>
		</table></td>";
		}
    	
		
   }
   if($weekday==7 and $day!=$last_days)
   {
    echo '</tr><tr>';
    $weekday=0;
   }
   $day++;
   $weekday++;
  }
  while($weekday<=7)
  {
   echo "<td  align=\"center\" onmouseover=over(this) onmouseout=out(this)>&nbsp;</td>";
   $weekday++;
  }
  
  mysql_close();
 ?>