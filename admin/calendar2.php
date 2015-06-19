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
<table width="770" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
 <tr align="center">
   <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td colspan="3" align="left" style="font-size:14px; font-family:Tahoma;"><strong><strong>Display schedule</strong></strong></td>
       <td width="5">&nbsp;</td>
       <td height="25">&nbsp;</td>
     </tr>
     <tr>
       <td width="150" align="left" valign="middle"><?php echo $date." ".$full_month." ".$year;?></td>
       <td width="5">&nbsp;</td>
       <td height="25" colspan="3" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
       <?php
       	include "connect.php";
		$fdate = $year."-".$month."-".$date;
		$sql = "select * from tb_reserv where res_date = '$fdate' order by res_start";
	   $brec = mysql_query($sql);
	   if($brec){
			while($rec2 = mysql_fetch_array($brec)){
				?>
				<tr>
                   <td width="100" height="25" align="left"><?php echo getTimeCode($rec2["res_start"])." - ".getTimeCode($rec2["res_end"]);/*echo "asd";*/?></td>
                   <td align="left"><?php
                   	echo $rec2["res_descript"]." - staff : ".$rec2["res_owner"];
				   ?></td>
                   <td align="left"><?php
				   if($rec2["res_room"]==1){
						$r = "Classroom 1 - 601";   
				   }else if($rec2["res_room"]==2){
						$r = "Classroom 2 - 613";   
				   }else if($rec2["res_room"]==3){
						$r = "Meeting Room";   
				   }
                   echo "Room : ". $r;
				   ?></td>
                  <td align="left">&nbsp;</td>
                 </tr>
				<?php
			}   
	   }
	   ?>
         
       </table></td>
       </tr>
   </table></td></tr></table>
<br>
<table width="770" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
 <tr align="center">
 <?php
  $start=1;
  while($start<=$weekday)
  { 
   echo "<td width=\"770px\" height=\"70px\">&nbsp;</td>";
   $start++;
  }
  $weekday++;
  while($day<=$last_days)
  {
   if(date('j')==$day)
   {
    echo "<tdalign=\"center\" >&nbsp;</td>";
   }
   else
   {
    echo "<td  align=\"center\" >
		&nbsp;</td>";
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
   echo "<td  align=\"center\">&nbsp;</td>";
   $weekday++;
  }
 ?>