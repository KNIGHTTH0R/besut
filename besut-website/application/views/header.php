<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-signin-client_id" content="540463499518-ns8njfhs138fvrg1blfagmgq6vpl2d7m.apps.googleusercontent.com">
        <title>Besut :: Home Page</title>
        <!-- Bootstrap -->
        <link href="<?=$baseurl?>assets/css/bootstrap.min.css" rel="stylesheet">
        <script src="<?=$baseurl?>assets/scripts/jquery.js"></script>
        <!-- Custom -->
        <link href="<?=$baseurl?>assets/css/custom.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <script src="<?=$baseurl?>assets/scripts/APIs/ajaxes.js"></script>
        <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
        <link rel="stylesheet" href="<?=$baseurl?>assets/font-awesome-4.0.3/css/font-awesome.min.css">

        <!-- CSS STYLE-->
        <link rel="stylesheet" type="text/css" href="<?=$baseurl?>assets/css/style.css" media="screen" />

        <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="<?=$baseurl?>assets/rs-plugin/css/settings.css" media="screen" />
        <script>
        var baseurl = '<?=$baseurl?>';
        function onLoad() {
              gapi.load('auth2', function() {
                gapi.auth2.init();
              });
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">

            <div class="headernav">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-1 col-xs-3 col-sm-2 col-md-2 logo "><a href="<?=$baseurl?>home"><img style="height: 65px;" src="<?=$baseurl?>assets/images/logo.png" alt=""  /></a></div>
                        <div class="col-lg-3 col-xs-9 col-sm-5 col-md-3 selecttopic">
                            <!-- <div class="dropdown">
                                <a data-toggle="dropdown" href="#" >Borderlands 2</a> <b class="caret"></b>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Borderlands 1</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-2" href="#">Borderlands 2</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-3" href="#">Borderlands 3</a></li>

                                </ul>
                            </div> -->
                        </div>
                        <div class="col-lg-4 search hidden-xs hidden-sm col-md-3">
                            <div class="wrap">
                                <?php
                                  echo form_open('search', 'class="form"');
                                ?>
                                    <div class="pull-left txt"><input type="text" name="search" class="form-control" placeholder="Search" <?php if (isset($search)) echo "value='".$search."'"?>></div>
                                    <div class="pull-right">
                                      <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-sm-5 col-md-4 avt">
                            <div class="stnt pull-left">
                                <form action="<?=$baseurl?>report" method="post" class="form">
                                    <button class="btn btn-primary" type='submit'>Create Report</button>
                                </form>
                            </div>

                            <div class="env pull-left dropdown">
                              <i data-toggle="dropdown" class="fa fa-envelope"></i>
                              <div class="status"><?=count($notif)?></div>
                              <ul class="dropdown-menu" role="menu">
                                <?php
                                  $i = -1;
                                  foreach ($notif as $value) {
                                    echo '<li role="presentation"';
                                    if ($i == -1)
                                      echo ' style="border-top: none;"';
                                    echo '><a onclick="return markNotif('.$value->IDNOTIF.');" role="menuitem" tabindex="'.$i.'" href="' . $baseurl . 'report/view/' . $value->IDREPORT . '/' . $value->IDCOMMENT. '">Date: ' . $value->DATE_TIME . '<br>' . $value->NOTIF . '</a></li>';
                                    $i--;
                                  }
                                ?>
                              </ul>
                            </div>

                            <div class="avatar pull-left dropdown">
                                <a data-toggle="dropdown" href="#"><img src="<?=$baseurl?>data/pictures/profile/<?=$photo?>" alt="" /></a> <b class="caret"></b>
                                <ul class="dropdown-menu" role="menu">
                                    <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="#">My Profile</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-2" href="#">Inbox</a></li> -->
                                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="signOut();" >Log Out</a></li>
                                    <!-- <li role="presentation"><a role="menuitem" tabindex="-4" href="login">Create account</a></li> -->
                                </ul>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
