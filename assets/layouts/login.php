<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <body>
    	<div class="main-container">
          {content_for_layout}
      </div>

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script>window.jQuery || document.write('<script src=<?php echo get_instance()->config->slash_item('base_url').JSPATH?>jquery-1.11.1.min.js><\/script>')</script>
      <script> document.write('<script src=<?php echo JSPATH?>bootstrap.min.js><\/script>')</script>

    </body>
</html>