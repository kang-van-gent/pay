<!-- [ View File name : add_view.php ] -->
	<div class="card">
		<div class="card-header bg-primary">
			<h3 class="card-title"><i class="fa fa-plus-square"></i> เพิ่มข้อมูล <strong>Typeformat</strong></h3>
		</div>
		<div class="card-body">
			<form class="form-horizontal" id="formAdd" accept-charset="utf-8">
				{csrf_protection_field}
		<div class="row">
			<div class="col-xl-4 col-md-4">	


				<div class="form-group">
				<label class="col-sm-5 control-label" for="formart_textcode">โค้ดรายรับ/รายหัก  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="formart_textcode" name="formart_textcode" value=""  />
					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-5 control-label" for="formart_textname">ประเภทการรายรับ/รายหัก  :</label>
					<div class="col-sm-10">

						<input type="text" class="form-control " id="formart_textname" name="formart_textname" value=""  />
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-md-2">
				<div class="form-group">
				
				<font color="green"><br><br><b>1.เป็นรายได้ประจำ
					<br>&nbsp;&nbsp;&nbsp;-คิดประกันสังคม
					<br>&nbsp;&nbsp;&nbsp;-คิดภาษี
					<br>&nbsp;&nbsp;&nbsp;-คิดกองทุน</b>
				</font>
				</div>				
			</div>
			<div class="col-xl-2 col-md-2">
				<div class="form-group">
				<font color="blue"><br><br><b>2.เป็นรายได้ประจำ
					<br>&nbsp;&nbsp;&nbsp;-ไม่คิดประกันสังคม
					<br>&nbsp;&nbsp;&nbsp;-คิดภาษี
					<br>&nbsp;&nbsp;&nbsp;-คิดกองทุน</b>
				</font>
				</div>				
			</div>
			<div class="col-xl-2 col-md-2">
				<div class="form-group">
				<font color="purple"><br><br><b>3.เป็นรายได้ไม่ประจำ
					<br>&nbsp;&nbsp;&nbsp;-ไม่คิดประกันสังคม
					<br>&nbsp;&nbsp;&nbsp;-คิดภาษี
					<br>&nbsp;&nbsp;&nbsp;-คิดกองทุน</b>
				</font>
				</div>				
			</div>
			<div class="col-xl-2 col-md-2">
				<div class="form-group">
				<font color="red"><br><br><b>4.เป็นรายได้ไม่ประจำ
					<br>&nbsp;&nbsp;&nbsp;-ไม่คิดประกันสังคม
					<br>&nbsp;&nbsp;&nbsp;-ไม่คิดภาษี
					<br>&nbsp;&nbsp;&nbsp;-ไม่คิดกองทุน</b>
				</font>
				</div>				
			</div>

			<div class="col-md-12">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="card" style="min-height: 700px;">
								<!-- <div class="tab">
								<button class="tablinks" onclick="openTypefornat(event, 'Income')" id="defaultOpen">รายรับ</button>
								<button class="tablinks" onclick="openTypefornat(event, 'Revenue')">รายได้อื่นๆ/ชม.พิเศษ</button>
								<button class="tablinks" onclick="openTypefornat(event, 'Deduct')">รายการหัก</button>
								</div>
								<div id="Income" class="tabcontent">
								<span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
									<div class="container">
										<div class="col-md-2"> <br> </div> -->
										<div class="col-md-15"> <br />
										<h3 align="center"> รายรับ</h3><br>
										<form id="formqsys" name="formqsys" method="post" action="s_q_db.php">
											<table width="70%" border="1" align="center" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
											<tr>
											<td width="50%" rowspan="2" align="center">
											<br>
											<strong>รายละเอียด</strong>
											</td>
											<td colspan="4" align="center"><strong>ประเภท</strong></td>
											</tr>
											<tr parser-repeat="[data_list]" id="row_{record_number}">
											<td width="10%" align="center"><strong><font color="green">1</font></strong></td>
											<td width="10%" align="center"><strong><font color="blue">2</font></strong></td>
											<td width="10%" align="center"><strong><font color="purple">3</font></strong></td>
											<td width="10%" align="center"><strong><font color="red">4</font></strong></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  รายได้รวม </td>
											<td height="30" align="center"><input type="checkbox" id="formart_salary" name="formart_salary"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" id="formart_salary" name="formart_salary"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" id="formart_salary" name="formart_salary"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" id="formart_salary" name="formart_salary"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  คืนเงินประกัน</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  เงินค่าชดเชย</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  ค่าบอกกล่าว</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  เงิน Shut Down</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  เงิน OT</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  เงินค่ากะ</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  ค่าอาหาร</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  ค่ารถ</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  เบี้ยขยัน</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  เบี้ยเลี้ยง</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  โบนัส</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  ค่าครองชีพ</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  ค่าโทร</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  ค่าทักษะ</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  รายได้อื่นๆ</td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_works1p" name="text_works1p" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_works2p" name="text_works2p" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_works3p" name="text_works3p" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
										</table>
										<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-6">
										<br /><br />
										
										</div>
										</div>
										
										</form>
										</div>

								<!-- <div id="Revenue" class="tabcontent">
								<span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
								<div class="container">
									<div class="col-md-2"> <br>
									</div> -->
									<div class="col-md-15"> <br />
										<h3 align="center"> รายได้อื่นๆ</h3><br>
										<form id="formqsys" name="formqsys" method="post" action="s_q_db.php">
									<table width="70%" border="1" align="center" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
											<tr>
											<td width="50%" rowspan="2" align="center">
											<br>
											<strong>รายละเอียด</strong>
											</td>
											<td colspan="4" align="center"><strong>ประเภท</strong></td>
											</tr>
											<tr>
											<td width="10%" align="center"><strong><font color="green">1</font></strong></td>
											<td width="10%" align="center"><strong><font color="blue">2</font></strong></td>
											<td width="10%" align="center"><strong><font color="purple">3</font></strong></td>
											<td width="10%" align="center"><strong><font color="red">4</font></strong></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom1" name="text_Incom1" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom2" name="text_Incom2" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom3" name="text_Incom3" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom4" name="text_Incom4" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom5" name="text_Incom5" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom6" name="text_Incom6" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom7" name="text_Incom7" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom8" name="text_Incom8" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom9" name="text_Incom9" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom10" name="text_Incom10" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom11" name="text_Incom11" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom12" name="text_Incom12" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom13" name="text_Incom13" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom14" name="text_Incom14" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom15" name="text_Incom15" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom16" name="text_Incom16" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom17" name="text_Incom17" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom18" name="text_Incom18" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom19" name="text_Incom19" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom20" name="text_Incom20" value="}" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											</form>

											<div class="col-md-15"> <br />
											<form id="formqsys" name="formqsys" method="post" action="s_q_db.php">
											<table width="70%" border="1" align="center" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
											<br><h3 align="center"> ชั่งโมงพิเศษ</h3><br>
											<tr>
											<td width="50%" rowspan="2" align="center">
											<br>
											<strong>รายละเอียด</strong>
											</td>
											<td colspan="4" align="center"><strong>ประเภท</strong></td>
											</tr>
											<tr>
											<td width="10%" align="center"><strong><font color="green">1</font></strong></td>
											<td width="10%" align="center"><strong><font color="blue">2</font></strong></td>
											<td width="10%" align="center"><strong><font color="purple">3</font></strong></td>
											<td width="10%" align="center"><strong><font color="red">4</font></strong></td>
											</tr>											
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_ot101p" name="text_ot101p" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_ot115p" name="text_ot115p" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_ot121p" name="text_ot121p" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_ot103p" name="text_ot103p" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
											<tr>
											<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_ot104p" name="text_ot104p" value="" /></input></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
											<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
											</tr>
										</table>
										<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-6">
										<br /><br />
										
										</div>
										</div>										
										</form>
									

							<!-- <div id="Deduct" class="tabcontent">
							<span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
							<div class="container">
								<div class="col-md-2"> <br>
								</div> -->
								<div class="col-md-15"> <br />
									<h3 align="center"> รายการหัก</h3><br>
									<form id="formqsys" name="formqsys" method="post" action="s_q_db.php">
									<table width="70%" border="1" align="center" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
										<tr>
										<td width="50%" rowspan="2" align="center">
										<br>
										<strong>รายละเอียด</strong>
										</td>
										<td colspan="4" align="center"><strong>ประเภท</strong></td>
										</tr>
										<tr>
										<td width="10%" align="center"><strong><font color="green">1</font></strong></td>
										<td width="10%" align="center"><strong><font color="blue">2</font></strong></td>
										<td width="10%" align="center"><strong><font color="purple">3</font></strong></td>
										<td width="10%" align="center"><strong><font color="red">4</font></strong></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  หักประกัน </td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  หักเงินกู้</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  หักค่าชุด</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  หักค่าบัตร</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  หักค่าตรวจสุขภาพ</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  Visa</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  Work Permit</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  หักเงินกรมบังคับคดี</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  หักค่าความเสียหาย</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  Visa</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  Work Permit</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  หักขาด</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  หักสาย</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  หักค่าปรับ</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  หักอื่นๆ</td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_out1" name="textde_out1" value="" /></input></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_out2" name="textde_out2" value="" /></input></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_out3" name="textde_out3" value="" /></input></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_out4" name="textde_out4" value="" /></input></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_out5" name="textde_out5" value="" /></input></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										</form>

										<form id="formqsys" name="formqsys" method="post" action="s_q_db.php">
										<table width="70%" border="1" align="center" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
										<br><h3 align="center"> หักวันทำงาน พิเศษ</h3><br>
										<tr>
										<td width="50%" rowspan="2" align="center">
										<br>
										<strong>รายละเอียด</strong>
										</td>
										<td colspan="4" align="center"><strong>ประเภท</strong></td>
										</tr>
										<tr>
										<td width="10%" align="center"><strong><font color="green">1</font></strong></td>
										<td width="10%" align="center"><strong><font color="blue">2</font></strong></td>
										<td width="10%" align="center"><strong><font color="purple">3</font></strong></td>
										<td width="10%" align="center"><strong><font color="red">4</font></strong></td>
										</tr>

										<tr>
										<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_works1p" name="textde_works1p" value="" /></input></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_works2p" name="textde_works2p" value="" /></input></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										<tr>
										<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_works3p" name="textde_works3p" value="" /></input></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" required /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
										<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
										</tr>
										</table>
										<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-6">
										<br /><br />
										</div>
										</div>	
										</form>				
									</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

				<div class="form-group">
					<div class="col-sm-offset-2 text-center">
						<input type="hidden" id="add_encrypt_id" />
						<button type="button" id="btnConfirmSave"
							class="btn btn-primary btn-lg" data-toggle="modal"
							data-target="#addModal" >
							&nbsp;&nbsp;<i class="fa fa-save"></i> บันทึก &nbsp;&nbsp;
						</button>
					</div>
				</div>

				<input type="hidden" 
														name="encrypt_formart_textcode" 
														value="{encrypt_formart_textcode}" />
			</form>
		</div> <!--panel-body-->
</div> <!--contrainer-->

<!-- Modal Confirm Save -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<h4 class="modal-title" id="addModalLabel">บันทึกข้อมูล</h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="alert alert-warning">ยืนยันการบันทึกข้อมูล ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i> ปิด</button>
				<button type="button" class="btn btn-primary" id="btnSave"><i class="fa fa-save"></i> บันทึก&nbsp;</button>
			</div>
		</div>
	</div>
</div>
