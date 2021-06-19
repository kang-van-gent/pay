<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{site_url}/example_pages/sb-admin-bs4/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
	
    {admin_left_menu}
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
        <a class="nav-link" href="{site_url}/demo/academic_year">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text">ข้อมูลประจำปีการศึกษา</span>
        </a>
    </li>
    

	{other_permission_menu}
	

	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
		<a class="nav-link" href="{site_url}/demo/room">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text">ห้องเรียน</span>
		</a>
	</li>
	
	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
		<a class="nav-link" href="{site_url}/demo/student">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text">ข้อมูลนักเรียน</span>
		</a>
	</li>


     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>กำหนดค่าเริ่มต้น</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
           
            <a class="dropdown-item" href="{site_url}/user/depbranch">ฝ่าย</a>
            <a class="dropdown-item" href="{site_url}/user/secbranch">แผนก</a>
            <a class="dropdown-item" href="{site_url}/user/posbranch">ตำแหน่ง</a>
            <div class="dropdown-divider"></div>
           
            <a class="dropdown-item" href="{site_url}/user/empgroup">กลุ่มพนักงาน</a>
            <a class="dropdown-item" href="{site_url}/user/opration">Operation</a>
        </div>
    </li>


<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>ค่าเริ่มต้นระบบ</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          
            <a class="dropdown-item" href="{site_url}/example_pages/sb-admin-bs4/login">จัดการสาขา/ลูกค้า</a>
            <a class="dropdown-item" href="{site_url}/example_pages/sb-admin-bs4/register">จัดการบริษัท</a>
            <a class="dropdown-item" href="{site_url}/backend/members">จัดการสมาชิก</a>
            <div class="dropdown-divider"></div>           
            <a class="dropdown-item" href="{site_url}/backend/pername">คำนำหน้าชื่อ</a>
            <a class="dropdown-item" href="{site_url}/backend/bank">ข้อมูลธนาคาร</a>
            <a class="dropdown-item" href="{site_url}/backend/education">วุฒิการศึกษา</a>
            <a class="dropdown-item" href="{site_url}/backend/mkgroup">กลุ่มสาขา/ลูกค้า</a>
            <a class="dropdown-item" href="{site_url}/backend/emptype">ประเภทพนักงาน</a>         
            <a class="dropdown-item" href="{site_url}/backend/cause">สาเหตุที่ออก[บริษัท]</a>
            <a class="dropdown-item" href="{site_url}/backend/ssocause">สาเหตุที่ออก[สปส.]</a> 
            <a class="dropdown-item" href="{site_url}/backend/hospital">ชื่อโรงพยาบาล[สปส.]</a>           
            <a class="dropdown-item" href="{site_url}/backend/city">จังหวัด</a>
            <a class="dropdown-item" href="{site_url}/backend/area">พื้นที่</a>
            <a class="dropdown-item" href="{site_url}/backend/members_level">Level LogIn</a>
        </div>
    </li>

	
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Login Screens:</h6>
            <a class="dropdown-item" href="{site_url}/login">Login</a>
            <a class="dropdown-item" href="{site_url}/register">Register</a>
            <a class="dropdown-item" href="{site_url}/forgot_password">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="{site_url}/error404">404 Page</a>
            <a class="dropdown-item" href="{site_url}/blank">Blank Page</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{site_url}/example_pages/sb-admin-bs4/charts">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{site_url}/example_pages/sb-admin-bs4/tables">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>
</ul>