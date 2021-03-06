<!-- [ View File name : preview_view.php ] -->

<style>
.table th.fit,
.table td.fit {
	white-space: nowrap;
	width: 2%;
}
</style>

<div class="card">

	<div class="card-header bg-primary">
		<h3 class="card-title"><i class="fa fa-clipboard""></i> รายละเอียดประเภท <b>รายรับ/รายหัก</b></h3>
	</div>

		<div class="row">
			<div class="col-xl-6 col-md-6">	

				<div class="card-body">
				<div class="row align-items-center">

			<table class="table table-bordered table-hover">
				<thead class="well">
					<tr>
						<th class="text-right fit">หัวข้อ</th>
						<th>ข้อมูล</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-right fit"><b>รหัสรายรับ/รายหัก :</b></td>
						<td>{record_format_id}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>โค้ดรายรับ/รายหัก :</b></td>
						<td>{record_formart_textcode}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b> ประเภทรายรับ/รายหัก :</b></td>
						<td>{record_formart_textname}</td>
					</tr>
				</tbody>
			</table>
				</div>
				</div>
			</div>


			
			<div class="col-xl-6 col-md-6">	

				<div class="card-body">
				<div class="row align-items-center">

			<table class="table table-bordered table-hover">
				<thead class="well">
					<tr>
						<th class="text-center fit"><font color="green">1.เป็นรายได้ประจำ</font></th>
						<th class="text-center fit"><font color="blue">2.เป็นรายได้ประจำ</font></th>
						<th class="text-center fit"><font color="purple">3.เป็นรายได้ไม่ประจำ</font></th>
						<th class="text-center fit"><font color="red">4.เป็นรายได้ไม่ประจำ</font></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-left fit"><b><font color="green">- คิดประกันสังคม<br>- คิดภาษี<br>-คิดกองทุน</font></b></td>
						<td class="text-left fit"><b><font color="blue">- ไม่คิดประกันสังคม<br>- คิดภาษี<br>-คิดกองทุน</font></b></td>
						<td class="text-left fit"><b><font color="purple">- ไม่คิดประกันสังคม<br>- คิดภาษี<br>-คิดกองทุน</font></b></td>
						<td class="text-left fit"><b><font color="red">- ไม่คิดประกันสังคม<br>- ไม่คิดภาษี<br>-ไม่คิดกองทุน</font></b></td>
						
					</tr>
				</tbody>
			</table>
				</div>
			</div>
			</div>	

		</div>
</div>
<br>



		<div class="card-body">
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" id="pills-Work-tab" data-toggle="pill" href="#pills-Work" role="tab" aria-controls="pills-Work" aria-selected="true">รายรับ</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">รายได้อื่นๆและชั่วโมงพิเศษ</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">รายการหัก</a>
			  </li>
			</ul>

			<div class="tab-content" id="pills-tabContent">
<!-- Work Info -->
			<div class="tab-pane fade show active" id="pills-Work" role="tabpanel" aria-labelledby="pills-Work-tab">
			<div class="row">
			<div class="col-sm">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
				<tbody>
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
							<!-- <td height="30" align="center"><input type="checkbox" id="formart_salary" name="salary1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" id="formart_salary" name="salary2"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" id="formart_salary" name="salary3"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" id="formart_salary" name="salary4"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

						</tr>
						<tr>
							<td height="30">&nbsp;*  คืนเงินประกัน</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_shutdown); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  เงินค่าชดเชย</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_ot); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  ค่าบอกกล่าว</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_shift); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  เงิน Shut Down</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_meal); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  เงิน OT</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_car); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  เงินค่ากะ</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_diligent); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  ค่าอาหาร</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_etc); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  ค่ารถ</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_bonus); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  เบี้ยขยัน</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_cola); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  เบี้ยเลี้ยง</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_telephone); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  โบนัส</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_skill); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  ค่าครองชีพ</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  ค่าโทร</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  ค่าทักษะ</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  รายได้อื่นๆ</td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_works1p" name="text_works1p" value="{record_text_works1p}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_works2p" name="text_works2p" value="{record_text_works2p}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>
						</tr>
						<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_works3p" name="text_works3p" value="{record_text_works3p}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>
						</tr>

					</tbody>
					</table>
				</div> 

			</div> 
			</div>
		</div> 
<!-- Personal Info -->
		<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			<div class="row">
			<div class="col-sm">	
				<div class="table-responsive">
				<table class="table table-bordered table-hover">
				 <tbody>
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
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom1" name="text_Incom1" value="{record_text_Incom1}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom2" name="text_Incom2" value="{record_text_Incom2}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom3" name="text_Incom3" value="{record_text_Incom3}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom4" name="text_Incom4" value="{record_text_Incom4}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom5" name="text_Incom5" value="{record_text_Incom5}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom5" name="text_Incom5" value="{record_text_Incom5}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom6" name="text_Incom6" value="{record_text_Incom6}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom7" name="text_Incom7" value="{record_text_Incom7}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom8" name="text_Incom8" value="{record_text_Incom8}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom9" name="text_Incom9" value="{record_text_Incom9}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom10" name="text_Incom10" value="{record_text_Incom10}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom11" name="text_Incom11" value="{record_text_Incom11}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom12" name="text_Incom12" value="{record_text_Incom12}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom13" name="text_Incom13" value="{record_text_Incom13}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom14" name="text_Incom14" value="{record_text_Incom14}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom15" name="text_Incom15" value="{record_text_Incom15}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom16" name="text_Incom16" value="{record_text_Incom16}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom17" name="text_Incom17" value="{record_text_Incom17}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom18" name="text_Incom18" value="{record_text_Incom18}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom19" name="text_Incom19" value="{record_text_Incom19}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_Incom20" name="text_Incom20" value="{record_text_Incom20}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td width="10%" align="center"><strong><font color="green">1</font></strong></td>
							<td width="10%" align="center"><strong><font color="blue">2</font></strong></td>
							<td width="10%" align="center"><strong><font color="purple">3</font></strong></td>
							<td width="10%" align="center"><strong><font color="red">4</font></strong></td>
							</tr>
							
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_ot101p" name="text_ot101p" value="{record_text_ot101p}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_ot115p" name="text_ot115p" value="{record_text_ot115p}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_ot121p" name="text_ot121p" value="{record_text_ot121p}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_ot103p" name="text_ot103p" value="{record_text_ot103p}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="text_ot104p" name="text_ot104p" value="{record_text_ot104p}" readonly="readonly" /></input></td>
							<!-- <td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td> -->
							<?php typeformat($record_formart_salary); ?>

							

							</tr>
							</tbody>
				</tbody>
				</table>
			    </div> 
			</div>

		 	</div>
		</div>

<!-- contact Info -->
<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
		<div class="row">
			<div class="col-sm">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
				<tbody>							
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
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  หักเงินกู้</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  หักค่าชุด</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  หักค่าบัตร</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  หักค่าตรวจสุขภาพ</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  Visa</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  Work Permit</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  หักเงินกรมบังคับคดี</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  หักค่าความเสียหาย</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  Visa</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  Work Permit</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  หักขาด</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  หักสาย</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  หักค่าปรับ</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  หักอื่นๆ</td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_out1" name="textde_out1" value="{record_textde_out1}" readonly="readonly" /></input></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_out2" name="textde_out2" value="{record_textde_out2}" readonly="readonly" /></input></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_out3" name="textde_out3" value="{record_textde_out3}" readonly="readonly" /></input></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_out4" name="textde_out4" value="{record_textde_out4}" readonly="readonly" /></input></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_out5" name="textde_out5" value="{record_textde_out5}" readonly="readonly" /></input></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							

							</tr>
							<tr>
							<td width="10%" align="center"><strong><font color="green">1</font></strong></td>
							<td width="10%" align="center"><strong><font color="blue">2</font></strong></td>
							<td width="10%" align="center"><strong><font color="purple">3</font></strong></td>
							<td width="10%" align="center"><strong><font color="red">4</font></strong></td>
							</tr>

							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_works1p" name="textde_works1p" value="{record_textde_works1p}" readonly="readonly" /></input></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_works2p" name="textde_works2p" value="{record_textde_works2p}" readonly="readonly" /></input></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>
							</tr>
							<tr>
							<td height="30">&nbsp;*  <input type="text" class="form-control" id="textde_works3p" name="textde_works3p" value="{record_textde_works3p}" readonly="readonly" /></input></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="1" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="2" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="3" /></td>
							<td height="30" align="center"><input type="checkbox" name="es_id1"  value="4" /></td>

							</tr>
						</tbody>
				</table>
			</div> 
			</div>

		</div> 

				</div>
				</div>
			</div>
</div>

<?php

function typeformat($type)
{
	$name = json_encode(varName($type)[1]);
	for ($i=1; $i < 5 ; $i++) { 
		if ($type == $i) {
			echo '<td height="30" align="center"><input type="radio" name="'.$name.'"  value=" '.$i.' " checked /></td>' ;
		}
		else{
			echo '<td height="30" align="center"><input type="radio" name="'.$name.'"  value=" '.$i.' " /></td>' ;
		}
	}
}

function varName( $v ) {
    $trace = debug_backtrace();
    $vLine = file( __FILE__ );
    $fLine = $vLine[ $trace[0]['line'] - 1 ];
    preg_match( "#\\$(\w+)#", $fLine, $match );
    return( $match );
}

?>


	
