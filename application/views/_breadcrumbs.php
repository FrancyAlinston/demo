	<ol class="breadcrumb">
		<li><a href="<?php echo $site_url?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#"><?php if(isset($_SESSION['m_menu'])){echo ucwords(substr($_SESSION['m_menu'], 1));}?></a></li>
		<li class="active"><?php if(isset($_SESSION['s_menu'])){echo $_SESSION['s_menu'];}?></li>
	</ol>