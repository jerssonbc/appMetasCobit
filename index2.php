<!DOCTYPE html>
<?php 
session_start();
if(!isset($_SESSION['idUsuario'])){
    header("Location:vista/login.php");
}else{
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Procesos  | Seguimiento</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/goSamples.css" rel="stylesheet" type="text/css" /> 
        <script src="js/go.js"></script>
        <script src="js/mapa.js" ></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue" onload="init()">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../../index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                MAPA Procesos
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $_SESSION['user']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar04.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $_SESSION['user']; ?> - Web Developer
                                        <small>Member since may. 2015</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="vista/logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar04.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $_SESSION['user']; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>Procesos</span>
                            </a>
                        </li>
                        <li>
                            <a href="vista/seguimiento.php">
                                <i class="fa fa-th"></i> <span>Seguimiento</span> <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li>
                            <a href="vista/indicadores.php">
                                <i class="fa fa-th"></i> <span>Indicadores</span> <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Empresa : <?php echo $_SESSION['nombre']; ?>
                        <small>Identificacion de Procesos</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?php echo $_SESSION['nombre']; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                        <div id="sample">
                          <div style="width:100%; white-space:nowrap;">
                            <span style="display: inline-block; vertical-align: top; padding: 5px; width:200px">
                              <div id="myPalette" style="border: solid 1px gray; height: 720px"></div>
                            </span>

                            <span style="display: inline-block; vertical-align: top; padding: 5px; width:80%">
                              <div id="myDiagram" style="border: solid 1px gray; height: 720px"></div>
                            </span>
                          </div>

                          <button id="SaveButton" onclick="saveP()" class="btn btn-primary btn-lg">Guardar Procesos</button>
                          <button onclick="load()" class="btn btn-success btn-lg">Cargar Procesos</button>
                          <form action="control/controlProcesos.php" method="post">
                                <textarea id="mySavedModel" name="mySavedModel" style="width:100%;height:40px;visibility:hidden;">
                                      { "class": "go.GraphLinksModel",
                                      "linkFromPortIdProperty": "fromPort",
                                      "linkToPortIdProperty": "toPort",
                                      "nodeDataArray": [ 
                                    {"key":-2, "category":"ContenedorPrimario", "loc":"274.9999999999999 258.00000000000045", "text":"Enjoy!"},
                                    {"category":"ContenedorApoyo", "text":"End", "key":-17, "loc":"278.99999999999994 518.9999999999998"},
                                    {"category":"ContenedorEstrategico", "text":"End", "key":-18, "loc":"274 11"},
                                    {"category":"Apoyo", "text":"Proceso de Apoyo", "key":-3, "loc":"39.00000000000001 509.99999999999966"},
                                    {"category":"Primario", "text":"Primario", "key":-14, "loc":"63 223.00000000000017"},
                                    {"category":"Estrategicos", "text":"Estrategico", "key":-15, "loc":"-7.999999999999986 9.000000000000057"},
                                    {"category":"Apoyo", "text":"Proceso de Apoyo", "key":-5, "loc":"234 512.0000000000002"},
                                    {"category":"Apoyo", "text":"Proceso de Apoyo", "key":-6, "loc":"446.9999999999999 514.0000000000005"},
                                    {"category":"Estrategicos", "text":"Estrategico", "key":-7, "loc":"163.99999999999994 8.999999999999986"},
                                    {"category":"Estrategicos", "text":"Estrategico", "key":-8, "loc":"321.0000000000001 8"},
                                    {"category":"Estrategicos", "text":"Estrategico", "key":-9, "loc":"499.99999999999966 9.000000000000057"},
                                    {"category":"Primario", "text":"Primario", "key":-10, "loc":"242.99999999999986 176"},
                                    {"category":"Primario", "text":"Primario", "key":-11, "loc":"242.99999999999986 264.00000000000006"},
                                    {"category":"Primario", "text":"Primario", "key":-13, "loc":"376.0000000000002 200.00000000000006"},
                                    {"category":"Primario", "text":"Primario", "key":-16, "loc":"524 229"},
                                    {"category":"Start", "text":"Start", "key":-1, "loc":"-127 261"},
                                    {"category":"End", "text":"End", "key":-19, "loc":"685 254"}
                                     ],
                                      "linkDataArray": [ 
                                    {"from":-14, "to":-10, "fromPort":"R", "toPort":"L", "points":[101.5,223.00000000000017,111.5,223.00000000000017,152.99999999999994,223.00000000000017,152.99999999999994,176,194.49999999999986,176,204.49999999999986,176]},
                                    {"from":-10, "to":-11, "fromPort":"B", "toPort":"T", "points":[242.99999999999986,192.29999999999998,242.99999999999986,202.29999999999998,242.99999999999986,220,242.99999999999986,220,242.99999999999986,237.70000000000005,242.99999999999986,247.70000000000005]},
                                    {"from":-11, "to":-13, "fromPort":"R", "toPort":"L", "points":[281.4999999999999,264.00000000000006,291.4999999999999,264.00000000000006,309.50000000000006,264.00000000000006,309.50000000000006,200.00000000000006,327.5000000000002,200.00000000000006,337.5000000000002,200.00000000000006]},
                                    {"from":-13, "to":-16, "fromPort":"R", "toPort":"L", "points":[414.5000000000002,200.00000000000006,424.5000000000002,200.00000000000006,450.0000000000001,200.00000000000006,450.0000000000001,229,475.5,229,485.5,229]},
                                    {"from":-1, "to":-18, "fromPort":"T", "toPort":"L", "points":[-127,61,-127,51,-127,11,-106.5,11,-86,11,-76,11]},
                                    {"from":-19, "to":-18, "fromPort":"T", "toPort":"R", "points":[685,54,685,44,685,11,659.5,11,634,11,624,11]},
                                    {"from":-1, "to":-14, "fromPort":"R", "toPort":"L", "points":[-107,261,-97,261,-97,261,-97,223.00000000000017,14.5,223.00000000000017,24.5,223.00000000000017]},
                                    {"from":-16, "to":-19, "fromPort":"R", "toPort":"L", "points":[562.5,229,572.5,229,580,229,580,229,636,229,636,254,655,254,665,254]}
                                     ]}
                            
                              </textarea>
                              <input type="hidden" name="param_opcion" id="param_opcion" value="grabar">
                          </form>
                           <!--<button onclick="makeSVG()" class="btn btn-info btn-lg">Render as SVG</button>-->
                           <button onclick="generateImages()" class="btn btn-info btn-lg" id="makeImages" >GENERAR IMAGEN</button>
                          <div id="SVGArea"></div>
                        </div>
                        <div id="myImages">

                        </div> 
                        <!--<button onclick="guardarImages()" class="btn btn-info btn-lg"  >IMAGEN</button>-->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>


    </body>
</html>


<?php 
    }
?>
