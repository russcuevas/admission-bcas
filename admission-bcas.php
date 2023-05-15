<?php
include 'config/connection.php';

if (isset($_POST['submit'])) {
    $department = $_POST['department'];
    $strandCourse = '';

    // QUERY IF SELECTED DEPARTMENT FILL THE REQUIREMENT OR NOT
    if ($department === 'Pre-Elementary' || $department === 'Elementary' || $department === 'Junior High School') {
        $strandCourse = '';
    } else if ($department === 'Senior High School' || $department === 'College') {
        $strandCourse = $_POST['strand_course'];
    }

    // TABLE NAME: toenroll
    // SCHOOL ENROLL
    $enrollQuery = "INSERT INTO toenroll (studentnumber, department, type, gradelevel, strand_course) VALUES (?, ?, ?, ?, ?)";
    $enrollStatement = $conn->prepare($enrollQuery);
    $enrollStatement->execute([
        $_POST['studentnumber'],
        $_POST['department'],
        $_POST['type'],
        $_POST['gradelevel'],
        $strandCourse,
    ]);

    // TABLE NAME: student_data
    // STUDENT DATA
    $studentDataQuery = "INSERT INTO student_data (lrn, studentnumber, firstname, lastname, middlename, sex, address, dateofbirth) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $studentDataStatement = $conn->prepare($studentDataQuery);
    $studentDataStatement->execute([
        $_POST['lrn'],
        $_POST['studentnumber'],
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['middlename'],
        $_POST['sex'],
        $_POST['address'],
        date('Y-m-d', strtotime($_POST['dateofbirth'])),
    ]);

    // TABLE NAME: stud_extra_data
    // STUDENT EXTRA DATA
    $extraDataQuery = "INSERT INTO stud_extra_data (studentnumber, placeofbirth, email, fb_account, contact, specialskills) VALUES (?, ?, ?, ?, ?, ?)";
    $extraDataStatement = $conn->prepare($extraDataQuery);
    $extraDataStatement->execute([
        $_POST['studentnumber'],
        $_POST['placeofbirth'],
        $_POST['email'],
        $_POST['fb_account'],
        $_POST['contact'],
        $_POST['specialskills'],
    ]);

    // TABLE NAME: student_pastschool
    // STUDENT PAST SCHOOL
    $pastSchoolQuery = "INSERT INTO student_pastschool (studentnumber, elemschoolname, elemschoolyear, jhschoolname, jhschoolyear, shsschoolname, shsstrand, shsschoolyear, tertiaryschool, terschoolyear) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $pastSchoolStatement = $conn->prepare($pastSchoolQuery);
    $pastSchoolStatement->execute([
        $_POST['studentnumber'],
        $_POST['elemschoolname'],
        $_POST['elemschoolyear'],
        $_POST['jhschoolname'],
        $_POST['jhschoolyear'],
        $_POST['shsschoolname'],
        $_POST['shsstrand'],
        $_POST['shsschoolyear'],
        $_POST['tertiaryschool'],
        $_POST['terschoolyear'],
    ]);
    // TABLE NAME: student_father
    // STUDENT FATHER
    $fatherQuery = "INSERT INTO student_father (studentnumber, fathersname, fathersoccupation, fathers_fb, fatherscontact, fathersemail) VALUES (?, ?, ?, ?, ?, ?)";
    $fatherStatement = $conn->prepare($fatherQuery);
    $fatherStatement->execute([
        $_POST['studentnumber'],
        $_POST['fathersname'],
        $_POST['fathersoccupation'],
        $_POST['fathers_fb'],
        $_POST['fatherscontact'],
        $_POST['fathersemail'],
    ]);

    // TABLE NAME: student_mother
    // STUDENT MOTHER
    $motherQuery = "INSERT INTO student_mother (studentnumber, mothersname, mothersoccupation, mothers_fb, motherscontact, mothersemail) VALUES (?, ?, ?, ?, ?, ?)";
    $motherStatement = $conn->prepare($motherQuery);
    $motherStatement->execute([
        $_POST['studentnumber'],
        $_POST['mothersname'],
        $_POST['mothersoccupation'],
        $_POST['mothers_fb'],
        $_POST['motherscontact'],
        $_POST['mothersemail'],
    ]);

    // TABLE NAME: student_guardian
    // STUDENT GUARDIAN
    $guardianQuery = "INSERT INTO student_guardian (studentnumber, guardianname, guardianrelation, guardian_fb, guardiancontact, guardianemail) VALUES (?, ?, ?, ?, ?, ?)";
    $guardianStatement = $conn->prepare($guardianQuery);
    $guardianStatement->execute([
        $_POST['studentnumber'],
        $_POST['guardianname'],
        $_POST['guardianrelation'],
        $_POST['guardian_fb'],
        $_POST['guardiancontact'],
        $_POST['guardianemail'],
    ]);

    // TABLE NAME: student_brother
    // STUDENT BROTHER
    $brotherQuery = "INSERT INTO student_brother (studentnumber, brothersname, brothersoccupation, brothersage, brotherscontact) VALUES (?, ?, ?, ?, ?)";
    $brotherStatement = $conn->prepare($brotherQuery);
    $brotherStatement->execute([
        $_POST['studentnumber'],
        $_POST['brothersname'],
        $_POST['brothersoccupation'],
        $_POST['brothersage'],
        $_POST['brotherscontact'],
    ]);

    // TABLE NAME: student_sister
    // STUDENT SISTER
    $sisterQuery = "INSERT INTO student_sister (studentnumber, sistersname, sistersoccupation, sistersage, sisterscontact) VALUES (?, ?, ?, ?, ?)";
    $sisterStatement = $conn->prepare($sisterQuery);
    $sisterStatement->execute([
        $_POST['studentnumber'],
        $_POST['sistersname'],
        $_POST['sistersoccupation'],
        $_POST['sistersage'],
        $_POST['sisterscontact'],
    ]);

    // QUERY IF THE RESERVATION IS FILLED THE REQUIREMENTS OR NOT
    $reservationQuery = "INSERT INTO school_reservation (studentnumber, bcas, othertext, paidreservation, schoolrefund) VALUES (?, ?, ?, ?, ?)";
    $reservationStatement = $conn->prepare($reservationQuery);

    $paidReservation = $_POST['paidreservation'];
    $schoolRefund = ($paidReservation === 'No') ? '' : $_POST['schoolrefund'];

    // TABLE NAME: school_reservation
    // RESERVATION
    $reservationStatement->execute([
        $_POST['studentnumber'],
        $_POST['bcas'],
        $_POST['othertext'],
        $paidReservation,
        $schoolRefund,
    ]);
    echo "<link rel='shortcut icon' href='images/favicon.ico' type='image/x-icon'>";
    echo "<h1 class='bg-success text-white p-3 text-center'>Student Application Already Sent!</h1>";
}
?>


<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>BCAS Application Form</title>
</head>
<body>

    <div id="" class="d-flex justify-content-center align-items-center" style="background-color: #0a6550; color: white;">
        <div>
            <img class="wassup.png" src="images/logo.png" style="height:100px;width:100px;" />
        </div>
        <div style="padding:10px;">
            <div>
                <div id="">
                    BATANGAS COLLEGE OF ARTS & SCIENCES, INC.
                </div>
                <div class="">
                    Brgy. Bagongpook, Lipa City, Batangas 4217
                </div>
                <div class="">
                    www.bcas.edu.ph / bcas_2000@yahoo.com
                </div>
                <div class="">
                    telefax: (043) - 7561232 main / (043) - 7846071 annex
                </div>
            </div>
        </div>
    </div>

    <div id="" class="text-center" style="display:none;justify-content:center;margin-top:100px;">
        <div class="text-center">

        </div>
    </div>

    <div id="nav-body" class="d-flex justify-content-center" style="margin-bottom:50px;">
        <div id="form-container">
                <div class="division">
                    <div class="title">
                        <div style="display:flex;align-items:center; margin-top: 10px; margin-bottom: 10px;">
                            <div>
                                <img src="images/mainlogo.jpg" style="height:100px;width:100px" />
                            </div>
                            <div>
                                <large class="" style="color:#0a6550; margin-left: 10px; font-size: 20px;">
                                BCAS ONLINE ADMISSION APPLICATION AND ENROLLMENT FORM
                                </large>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning" role="alert">
                        Welcome to BCAS Admission Form kindly fill up all of this to send your application form make sure to fill up all of this correctly!.
                    </div>

                <!-- FORM STARTS -->
                <form action="" method="POST" enctype="multipart/form-data">
                <div class="content">
                        <div class="form-group form-float" style="margin-top:25px;">
                            <div class="form-line">
                                <select id="Department" name="department" required class="form-control">
                                    <option value="">-- Please select department --</option>
                                    <option value="Pre-Elementary">Pre-Elementary</option>
                                    <option value="Elementary">Elementary</option>
                                    <option value="Junior High School">Junior High School</option>
                                    <option value="Senior High School">Senior High School</option>
                                    <option value="College">College</option>
                                </select>
                            </div>
                            <div class="help-info required" style="text-align:right"> Department</div>
                        </div>
                        <div class="form-group form-float" style="margin-top:40px;">
                            <div class="form-line">
                                <select id="Type" name="type" required class="form-control">
                                    <option value="">-- Please select application type --</option>
                                    <option value="OLD">Old</option>
                                    <option value="NEW">New</option>
                                    <option value="RETURNEE">Returnee</option>
                                </select>
                            </div>
                            <div class="help-info required" style="text-align: right;">Application type</div>
                        </div>
                        <div class="form-group form-float" style="margin-top:40px;">
                            <div class="form-line">
                                <select id="txtGradeLevel" name="gradelevel" required class="form-control txtGradeLevel">
                                    <option value="">-- Please select grade/level --</option>
                                    <option value="Nursery">Nursery</option>
                                    <option value="Kinder">Kinder</option>
                                    <option value="Grade 1">Grade 1</option>
                                    <option value="Grade 2">Grade 2</option>
                                    <option value="Grade 3">Grade 3</option>
                                    <option value="Grade 4">Grade 4</option>
                                    <option value="Grade 5">Grade 5</option>
                                    <option value="Grade 6">Grade 6</option>
                                    <option value="Grade 7">Grade 7</option>
                                    <option value="Grade 8">Grade 8</option>
                                    <option value="Grade 9">Grade 9</option>
                                    <option value="Grade 10">Grade 10</option>
                                    <option value="Grade 11">Grade 11</option>
                                    <option value="Grade 12">Grade 12</option>
                                    <option value="1st year college">1st year college</option>
                                    <option value="2nd year college">2nd year college</option>
                                    <option value="3rd year college">3rd year college</option>
                                    <option value="4th year college">4th year college</option>
                                </select>
                            </div>
                            <div class="help-info required" style="text-align: right;">Grade/Level</div>
                        </div>
                        <div class="form-group form-float" style="margin-top:40px;">
                            <div class="form-line">
                                <select id="strand_course" name="strand_course" required class="form-control txtGradeLevel">
                                    <option value="">-- Please select strand/course --</option>
                                        <option value="HUMSS">HUMSS</option>
                                        <option value="STEM">STEM</option>
                                        <option value="ABM">ABM</option>
                                        <option value="BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY">BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY</option>
                                        <option value="BACHELOR OF SCIENCE IN ACCOUNTANCY">BACHELOR OF SCIENCE IN ACCOUNTANCY</option>
                                        <option value="BACHELOR OF SECONDARY EDUCATION MAJOR IN MATHEMATICS">BACHELOR OF SECONDARY EDUCATION MAJOR IN MATHEMATICS </option>
                                        <option value="BACHELOR OF SECONDARY EDUCATION MAJOR IN ENGLISH">BACHELOR OF SECONDARY EDUCATION MAJOR IN ENGLISH </option>
                                        <option value="BACHELOR OF ELEMENTARY EDUCATIONY">BACHELOR OF ELEMENTARY EDUCATIONY</option>
                                        <option value="BACHELOR OF SECONDARY EDUCATION MAJOR IN SCIENCE">BACHELOR OF SECONDARY EDUCATION MAJOR IN SCIENCE </option>
                                        <option value="BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY">BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY</option>
                                        <option value="BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION MAJOR: HUMAN RESOURCE MANAGEMENT">BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION MAJOR: HUMAN RESOURCE MANAGEMENT</option>
                                        <option value="BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION MAJOR: MARKETING MANAGEMENT">BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION MAJOR: MARKETING MANAGEMENT</option>
                                    </select>
                                </div>
                                <div class="help-info required" style="text-align: right;">Strand/Course</div>
                            </div>
                        </div>

						<div class="division" id="basic-info">
                    <div class="title" style="margin-top:50px !important; font-weight: 900; font-size: 20px;">
                        Basic Information
                        <hr>
                    </div>
                    <div class="content">
                        <div class="justify-content-between row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float" style="margin-bottom:20px;">
                                    <div class="form-line">
                                        <input value="" id="lrn" name="lrn" type="text" autocomplete="off" class="form-control" maxlength="12" minlength="12">
                                        <label class="form-label required">Learner Reference Number (LRN):</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-between row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float" style="margin-bottom:20px;">
                                    <div class="form-line">
                                        <input  value="" name="studentnumber"
                                               id="StudentNumber" type="text"
                                               autocomplete="off"
                                               class="form-control"
                                               maxlength="100"
                                               minlength="5"
>
                                        <label class="form-label">Student Number:
                                            <label class="text-danger returne-student-number-note d-none">(If you are a returnee, enter the student number issued to you by BCAS.)</label></label>
                                    </div>
                                    <div class="help-info"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input  id="Lastname" name="lastname" type="text" autocomplete="off" class="form-control" maxlength="50" required>
                                        <label class="form-label required">Last Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input  id="Firstname" type="text"
                                            autocomplete="off" name="firstname" class="form-control" maxlength="50" required>
                                        <label class="form-label required">First Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input  id="Middlename" type="text" autocomplete="off" name="middlename" class="form-control" maxlength="50">
                                        <label class="form-label">Middle Name</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix" style="margin-bottom:25px;margin-top:5px;">
                        <div class="col-sm-12 align-items-center d-flex;" style="display:flex;">
                        <div class="field-labell mr-4 required" style="margin-top:4px; margin-bottom:4px;">Sex: </div>
                        <div class="mr-3">
                            <input name="sex" value="MALE" type="radio" id="M" checked />
                            <label class="radio" for="M">Male</label>
                        </div>

                        <div class="mr-3">
                            <input name="sex" value="FEMALE" type="radio" id="F" />
                            <label class="radio" for="F">Female</label>
                        </div>
                        </div>
                        </div>


                        <div class="row clearfix" id="address" style="margin-bottom:10px;">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="field-labell required">Address:</div>
                                    <div class="form-line">
                                        <input id="Address" type="text" name="address" autocomplete="off" class="form-control" maxlength="200" required>
                                    </div>
                                    <div class="help-info required" style="text-align: right;"> ~Required</div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float" style="margin-top:-10px;">
                                    <div class="field-labell required">Birthdate:</div>
                                    <div class="form-line">
                                        <input id="DOB" name="dateofbirth" type="text" class="form-control"
                                               placeholder="mm/dd/yyyy"
                                               onkeyup="
                                                var v = this.value;
                                                if (v.match(/^\d{2}$/) !== null) {
                                                    this.value = v + '/';
                                                } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
                                                    this.value = v + '/';
                                                }"
                                               maxlength="10" required>
                                    </div>
                                    <div class="help-info required" style="text-align: right"> ~Required</div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="field-labell required">Place of Birth:</div>
                                    <div class="form-line">
                                        <input id="POB" name="placeofbirth" type="text" autocomplete="off" class="form-control" maxlength="200" required>
                                    </div>
                                    <div class="help-info required" style="text-align: right;"> ~Required</div>
                                </div>
                            </div>
                        </div>

                        <div  class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="field-labell required">Email:</div>
                                    <div class="form-line">
                                        <input id="Email" name="email" type="email" autocomplete="off" class="form-control" maxlength="75" required>
                                    </div>
                                    <div class="help-info required" style="text-align: right">Please provide your active email address.</div>
                                </div>
                            </div>
                        </div>
                        <div  class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="field-labell required" >Retype Email:</div>
                                    <div class="form-line">
                                        <input id="Re_Email" name="re_email" type="email" autocomplete="off" class="form-control" maxlength="75" required>
                                    </div>
                                    <div class="help-info required" style="text-align: right">Please confirm your email address.</div>
                                </div>
                            </div>
                        </div>
                        <div  class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="field-labell required">Facebook Account:</div>
                                    <div class="form-line">
                                        <input id="FB_Account" name="fb_account" type="text" autocomplete="off" class="form-control" maxlength="150" required>
                                    </div>
                                    <div class="help-info required" style="text-align: right">Account name or email</div>
                                </div>
                            </div>
                        </div>
                        <div  class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="field-labell required">Contact Number:</div>
                                    <div class="form-line">
                                        <input id="Contact" type="text" name="contact" autocomplete="off" class="form-control" maxlength="20" required>
                                    </div>
                                    <div class="help-info required" style="text-align: right"> ~Required</div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float" style="margin-bottom: 50px;">
                                    <div class="field-labell">Special Skills:</div>
                                    <div class="form-line">
                                        <input id="SK" name="specialskills" type="text" autocomplete="off" class="form-control" maxlength="200">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="division"   id="schoolLastAttended">
                    <div class="title" style="margin-bottom:20px !important; font-size: 20px; font-weight: 900;">
                        School Last Attended
                        <hr>
                        </div>
                    <div class="content">
                        <div class="justify-content-between row clearfix SLA" level="ELEMENTARY" id="elementary-container">
                            <div class="col-sm-9">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="elemschoolname" autocomplete="off" class="form-control SchoolName" maxlength="150" required>
                                        <label class="form-label required">Elementary:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="elemschoolyear" autocomplete="off" class="form-control SchoolYear" maxlength="20" required>
                                        <label class="form-label required">School Year:</label>
                                    </div>
                                    <div class="help-info required">ex. 2012-2018</div>
                                </div>
                            </div>
                        </div>
                        <div    class="justify-content-between row clearfix SLA" level="JHS" id="jhs-container">
                            <div class="col-sm-9">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="jhschoolname" autocomplete="off" class="form-control txtSchoolName" maxlength="150" required>
                                        <label class="form-label required">Junior High School:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="jhschoolyear" autocomplete="off" class="form-control SchoolYear" maxlength="9" required>
                                        <label class="form-label required">School Year:</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div    class="justify-content-between row clearfix SLA" level="SHS" id="shs-container">
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="shsschoolname" autocomplete="off" class="form-control SchoolName" maxlength="150" required>
                                        <label class="form-label required">Senior High School:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="shsstrand" autocomplete="off" class="form-control SchoolStrand" maxlength="50" required>
                                        <label class="form-label required">Strand:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="shsschoolyear" autocomplete="off" class="form-control SchoolYear" maxlength="9" required>
                                        <label class="form-label required">School Year:</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-between row clearfix SLA" level="COLLEGE" id="college-container" style="margin-bottom: 20px;">
                            <div class="col-sm-9">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" autocomplete="off" name="tertiaryschool" class="form-control SchoolName" maxlength="150" required>
                                        <label class="form-label required">Tertiary:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" autocomplete="off" name="terschoolyear" class="form-control SchoolYear" maxlength="9" required>
                                        <label class="form-label required">School Year</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>

                <div class="division" id="parentsAndGuardian">
                    <div class="title" style="margin-bottom: 20px; font-size: 20px; font-weight: 900;">
                        Parents and Guardian
                        <hr>
                    </div>
                    <div class="content">
                        <div>
                            <div class="sub-content PAG" relationship="FATHER">
                                <div class="title" style="font-weight: 900; margin-bottom: 10px;">Father's Information:</div>
                                <div class="content">
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="fathersname" autocomplete="off" class="form-control RName" maxlength="150" required>
                                                    <label class="form-label required">Full name:</label>
                                                    <label class="form-label required">Last name, First name, Middle name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="fathersoccupation" autocomplete="off" class="form-control ROccupation" maxlength="100" required>
                                                    <label class="form-label required">Occupation:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="fathers_fb" autocomplete="off" class="form-control RFBAccount" maxlength="150">
                                                    <label class="form-label">FB Account:</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="fatherscontact" autocomplete="off" class="form-control RContact" maxlength="20">
                                                    <label class="form-label">Contact #:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="email" name="fathersemail" id="FEmail" autocomplete="off" class="form-control REmail">
                                                    <label class="form-label">Email Address:</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="re_femail" autocomplete="off" class="form-control">
                                                    <label class="form-label">Retype Email Address:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-content PAG" relationship="MOTHER">
                                <div class="title" style="font-weight: 900; margin-bottom: 10px;">Mother's Information:</div>
                                <div class="content">
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="mothersname" autocomplete="off" class="form-control RName" maxlength="150" required>
                                                    <label class="form-label required">Mother's Full Maiden Name:</label>
                                                    <label class="form-label required">Last name, First name, Middle name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="mothersoccupation" autocomplete="off" class="form-control ROccupation" maxlength="100" required>
                                                    <label class="form-label required">Occupation:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="mothers_fb" autocomplete="off" class="form-control RFBAccount" maxlength="70">
                                                    <label class="form-label">FB Account:</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="motherscontact" autocomplete="off" class="form-control RContact" maxlength="20">
                                                    <label class="form-label">Contact #:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="email" name="mothersemail" id="MEmail" autocomplete="off" class="form-control REmail" maxlength="50">
                                                    <label class="form-label">Email Address:</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="re_memail" autocomplete="off" class="form-control" maxlength="50">
                                                    <label class="form-label">Retype Email Address:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-content PAG" relationship="GUARDIAN">
                                <div class="title" style="font-weight: 900; margin-bottom: 10px;">Guardian's Information:</div>
                                <div class="content">
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="guardianname" autocomplete="off" class="form-control RName" maxlength="150">
                                                    <label class="form-label">Name:</label>
                                                    <label class="form-label">Last name, First name, Middle name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
											<div class="form-line">
                                                    <input type="text" name="guardianrelation" autocomplete="off" class="form-control RRelationship" maxlength="50">
                                                    <label class="form-label">Relationship:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="guardian_fb" autocomplete="off" class="form-control RFBAccount" maxlength="70">
                                                    <label class="form-label">FB Account:</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="guardiancontact" autocomplete="off" class="form-control RContact" maxlength="20" minlength="3">
                                                    <label class="form-label">Contact #:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line" style="margin-bottom: 20px;">
                                                    <input type="email" name="guardianemail" id="GEmail" autocomplete="off" class="form-control REmail" maxlength="50" minlength="3">
                                                    <label class="form-label">Email Address:</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input name="re_gemail" autocomplete="off" class="form-control" maxlength="50" minlength="3">
                                                    <label class="form-label">Retype Email Address:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>

                <div class="division" id="parentsAndGuardian">
                    <div class="title" style="margin-bottom: 20px; font-size: 20px; font-weight: 900;">
                        Brothers and Sisters
                        <hr>
                    </div>
                    <div class="content">
                        <div>
                            <div class="sub-content PAG" relationship="brother">
                                <div class="title" style="font-weight: 900; margin-bottom: 10px;">Brother's Information:</div>
                                <div class="content">
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="brothersname" autocomplete="off" class="form-control RName" maxlength="150" required>
                                                    <label class="form-label required">Full name:</label>
                                                    <label class="form-label required">Last name, First name, Middle name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="brothersoccupation" autocomplete="off" class="form-control ROccupation" maxlength="100" required>
                                                    <label class="form-label required">School / Work:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="brothersage" autocomplete="off" class="form-control RFBAccount" maxlength="150">
                                                    <label class="form-label">Age : </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="brotherscontact" autocomplete="off" class="form-control RContact" maxlength="20">
                                                    <label class="form-label">Contact #:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sub-content PAG" relationship="sister">
                                <div class="title" style="font-weight: 900; margin-bottom: 10px;">Sister's Information:</div>
                                <div class="content">
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="sistersname" autocomplete="off" class="form-control RName" maxlength="150" required>
                                                    <label class="form-label required">Full name:</label>
                                                    <label class="form-label required">Last name, First name, Middle name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="sistersoccupation" autocomplete="off" class="form-control ROccupation" maxlength="100" required>
                                                    <label class="form-label required">School / Work:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="justify-content-between row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="sistersage" autocomplete="off" class="form-control RFBAccount" maxlength="150">
                                                    <label class="form-label">Age : </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="sisterscontact" autocomplete="off" class="form-control RContact" maxlength="20">
                                                    <label class="form-label">Contact #:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>

                                    <div class="title" style="margin-bottom: 20px; font-size: 20px; font-weight: 900;">
                                    Please select whichever applies to the enrollee for:
                                    <hr>

                                    <div class="mr-4">
                                        <input name="bcas" value="3Child" type="radio" id="3rd" checked />
                                        <label class="radio" for="3rd"> <p style="font-size:12px">3rd Child Studying in BCAS</label>
                                    </div>
                                    <div>
                                        <input name="bcas" value="4Child" type="radio" id="4th" />
                                        <label class="radio" for="4th"><p style="font-size:12px">4th Child Studying in BCAS</label>
                                    </div>
                                    <div>
                                        <input name="bcas" value="5Child" type="radio" id="5th" />
                                        <label class="radio" for="5th"> <p style="font-size:12px">5th Child Studying in BCAS</label>
                                    </div>
                                    <div>
                                        <input name="bcas" value="OtherPS" type="radio" id="Oth" />
                                        <label class="radio" for="Oth"> <p style="font-size:12px">Other, Please Specify:</label>
                                    </div>
                                    <div id="otherInput" style="display: none;">
                                        <input type="text" name="othertext" class="form-control" id="otherText" />
                                    </div>
                                    <hr>
                                    <div class="field-labell mr-4 required" style="margin-top:4px; margin-bottom:4px;">Paid Reservation:</div>
                                    <div class="mr-3">
                                        <input name="paidreservation" value="Yes" type="radio" id="YES" />
                                        <label class="radio" for="Y">Yes</label>
                                    </div>
                                    <div>
                                        <input name="paidreservation" value="No" type="radio" id="NO"  checked/>
                                        <label class="radio" for="N">No</label>
                                    </div>
                                    <div class="field-label mr-4 required" style="margin-top:4px; margin-bottom:4px;">With SY 2022-2023 refund?:</div>
                                    <div class="mr-3">
                                        <input name="schoolrefund" value="Yes" type="radio" id="YES" />
                                        <label id="hidez" class="radio" for="YY">Yes</label>
                                    </div>
                                    <div>
                                        <input name="schoolrefund" value="No" type="radio" id="NO"  />
                                        <label id="hidez" class="radio" for="NN">No</label>
                                    </div>
                                <button type="submit" class="btn btn-success" name="submit" style="display: block;
                                margin:0 auto; width: 200px;">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <div style="margin-top: 100px; font-weight: bold; font-size: 30px;" class="footer text-center">
            <p style="text-transform: uppercase;">Copyright made only by Group 3</p>
        </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="components/script.js"></script>
</body>
</html>
