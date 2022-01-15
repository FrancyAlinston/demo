<?php
//Browser No Cache
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

function makedate($dt)
{
    $newdt = explode('-', $dt);
    if (count($newdt)<2) {
        return '00/00/0000';
    } else {
        return $newdt[2].'/'. $newdt[1].'/'. $newdt[0];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Navadarsan - Light Dashbaord</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include 'config.php'; ?>

  <style>
    .w3-allerta {
      font-family: "Allerta Stencil", Sans-serif;
      box-shadow: 10px 10px 5px #ccc;
      -moz-box-shadow: 10px 10px 5px #ccc;
      -webkit-box-shadow: 10px 10px 5px #ccc;
      -khtml-box-shadow: 10px 10px 5px #ccc;
    }

    .sideb {

      box-shadow: 10px #ccc;
      -moz-box-shadow: 10px 0px 5px #ccc;
      -webkit-box-shadow: 10px 0px 5px #ccc;
      -khtml-box-shadow: 10px 0px 5px #ccc;
    }

    .w2-allerta {
      font-family: "Allerta Stencil", Sans-serif;
      box-shadow: 10px 10px 5px #ccc;
      -moz-box-shadow: 10px 10px 5px #ccc;
      -webkit-box-shadow: 10px 10px 5px #ccc;
      -khtml-box-shadow: px px px #ccc;
    }

    .st {
      font-family: "Allerta Stencil", Sans-serif;
    }

    #neftDataTable .date input {
      border: none;
      width: 100%;
    }

    #neftDataTable .date input:focus {
      outline: none;
    }
  </style>

  <link rel="apple-touch-icon" sizes="180x180"
    href="<?php echo $site_url; ?>/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32"
    href="<?php echo $site_url; ?>/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16"
    href="<?php echo $site_url; ?>/favicon-16x16.png">
  <link rel="manifest" href="<?php echo $site_url; ?>/manifest.json">
  <link rel="mask-icon"
    href="<?php echo $site_url; ?>/safari-pinned-tab.svg"
    color="#5bbad5">
  <meta name="theme-color" content="#ffffff">


  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet"
    href="<?php echo $site_url; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="<?php echo $site_url; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet"
    href="<?php echo $site_url; ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet"
    href="<?php echo $site_url; ?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->

  <link rel="stylesheet"
    href="<?php echo $site_url; ?>dist/css/AdminLTE.css">
  <link rel="stylesheet"
    href="<?php echo $site_url; ?>assets/css/bootstrap-tagsinput.css">
  <link rel="stylesheet"
    href="<?php echo $site_url; ?>assets/css/easy-autocomplete.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet"
    href="<?php echo $site_url; ?>dist/css/skins/_all-skins.min.css">


  <link rel="stylesheet"
    href="<?php echo $site_url; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet"
    href="<?php echo $site_url; ?>assets/css/animate.css">
  <link rel="stylesheet"
    href="<?php echo $site_url; ?>assets/css/bootstrap-select.css">
  <link rel="stylesheet"
    href="<?php echo $site_url; ?>assets/css/jquery.webui-popover.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->

</head>

<body class="hold-transition skin-blue sidebar-mini overflow: hidden;"
  style="display:none; animation-duration: 0.25s;transition-timing-function: ease-in;animation-fill-mode: both;animation-name: fadeIn; ">
  <div class="wrapper">

    <header class="main-header w3-allerta overflow: hidden;">

      <!-- Logo -->
      <a href="<?php echo $site_url; ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>LT</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img alt="User Image" style="width:77%"
            src="<?php echo $site_url;?>assets/images/logo-nav.png"></span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top ">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu ">
          <ul class="nav navbar-nav">
            <li class="dropdown messages-menu">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">Avanced Tools</a>
              <ul class="dropdown-menu">
                <li onclick="showModal('advBenSearch')"><i class="fa fa-search"></i> Advanced Beneficiary Search</li>
                <!-- <li onclick="location.href='<?php echo $site_url;?>share/srchmemberbyidcertid/'"><i
                  class="fa fa-search"></i> Search Member By ID / Cert ID
            </li> -->
            <li
              onclick="location.href='<?php echo $site_url;?>batch/fixprefix/'"
              style="text-align: left;"><i class="fa fa-magic"></i> Fix Exam Student ID Prefix</li>
            <li onclick="showModal('passbookBatch')"><i class="fa fa-address-book"></i> Passbook Batch Printing
              Dotmatrix</li>
            <li onclick="showModal('passbookBatchLaser')"><i class="fa fa-address-book"></i> Passbook Batch Printing
              Laser</li>
          </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img
                src="<?php echo $site_url; ?>dist/img/user2-160x160.jpg"
                class="user-image" alt="User Image">
              <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img
                  src="<?php echo $site_url; ?>dist/img/user2-160x160.jpg"
                  class="img-circle" alt="User Image">

                <p>
                  Navadarsan - Admin
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body" style="border: none">
                <div class="row" style="margin-top: -10px">
                  <div class="col-md-6 ">
                    <a style="white-space: nowrap"
                      href="<?php echo $site_url; ?>backup/">Backup
                      Database</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" onclick="$('#accountsTab a').trigger('click');" data-toggle="control-sidebar">Accounts</i></a>
          </li>
          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar sideb" style="padding-top: 55px;">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- search form -->
        <div class="input-group ">
          <input type="text" name="q" id="q" class="form-control sq" placeholder="Search..."
            onkeyup="searchSuggest(value,'q')" autocomplete="off">
          <span class="input-group-btn">
            <button type="button" name="search" id="search-btn" class="btn btn-flat">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu st" data-widget="tree">
          <li class="header ">MAIN NAVIGATION</li>
          <li class="treeview" id="Mbeneficiary">
            <a href="#">
              <i class="fa fa-users"></i> <span>Beneficiary</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <!-- <li id="AddBeneficiary"><a href="<?php echo $site_url; ?>beneficiary/add/<?php echo time(); ?>"><i class="fa fa-user-plus"></i> Add
              Beneficiary</a>
          </li> -->
          <li id="AddGuardian"><a
              href="<?php echo $site_url; ?>guardain/addguardian?stamp=<?php echo time(); ?>"><i
                class="fa fa-user-plus"></i> Add Guardian</a></li>
          <li id="AddNidhiBeneficiary"><a
              href="<?php echo $site_url; ?>beneficiary/addnidhi/<?php echo time(); ?>"><i
                class="fa fa-user-plus"></i> Add Nidhi Beneficiary</a></li>
          <li><a href="#" onclick="showModal('advBenSearch')" ;><i class="fa fa-search-plus"></i> Advanced Search</a>
          </li>
          <li id="BeneficiaryExport"><a
              href="<?php echo $site_url; ?>beneficiary/benfilter"><i
                class="fa fa-list-ul"></i> Beneficiary List &amp; Export</a></li>
          <li id="CloseAccounts"><a
              href="<?php echo $site_url; ?>beneficiary/importtally"><i
                class="fa fa-list-ul"></i>Import Closed Acconts</a></li>
          <li id=""><a
              href="<?php echo $site_url; ?>beneficiary/importbendeposit"><i
                class="fa fa-list-ul"></i>Import Yearly Transactions</a></li>
          <li id=""><a
              href="<?php echo $site_url; ?>beneficiary/importbentrialbalance"><i
                class="fa fa-list-ul"></i>Import Yearly Trial Balance</a></li>
          <li id=""><a
              href="<?php echo $site_url; ?>beneficiary/importbendepositscheme"><i
                class="fa fa-list-ul"></i>Import Scheme Deposit</a></li>
          <li id=""><a
              href="<?php echo $site_url; ?>beneficiary/nidhiapplentryexport"><i
                class="fa fa-list-ul"></i>Application Entry Report</a></li>
        </ul>
        </li>
        <li class="treeview" id="Madmission">
          <a href="#">
            <i class="fa fa-address-book-o"></i> <span>Admission</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="NewApplication"><a
                href="<?php echo $site_url; ?>batch/newapplication"><i
                  class="fa fa-edit"></i> New Application</a></li>
            <li id="EditApplication"><a
                href="<?php echo $site_url; ?>batch/editapplication"><i
                  class="fa fa-edit"></i> Edit Application</a></li>
            <li id="Exam"><a
                href="<?php echo $site_url; ?>batch/importexam/"><i
                  class="fa fa-newspaper-o"></i> Exam</a></li>
            <li id="Interview"><a
                href="<?php echo $site_url; ?>batch/importinterview/"><i
                  class="fa fa-odnoklassniki"></i>Interview</a></li>
            <li><a href="<?php echo $site_url; ?>batch/students/"><i
                  class="fa fa-child"></i> Students</a></li>
            <li><a
                href="<?php echo $site_url; ?>batch/studentenroll/"><i
                  class="fa fa-child"></i>Student Enroll</a></li>
            <li id="CandidateListFilter"><a
                href="<?php echo $site_url; ?>batch/batchfilter"><i
                  class="fa fa-list-ul"></i> Candidate List &amp; Filter</a></li>
            <li id="ForumwiseCombined"><a
                href="<?php echo $site_url; ?>batch/forumwiseaggregate"><i
                  class="fa fa-list-ul"></i> Forumwise Combined</a></li>
          </ul>
        </li>
        <!-- <li class="treeview" id="MRazorpay">
        <li id="RazorPay Import"><a href="<1?php echo $site_url; ?>tools/importrazor"><i
          class="fa fa-gears"></i>
        <li id="Razorpay Export"><a
            href="<1?php echo $site_url; ?>razor/razorpay"></a>
          </ul> -->
        <li class="treeview" id="MRazorpay">
          <a href="#">
            <i class="fa fa-graduation-cap"></i>
            <span>Razorpay</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Razorpayimport"><a
                href="<?php echo $site_url; ?>razor/importrazor"><i
                  class="fa fa-plus"></i> RazorPay Import</a></li>
            <li id="Razorpayexport"><a
                href="<?php echo $site_url; ?>razor/razorpay"><i
                  class="fa fa-circle-o"></i> RazorPay Export</a></li>
            <li id="Edit Razorpay"><a
                href="<?php echo $site_url; ?>razor/editrazorpay"><i
                  class="fa fa-circle-o"></i> Edit RazorPay</a></li>
          </ul>
        </li>

        <li class="treeview" id="Mcourses">
          <a href="#">
            <i class="fa fa-graduation-cap"></i>
            <span>Courses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="CreateCourse"><a
                href="<?php echo $site_url; ?>course/create"><i
                  class="fa fa-plus"></i> Create Course</a></li>
            <li id="CourseList"><a
                href="<?php echo $site_url; ?>course/"><i
                  class="fa fa-circle-o"></i> Course List</a></li>
          </ul>
        </li>
        <li class="treeview" id="Mbatch">
          <a href="#">
            <i class="fa fa-address-book-o"></i> <span>Batch</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="CreateBatch"><a
                href="<?php echo $site_url; ?>batch/create"><i
                  class="fa fa-plus"></i> Create Batch</a></li>
            <li id="BatchList"><a
                href="<?php echo $site_url; ?>batch/"><i
                  class="fa fa-circle-o"></i> Batch List</a></li>
          </ul>
        </li>
        <li class="treeview" id="Mcorpusfund">
          <a href="#">
            <i class="fa fa-money"></i> <span>Corpus Fund</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="CreateDonor"><a
                href="<?php echo $site_url; ?>corpusfund/add"><i
                  class="fa fa-plus"></i> Add Donor</a></li>
            <li id="DonorSearch" onclick="showModal('advCorpSearch')"><a href="#"><i class="fa fa-search-plus"></i></i>
                Serach Donor</a></li>
            <li id="DonorList"><a
                href="<?php echo $site_url; ?>corpusfund/donors"><i
                  class="fa fa-list-ul"></i> Donor List</a></li>
            <li id="CForumwiseCombined"><a
                href="<?php echo $site_url; ?>corpusfund/forumwiseaggregate"><i
                  class="fa fa-list-ul"></i> Forumwise Aggregate</a></li>

          </ul>
        </li>

        <li class="treeview" id="Mnidhi">
          <a href="#">
            <i class="fa fa-object-ungroup"></i> <span>Navadarsan Nidhi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="NewShareApplication"><a
                href="<?php echo $site_url; ?>receipt/newapplication"><i
                  class="fa fa-edit"></i> New Share Application</a></li>
            <li id="ShareHoldersList"><a
                href="<?php echo $site_url; ?>share/showmembers"><i
                  class="fa fa-list-ul"></i> View Share Holders </a></li>
            <li id="ShareDates"><a
                href="<?php echo $site_url; ?>share/sharedate"><i
                  class="fa fa-list-ul"></i> Apply Share Dates </a></li>
            <li id="NidhiBulkIssueShares"><a
                href="<?php echo $site_url; ?>share/issuesharebulk"><i
                  class="fa fa-list-ul"></i> Bulk Issue Shares </a></li>
            <li id="NidhiReportExport"><a
                href="<?php echo $site_url; ?>share/nidhireportexport"><i
                  class="fa fa-list-ul"></i> Nidhi Reports &amp; Exports </a></li>
            <li id="Modifiedprofileslist"><a
                href="<?php echo $site_url; ?>share/modifiedprofileslist"><i
                  class="fa fa-list-ul"></i> Modified Profiles List </a></li>
            <li id="NidhiResetAccount"><a
                href="<?php echo $site_url; ?>share/resetnidhi"><i
                  class="fa fa-list-ul"></i> Reset Nidhi Account </a></li>
            <li id="CloseNidhiAccount"><a
                href="<?php echo $site_url; ?>share/nidhicloseaccount"><i
                  class="fa fa-list-ul"></i> Close Nidhi Account </a></li>
            <li id="CloseNidhiAccount"><a
                href="<?php echo $site_url; ?>share/sharecertcunterack"><i
                  class="fa fa-list-ul"></i> Cert Acknowledgement </a></li>
            <li id="CloseNidhiAccount"><a
                href="<?php echo $site_url; ?>share/conterackexport"><i
                  class="fa fa-list-ul"></i> Cert Ack Export </a></li>
          </ul>
        </li>
        <li class="treeview" id="MScholarship">
          <a href="#">
            <i class="fa fa-university"></i> <span>Scholarship</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="ScholarshipForumWise"><a
                href="<?php echo $site_url; ?>scholarship/scholarshiplivereview"><i
                  class="fa fa-list-ul"></i>Review & Import From Live</a></li>
            <li id="NewScholarship"><a
                href="<?php echo $site_url; ?>scholarship/newapplication"><i
                  class="fa fa-edit"></i> New Scholarship Application</a></li>
            <li id="CaclulateScholarship"><a
                href="<?php echo $site_url; ?>scholarship/calcualtescholarship"><i
                  class="fa fa-edit"></i> Caclulate Scholarship</a></li>
            <li id="CaclulateScholarship"><a
                href="<?php echo $site_url; ?>scholarship/scholarshipfilter"><i
                  class="fa fa-list-ul"></i> Scholarship Filter</a></li>
            <li id="CaclulateScholarshipCourseWise"><a
                href="<?php echo $site_url; ?>scholarship/scholarshipfiltercoursewise"><i
                  class="fa fa-list-ul"></i> Filter CourseWise</a></li>
            <li id="ScholarshipForumWise"><a
                href="<?php echo $site_url; ?>scholarship/scholarshipfilterforumwise"><i
                  class="fa fa-list-ul"></i> Filter ForumWise</a></li>
            <li id="CaclulateScholarship"><a
                href="<?php echo $site_url; ?>scholarship/scholarshipcover"><i
                  class="fa fa-list-ul"></i> Scholarship Cover Print</a></li>
            <li id="CheckEligibility"><a
                href="<?php echo $site_url; ?>scholarship/eligibility"><i
                  class="fa fa-list-ul"></i> Check Eligibility</a></li>
            <li id="ManageCourses"><a
                href="<?php echo $site_url; ?>scholarship/managecourses"><i
                  class="fa fa-list-ul"></i> Manage Courses</a></li>
          </ul>
        </li>
        <li id="MAttendance">
          <a href="http://192.168.0.12/light1//Dev/attendance/checkattendance">
            <i class="fa fa-list"></i> <span>Attendance</span>
          </a>
        </li>
        <li class="treeview" id="Mstatutory">
          <a href="#">
            <i class="fa fa-money"></i> <span>Statutory Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="regMembers"><a
                href="<?php echo $site_url; ?>statutory/registerofmembers"><i
                  class="fa fa-edit"></i>Register Of Members</a></li>
            <li id="regShareAppl"><a
                href="<?php echo $site_url; ?>statutory/registerofshareapplication"><i
                  class="fa fa-edit"></i>Register Of Share Application</a></li>

          </ul>
        </li>
        <li class="treeview" id="MNeft">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>NEFT A/C Clossing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="Neftclose"><a
                href="<?php echo $site_url; ?>neft/neftaccountclosedView"><i
                  class="fa fa-plus"></i> A/C Clossing </a></li>
            <li id="Editneft"><a
                href="<?php echo $site_url; ?>neft"><i
                  class="fa fa-circle-o"></i> Edit NEFT & Export</a></li>
          </ul>
        </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Main content -->
    <div class="content-wrapper " style="min-height: 916.3px;  padding-top: 5px;">