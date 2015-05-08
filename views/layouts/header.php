<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo htmlspecialchars($this->title) ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo ROOT_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Custom CSS -->
    <link href="<?php echo ROOT_URL; ?>assets/css/style.css" rel="stylesheet">
	
    <!-- Tags Input -->
    <link href="<?php echo ROOT_URL; ?>assets/css/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <nav class="navbar navbar-inverse role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">Home</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if(empty($this->logged_in_user)) { ?>
					<li>
                        <a href="<?php echo ROOT_URL; ?>user/register">Register</a>
                    </li>
					<li>
                        <a href="<?php echo ROOT_URL; ?>user/login">Login</a>
                    </li>
					<?php } else { ?>
					<li>
                        <a href="<?php echo ROOT_URL; ?>user/profile">Profile</a>
                    </li>
					<li>
                        <a href="<?php echo ROOT_URL; ?>user/logout">Logout</a>
                    </li>
					<?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">