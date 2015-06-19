<?php
session_start();

require("../database/connect.class.php");
$db = new database();
$db->connect();

$sessionKey = $db->getSessionkey();

// Check session
if(isset($_SESSION['userSession_'.$sessionKey])){
  if($_SESSION['usertype_'.$sessionKey] != 1){
    header('Location: ../signout.php');
    exit();
  }
}

  $year=date('Y');
	 $month=date('m');
   $date=date('d');
	 $rid = 0;
	 $comm = 0;
	 if(isset($_GET['comm'])){
		$comm = $_GET['comm'];
	 }

	 if(isset($_GET['date'])){
		$date = $_GET['date'];
	 }

	 if(isset($_GET['rid'])){
		$rid= $_GET['rid'];
	 }


	 if(isset($_GET['mon'])){
		$month = $_GET['mon'];
	 }

	 if(isset($_GET['years'])){
		$year = $_GET['years'];
	 }

	 $mkdate=mktime(0,0,0,$month,1,$year);
	 $CYear=date('Y',$mkdate);
	 $CMonth=date('m',$mkdate);
	 $full_month=date('F',$mkdate);
	 $weekday=date('w',$mkdate);
	 $last_days=date('t',$mkdate);
	 $day=1;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>RRMS : Admininstrator</title>
    <style media="screen">
      html, body{
        font-family: arial;
        padding:0;
        margin: 0;
      }

      .spanLeft{
        padding-top: 10px;
        padding-left: 10px;
        padding-bottom: 8px;
      }

      .color_white{
        color: #fff;
      }

      .input{
        width: 95%;
        height: 30px;
        border:solid;
        border-color: #ccc;
        border-width: 1px;
        border-radius: 5px;
        padding-left: 10px;

      }

      .time-width{
        width: 50px;
      }

      label{
        font-size: 0.9em;
        padding-bottom: 10px;
        color: #000;
      }

      button{
        padding: 5px 15px 5px 15px;
        border:solid;
        border-width: 1px;
        border-radius: 5px;
        border-color: #ccc;
        cursor: pointer;
        font-size: 1.0em;
      }

      .success{
        color: #fff;
        background: #06c;
      }

    </style>
  </head>
  <body>
    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" style="font-size:1.3em;" colspan="2">
          <div class="spanLeft" style="border:solid; border-width:0 0 1px 0; border-color: #ccc; background: #f8f8f8; color: #888; padding-bottom:10px;">
            Room Reservation Management System
          </div>
        </td>
      </tr>
      <tr>
        <td height="40" width="300" style="font-size:1.0em;" valign="top">
          <div class="" style="border:solid; border-width:0 1px 0 0; border-color: #ccc;">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
                  <div style="background: #fff; color: #888; padding: 10px;">
                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="padding:10px; padding-top:0px;">
                          <span style="font-size:0.9em;">ผู้ขอจอง</span><br>
                          <input type="text" name id="reserver" value="" class="input" autofocus="">
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:10px; padding-top:5px;">
                          <span style="font-size:0.9em;">วันที่จอง</span><br>
                          <input type="date" name id="datereserve" value="" class="input">
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:10px; padding-top:5px;">
                          <span style="font-size:0.9em;">เวลาเริ่ม</span><br>
                          <input type="number" name id="hhstart" value="" class="input time-width" placeholder="00">
                          :
                          <input type="number" name id="mmstart" value="" class="input time-width" placeholder="00"> น.
                          <br>
                          <span style="font-size:0.8em;">** กรอกเฉพาะตัวเลข เช่น 08:00</span><br>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:10px; padding-top:5px;">
                          <span style="font-size:0.9em;">เวลาสิ้นสุด</span><br>
                          <input type="number" name id="hhend" value="" class="input time-width" placeholder="00">
                          :
                          <input type="number" name id="mmend" value="" class="input time-width" placeholder="00"> น.
                          <br>
                          <span style="font-size:0.8em;">** กรอกเฉพาะตัวเลข เช่น 08:00</span><br>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:10px; padding-top:5px;">
                          <span style="font-size:0.9em;">จุดประสงค์การประชุม</span><br>
                          <select name id="room" class="input" style="width:100%; height:30px;">
                            <option value="" selected="">-- เลือกห้อง --</option>
                            <option value="1">Classroom 1 (601)</option>
                            <option value="2">Classroom 2 (613)</option>
                            <option value="3">Meeting Room</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:10px; padding-top:5px;">
                          <span style="font-size:0.9em;">จุดประสงค์การประชุม</span><br>
                          <select name id="objective" class="input" style="width:100%; height:30px;">
                            <option value="2" selected="">การประชุม</option>
                            <option value="1">การศึกษา / class เรียน</option>
                            <option value="3">กิจกรรมอื่น ๆ</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:10px;padding-top:5px;">
                          <span style="font-size:0.9em;">รายละเอียด</span><br>
                          <textarea name id="desc" rows="8" class="input" style="height:100px;"></textarea>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:10px;padding-top:5px;">
                          <button class="success">บันทึก</button>
                        </td>
                      </tr>

                    </table>
                  </div>
                </td>
              </tr>
              <tr>
                <td height="3" bgcolor="red"></td>
              </tr>
              <tr>
                <td>
                  <div style="height:40px; background: #fff; color: #888; padding: 10px;">
                    Room Reservation Management System
                  </div>
                </td>
              </tr>
              <tr>
                <td height="1" bgcolor="#ccc"></td>
              </tr>
            </table>
          </div>

        </td>
        <td height="40" valign="top" style="padding: 15px;">
          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" style="padding-right:15px;">
                <h2>ตารางการจองห้อง</h2>
              </td>
              <td align="right" style="padding-right:15px;">
                เลือกห้องประชุม
              </td>
              <td width="300">
                <select name id="room" class="input" style="width:100%; height:30px;">
                  <option value="" selected="">ทั้งหมด</option>
                  <option value="1">Classroom 1 (601)</option>
                  <option value="2">Classroom 2 (613)</option>
                  <option value="3">Meeting Room</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <?php include "calendar.php"; ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>

        </td>
      </tr>
    </table>
    <div class="footer">
      <?php include "footer.php"; ?>
    </div>
  </body>
</html>
