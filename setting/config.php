<?php 

  
class UniversityManagement
	
{
	public $server = "localhost";
	public $username = "root";
	public $password = "";
	public $dbname = "jxnu";
	public $connectdb;
	
	function __construct()
	{
		$this->connectdb = new mysqli($this->server,$this->username,$this->password,$this->dbname);
		if($this->connectdb->connect_error)
		{
			die("connection failed");
		}
	}
	
	public function student_login_check($st_username,$st_password)
	{
		$st_login_check = "select  * from st_info where st_username = '$st_username' and st_password='$st_password'";
		$st_login_run = $this->connectdb->query($st_login_check);
		$st_login_num = $st_login_run->num_rows;
		return $st_login_num;
	}

	public function student_info_select($st_username)
	{
		$student_info_sel = "select * from st_info where st_username='$st_username'";
		$student_info_run = $this->connectdb->query($student_info_sel);
		
		return $student_info_run;
	}
		
	
	/////////////////////////////// ADMINNNNNNNNNNNNNNNNN--------------------------
	
	public function meadmin_check($admin_username,$admin_password)
	{
		$meadin_login_select = "select * from meadmin where admin_username='$admin_username' AND admin_password='$admin_password'";
		$meadmin_login_run = $this->connectdb->query($meadin_login_select);
		$meadmin_login_num = $meadmin_login_run->num_rows;
		return $meadmin_login_num;
	}
	public function meadmin_username($adminname)
	{
		$meadmin_username_select = "select * from meadmin where admin_username='$adminname'";
		$meadmin_username_run = $this->connectdb->query($meadmin_username_select);
		return $meadmin_username_run;
	}
	
	//////////////////////////////////Teacher Info ////////////////////////////////
	public function teacher_info($adminname,$t_staff_type)
	{
		switch($t_staff_type)
		{
			case "Admin":
			$teacher_info_select = "select * from teacher_info where t_staff_type='$t_staff_type' AND t_username='$adminname'";
			break;
			case "Teacher":
			$teacher_info_select = "select * from teacher_info where t_staff_type='$t_staff_type' AND t_username='$adminname'";
			break;
			default :
				echo "no teacher found";
		}
		$teacher_info_select_run = $this->connectdb->query($teacher_info_select);
		return $teacher_info_select_run;
		
	
		
	}
	public function teacher_info_display_admin()
	{
		$teacher_info_admin = "select * from teacher_info";
		$teacher_info_admin_run = $this->connectdb->query($teacher_info_admin);
		return $teacher_info_admin_run;
	}
	///// student info display
	public function student_info_display_admin1()
	{
		$student_info_admin = "select * from st_info";
		$student_info_admin_run = $this->connectdb->query($student_info_admin);
		return $student_info_admin_run;
	}
	///// display teacher info in  student panel
	public function teacher_info_instudent($st_grade)
	{
		$teacher_info_instudent_select = "select * from subjects_info where grade='$st_grade'";
		$teacher_info_instudent_run = $this->connectdb->query($teacher_info_instudent_select);
		return $teacher_info_instudent_run;
		
	}
	////////////////////////End Teacher Info ------------//////////////////////
	
	///////////////////////// student password update //////////
	
	public function student_password_change($st_password_update,$st_username)
	{
		$student_password_update = "update st_info set st_password='$st_password_update' where st_username='$st_username'";
		$student_password_update_run = $this->connectdb->query($student_password_update);
		return $student_password_update_run;
	}
	
	
	
	///////////////////------- end student password update --------------//////////////
	
	///////////////////-------- display subject in admin ----------------////////
	public function subject_info()
	{
		
		$subject_info_admin = "select * from subjects_info";
		$subject_info_admin_run = $this->connectdb->query($subject_info_admin);
		return $subject_info_admin_run;
	}
	
	////////////  edit teacher information ////////////////////
	
	public function edit_teacherid($teacher_id)
	{
		$edit_teacherid = "select * from teacher_info where t_id='$teacher_id'";
		$edit_teacherid_run = $this->connectdb->query($edit_teacherid);
		return $edit_teacherid_run;
	}
	////////////  edit Student information ////////////////////
	
	public function edit_studentid($student_id)
	{
		$edit_studentid = "select * from st_info where st_id='$student_id'";
		$edit_studentid_run = $this->connectdb->query($edit_studentid);
		return $edit_studentid_run;
	}
	///////////////// update teacher info from admin/////////////
	public function update_teacher_info($up_fullname,$up_address,$up_email,$up_father,$up_mother,$up_dob,$up_qualification,$up_contact,$up_staff,$up_gender,$teacher_id)
	{
		$update_teacher_info_select = "update teacher_info set t_fullname='$up_fullname',t_address='$up_address',t_email='$up_email',t_father='$up_father',t_mother='$up_mother',t_dob='$up_dob',t_qualification='$up_qualification',t_contact='$up_contact',t_staff_type='$up_staff',t_gender='$up_gender' where t_id='$teacher_id'";
		$update_teacher_info_run = $this->connectdb->query($update_teacher_info_select);
		return $update_teacher_info_run;
	}

	///////////////// update Student info from admin/////////////
	public function update_student_info($up_fullname,$up_username,$up_password,$up_grade,
    $up_roll,$up_dob,$up_address,$up_district,$up_gender,$up_father,
    $up_mother,$up_phone,$student_id)
	{
		$update_student_info_select = "update st_info set st_fullname='$up_fullname',st_username='$up_username',st_password='$up_password',st_grade='$up_grade',
		roll_no='$up_roll',st_dob='$up_dob',st_address='$up_address',
		st_district='$up_district',st_gender='$up_gender',st_father='$up_father',
		st_mother='$up_mother',st_parents_contact='$up_phone' where st_id='$student_id'";
		$update_student_info_run = $this->connectdb->query($update_student_info_select);
		return $update_student_info_run;
	}
	
	////////// add new teacher form admin ////////////////////////
	public function add_teacher($add_t_fullname,$add_t_address,$add_t_email,$add_t_username,$add_t_pass,$add_t_father,$add_t_mother,$add_t_dob,$add_t_qualification,$add_t_contact,$add_t_staff,$add_t_gender)
	{
	$add_teacher = "insert into teacher_info(t_fullname,t_address,t_email,t_username,t_pass,t_father,t_mother,t_dob,t_qualification,t_contact,t_staff_type,t_gender) values('$add_t_fullname','$add_t_address','$add_t_email','$add_t_username','$add_t_pass','$add_t_father','$add_t_mother','$add_t_dob','$add_t_qualification','$add_t_contact','$add_t_staff','$add_t_gender')";
	$add_teacher_run = $this->connectdb->query($add_teacher);
		return $add_teacher_run;
	}
	
	//////// delete teacher form admin //////////////////////
	public function delete_teacher($del_teacher)
	{
	$delete_teacher_info = " delete from teacher_info where t_id='$del_teacher'";
	$delete_teacher_info_run = $this->connectdb->query($delete_teacher_info);
	return $delete_teacher_info_run;
	}

	//////// delete student form admin //////////////////////


	public function delete_student($del_student)
	{
	$delete_student_info = " delete from st_info where st_id='$del_student'";
	$delete_student_info_run = $this->connectdb->query($delete_student_info);
	return $delete_student_info_run;
	}
	////////////////////// looping class from subject info table////////////////
	public function grade($grade)
	{
		$grade_select = "select class from sub_class_name";
		$grade_run = $this->connectdb->query($grade_select);
		return $grade_run;
	}
	
	///////////// display data from st_info select st-grade ///////////
	public function grade_st_info($grade_st_data)
	{
		$grade_st_info_select = "select * from st_info where st_grade='$grade_st_data'";
		$grade_st_info_run = $this->connectdb->query($grade_st_info_select);
		return $grade_st_info_run;
	}
	////////// student info display by admin //////////////////////////
	public function student_info_display_admin($class_students_data)
	{
		$student_info_display_admin_select = "select * from st_info where st_grade='$class_students_data'";
		$student_info_display_admin_run = $this->connectdb->query($student_info_display_admin_select);
		return $student_info_display_admin_run;
	}
	/////////// add student from admin panel /////////////////////
	public function add_student($std_fullname,$std_username,$std_password,$std_grade,$std_roll,$std_dob,$std_address,$std_district,$std_gender,$std_father,$std_mother,$std_parent_contact)
	{
		$add_student_insert = "insert into st_info(st_fullname,st_username,st_password,st_grade,roll_no,st_dob,st_address,st_district,st_gender,st_father,st_mother,st_parents_contact) value('$std_fullname','$std_username','$std_password','$std_grade','$std_roll','$std_dob','$std_address','$std_district','$std_gender','$std_father','$std_mother','$std_parent_contact')";
		$add_student_run = $this->connectdb->query($add_student_insert);
		return $add_student_run;
	}
	
	///////////// General Information about website ///////////
	public function general_setting($web_name,$web_address,$web_phone1,$web_phone2,$web_email1,$web_email2,$web_start,$web_about)
	{
		$general_setting_insert = "insert into general_setting(website_name,website_address,website_phone1,website_phone2,website_email1,website_email2,website_start,web_about) value('$web_name','$web_address','$web_phone1','$web_phone2','$web_email1','$web_email2','$web_start','$web_about')";
		$general_setting_run = $this->connectdb->query($general_setting_insert);
		return $general_setting_run;
	}
	public function general_setting_check()
	{
		$general_setting_check = "select * from general_setting";
		$general_setting_run = $this->connectdb->query($general_setting_check);
		return $general_setting_run;
	}
	public function general_setting_update($upweb_name,$upweb_address,$upweb_phone1,$upweb_phone2,$upweb_email1,$upweb_email2,$upweb_start,$upweb_about)
	{
		$update_general_setting = "update general_setting set website_name='$upweb_name',website_address='$upweb_address',website_phone1='$upweb_phone1',website_phone2='$upweb_phone2',website_email1='$upweb_email1',website_email2='$upweb_email2',website_start='$upweb_start',web_about='$upweb_about'";
	 $update_general_run = $this->connectdb->query($update_general_setting);
		return $update_general_run;
	}
	}

$jxnu = new UniversityManagement;
