
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-xs-12 col-md-8" style="margin-left: auto; margin-right: auto; float: none;">
                            <div class="pull-left"><a href="<?=$now-1>0?$baseurl . 'home/page' . $now-1:'#'?>" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                            <div class="pull-left">
                                <ul class="paginationforum">
                                  <?php
                                  $current = $now?$now:1;
                                  for ($i = $current; $i <= $links; $i++) {
                                    echo '<li><a href="' . $baseurl . 'home/page/' . $i . '"';
                                    if ($i==$current)
                                      echo ' class="active">';

                                    echo $i . "</a></li>";
                                  } ?>
                                </ul>
                            </div>
                            <div class="pull-right"><a href="<?= $now==$links? $baseurl . 'home/page/' . $links:'#'?>" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>


                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8" style="width: 90%; float: none; margin: auto;">
                          <?php for($i = 0; $i < count($posts); $i++): ?>
                            <!-- POST -->
                            <div class="post">
                                <div class="wrap-ut pull-left">
                                    <div class="userinfo pull-left">
                                        <div class="avatar">
                                            <img src="<?=$baseurl?>data/pictures/profile/<?=$posts[$i]->profile?>" alt="" />
                                        </div>

                                        <div class="icons">
                                            <div style="float: left; margin-right: 5px; background: url(<?=$baseurl?>assets/images/radio.jpg) <?=$posts[$i]->closed?'-31px':'0px'?> 0 no-repeat; width: 31px; height: 31px;">
                                            </div>
                                            <?=$posts[$i]->closed?'Finished':'Unfinished'?> Case
                                        </div>
                                    </div>
                                    <div class="posttext pull-left" style="border-right: solid 1px #f1f1f1;">
                                        <h2><a href="<?=$baseurl?>report/view/<?=$posts[$i]->idreport?>"><?=$posts[$i]->title?></a></h2>
                                        <p><?=substr($posts[$i]->content, 0, 300)?>...</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="postinfo pull-left" style="text-align:center; border-left: none;">
                                    <div class="comments">
                                        <div class="commentbg">
                                            <?=$posts[$i]->ctr?>
                                            <div class="mark"></div>
                                        </div>

                                    </div>
                                    <div style="margin: 5px 0px; color: #db7a7a; border-bottom: solid 1px #f1f1f1;"><i class="fa fa-thumbs-o-down"></i> <?=$posts[$i]->vhoax?> Hoax Vote</div>
                                    <div style="margin: 5px 0px; color: #1abc9c; border-bottom: solid 1px #f1f1f1;"><i class="fa fa-thumbs-o-up"></i> <?=$posts[$i]->vnot?> Not Hoax Vote</div>
                                    <div style="margin: 5px 0px;"><i class="fa fa-eye"></i> Bot Estimation <?=$posts[$i]->estimation?>% Hoax</div>
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- POST -->
                          <?php endfor; ?>
                        </div>

                    </div>
                </div>



                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-xs-12 col-md-8" style="margin-left: auto; margin-right: auto; float: none;">
                          <div class="pull-left"><a href="<?=$now-1>0?$baseurl . 'home/page' . $now-1:'#'?>" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                          <div class="pull-left">
                              <ul class="paginationforum">
                                <?php
                                $current = $now?$now:1;
                                for ($i = $current; $i <= $links; $i++) {
                                  echo '<li><a href="' . $baseurl . 'home/page/' . $i . '"';
                                  if ($i==$current)
                                    echo ' class="active">';

                                  echo $i . "</a></li>";
                                } ?>
                              </ul>
                          </div>
                          <div class="pull-right"><a href="<?= $now==$links? $baseurl . 'home/page/' . $links:'#'?>" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
                          <div class="clearfix"></div>
                        </div>
                    </div>
                </div>


            </section>
