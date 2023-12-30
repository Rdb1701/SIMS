<?php


$requests = array();

$query = "
SELECT
tr.*, s.fname, s.lname, c.course_name, s.gender, s.username, s.year_level,DATE_FORMAT( tr.date_accepted, '%b. %d, %Y'  ) as date_accept
FROM tbl_transac as tr
LEFT JOIN tbl_students as s ON s.student_id = tr.student_id
LEFT JOIN tbl_staff as st ON st.staff_id = tr.staff_id
LEFT JOIN tbl_course as c ON c.course_id = s.course_id
ORDER BY s.lname
";


$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();


$gender_status = '';
if ($row['gender'] == '0') {
    $gender_status = '<span style="padding: 3px 8px; border-radius: 5px;">Female</span>';
 }
 if ($row['gender'] == '1') {
    $gender_status = '<span style="padding: 3px 8px; border-radius: 5px;">Male</span>';
 }

  // STATUS
$status = "";

if ($row['status'] == '0') {
 $status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">PENDING</span>';
}
if ($row['status'] == '1') {
 $status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">APPROVED</span>';
}
if ($row['status'] == '2') {
 $status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">PENDING</span>';
}


$temp_arr['student_id']          = $row['student_id'];
$temp_arr['fname']               = $row['fname'];
$temp_arr['lname']               = $row['lname'];
$temp_arr['username']            = $row['username'];
$temp_arr['gender']              = $gender_status;
$temp_arr['status']              = $status;
$temp_arr['course']              = $row['course_name'];
$temp_arr['year_level']          = $row['year_level'];
$temp_arr['date_accepted']       = $row['date_accept'];
$temp_arr['time_appointed']      = $row['time_appointed'];

$requests[] = $temp_arr;

  }
}
?>