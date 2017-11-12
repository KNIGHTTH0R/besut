            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 breadcrumbf">
                            <a href="home">Besut</a> <span class="diviver">&gt;</span> <a href="<?= $position ?>"><?= $position ?></a>
                        </div>
                    </div>
                </div>


                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8" style="width: 100%;">

                            <!-- POST -->
                            <div class="post beforepagination" style="margin-bottom: 20px;">
                              <div class="postinfotop">
                                        <div class="avatar" style="float: left; margin: 10px 20px 0px 20px;">
                                            <img src="<?=$baseurl?>data/pictures/profile/<?=$profile?>" alt="" />
                                        </div>
                                        <h2 style="float">Reported By <?=$name?></h2>
                                    </div>
                                <div class="topwrap">
                                    <div class="userinfo pull-left">
                                      Bot:
                                      <h3 style="margin-top: 5px;"><?=$estimation==1?'HOAX':'NOT HOAX'?></h3><br>
                                        <div style="float: left; margin-right: 5px; background: url(<?=$baseurl?>assets/images/radio.jpg) <?=$closed?'-31px':'0px'?> 0 no-repeat; width: 31px; height: 31px;">
                                        </div>
                                        <div style="float:left; margin-top: -3px; width: 70px;">
                                          <?=$closed?'Finished':'Unfinished'?> Case
                                        </div>
                                    </div>
                                    <div class="posttext pull-left">
                                        <p hidden id='idreport'><?=$idreport?></p>
                                        <h2><?=$title?></h2>
                                        <?php if ($link != '' || $pics != ''): ?>
                                        <blockquote>
                                            <span class="original">Link: <a style="word-wrap: break-word;" href=<?=$link?>><?=$link?></a></span>
                                            <span class="original">Pictures: </span>
                                            <?php
                                              $picture = explode('~',$pics);
                                              for ($i = 0; $i < count($picture)-1; $i++)
                                              {
                                                $path = $baseurl . 'data/pictures/reports/' . $picture[$i];
                                                echo "<a href='$path' target='_blank'><img class='image_attch' src='$path'></a>";
                                              }
                                             ?>
                                        </blockquote>
                                      <?php endif; ?>
                                        <p><?=$content?></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="postinfobot">
                                    <div class="likeblock pull-left" style="width: auto; margin-right: 15px;">
                                        <a href="#" class="up" onclick='postVote(<?=$idreport?>, true)'><i class="fa fa-thumbs-o-up" title="Vote Hoax"></i><span id='ctrnot'><?= $vnot ?> Vote not Hoax</span></a>
                                        <a href="#" class="down" onclick='postVote(<?=$idreport?>, false)'><i class="fa fa-thumbs-o-down" title="Vote Hoax"></i><span id='ctrhoax'><?= $vhoax ?> Vote HOAX</span></a>
                                    </div>

                                    <div class="posted pull-left"><i class="fa fa-clock-o"></i> Reported on : <?= date("H:i:s d F Y", strtotime($dtm)) ?></div>
                                    <div class="next pull-right"><a href="#"><i class="fa fa-share"></i></a></div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                  if ($focuson != '')
                                  echo "<script>window.location.hash = '#" . $focuson ."'</script>";
                                ?>
                            </div><!-- POST -->

                            <!-- <div class="paginationf">
                                <div class="pull-left"><a href="#" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                                <div class="pull-left">
                                    <ul class="paginationforum">
                                        <li class="hidden-xs"><a href="#">1</a></li>
                                        <li class="hidden-xs"><a href="#">2</a></li>
                                        <li class="hidden-xs"><a href="#">3</a></li>
                                        <li class="hidden-xs"><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">6</a></li>
                                        <li><a href="#" class="active">7</a></li>
                                        <li><a href="#">8</a></li>
                                        <li class="hidden-xs"><a href="#">9</a></li>
                                        <li class="hidden-xs"><a href="#">10</a></li>
                                        <li class="hidden-xs hidden-md"><a href="#">11</a></li>
                                        <li class="hidden-xs hidden-md"><a href="#">12</a></li>
                                        <li class="hidden-xs hidden-sm hidden-md"><a href="#">13</a></li>
                                        <li><a href="#">1586</a></li>
                                    </ul>
                                </div>
                                <div class="pull-left"><a href="#" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
                                <div class="clearfix"></div>
                            </div> -->
