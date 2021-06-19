<!-- [ View File name : preview_view.php ] -->

<style>
.table th.fit,
.table td.fit {
	white-space: nowrap;
	width: 2%;
}
</style>
<div class="card">

	<div class="card-header bg-info">
		<h3 class="card-title"><i class="fa fa-clipboard"></i> รายละเอียด ข้อมูลสมาชิก</h3>
	</div>
	
	
		   <div class="row">
             <div class="col-md-8">
                               
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
						<td class="text-right fit"><b>userid :</b></td>
						<td>{record_userid}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>User :</b></td>
						<td>{record_username}</td>
					</tr>
		
					<tr>
						<td class="text-right fit"><b>ชื่อ-นามสกุล :</b></td>
						<td>{prefixPreName} {record_firstname} {record_lastname}</td>
					</tr>
				
				<tr>
					<td class="text-right fit"><b>สิทธิ์การใช้งาน :</b></td>
					<td>{levelLevelTitle}</td>
				</tr>
					<tr>
						<td class="text-right fit"><b>อีเมล :</b></td>
						<td>{record_email}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>เบอร์โทรศัพท์ :</b></td>
						<td>{record_tel_number}</td>
					</tr>
					<tr>
						<td class="text-right fit"><b>ไอดี Line :</b></td>
						<td>{record_line_id}</td>
					</tr>
				<tr>
					<td class="text-right fit"><b>อ้างอิง ชื่อสังกัด :</b></td>
					<td>{departmentIdDpmName}</td>
				</tr>
				<tr>
					<td class="text-right fit"><b>สถานะการใช้งาน :</b></td>
					<td>{preview_void}</td>
				</tr>
				</tbody>
			</table>
                      
         </div>
        </div>                             
	</div>
            <div class="col-md-4">
                 <div class="card" style="min-height: 422px;">
                     <div class="card-header"><h3>ภาพประจำตัว  </h3></div>  
                                         
                     <div class="card-body">                  
                     <div class="text-center">{preview_photo} </div>
                     <br>
                         <small class="text-muted d-block">Create date : </small>
                         <h6>{record_create_date}</h6> 
                         <small class="text-muted d-block pt-10">Create user :</small>
                          <h7>{createUserIdFirstname} {createUserIdLastname}</h7> 
                          <small class="text-muted d-block pt-10">Modify date :</small>
                          <h6>{record_modify_date}</h6>
                           <small class="text-muted d-block pt-10">Modify user : </small>
                           <h7>{modifyUserIdFirstname} {modifyUserIdLastname}</h7>
						
                            </div>
                           </div>

                   </div>
              </div>

</div>