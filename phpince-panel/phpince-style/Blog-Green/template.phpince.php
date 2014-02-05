<!DOCTYPE html>
<html>
<head>
<?php
    bl_metaheader($PHPINCE_system, $PHPince_logon);
?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php bl_temp_link($PHPINCE_system); ?>data/bootstrap.css" rel="stylesheet">
    <link href="<?php bl_temp_link($PHPINCE_system); ?>data/blog.css" rel="stylesheet">
</head>
  <body>
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <ul>
<?php
    bl_temp_nav(1, $PHPince_logon);
?>
          </ul>
        </nav>
      </div>
    </div>
    <div class="container">
      <div class="blog-header">
        <h1 class="blog-title"><?php echo $PHPINCE_system["title"];?></h1>
        <p class="lead blog-description"><?php echo $PHPINCE_system["desc"];?></p>
      </div>
      <div class="row">
        <div class="col-sm-8 blog-main">
<?php
    bl_temp_content(array(), $PHPince_logon, $PHPINCE_system, $PHPINCE_LANG);
?>
        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mauris dolor, malesuada tristique tempor quis, viverra et augue. Sed ut tellus imperdiet, dapibus nisl sit amet, gravida neque. Donec quis vestibulum turpis, in imperdiet ligula. In sagittis arcu quis rutrum aliquam.</p>
          </div>
          <div class="sidebar-module">
            <h4>Follow me</h4>
            <ol class="list-unstyled">
              <li><a href="#">Google+</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->
      </div><!-- /.row -->
    </div><!-- /.container -->
    <div class="blog-footer">
      <p>Powered by <a href="http://phpince.org" title="Simple Content management system">PHPince - Simple Content management system</a><br>Template by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </div>
</body>
</html>