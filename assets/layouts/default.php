<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url().IMAGENSPATH ?>car-wash.png">
        <link rel="icon" type="image/x-icon" href="<?php echo base_url().IMAGENSPATH ?>car-wash.png">

        <title>{title_for_layout}</title>

        <!-- Bootstrap -->
        {css_for_layout}
        {js_for_layout}

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body cz-shortcut-listen="true">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">{title_for_layout}</a>
                    <img id="logo" style="z-index:999;"src="<?php echo base_url().IMAGENSPATH ?>car-wash-sem-background.png" />
                </div>
                <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <div class="input-group">
                            <input type="text" name="q" id="search" class="form-control search" placeholder="Search..." style="border-radius: 4px;" >
                            <span class="glyphicon glyphicon-search form-control-feedback" ></span>
                        </div>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div id="conteudo" class="row">
                  {content_for_layout}
            </div> 
        </div> 

        <div class="footer-container footer">
           <h1>FOOTER</h1>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script>window.jQuery || document.write('<script src=<?php echo get_instance()->config->slash_item('base_url').JSPATH?>jquery-1.11.1.min.js><\/script>')</script>
        <script> document.write('<script src=<?php echo base_url().JSPATH?>bootstrap.min.js><\/script>')</script>
        <script src=<?php echo base_url().JSPATH.'jquery-ui-1.11.2/jquery-ui.min.js'; ?> ></script>
        
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src=<?php echo base_url().JSPATH.'docs.min.js'; ?> ></script>
        <script src=<?php echo base_url().JSPATH.'ie10-viewport-bug-workaround.js'; ?> ></script>
        <script src=<?php echo base_url().JSPATH.'func/search.js'; ?> ></script>
    </body>
</html>