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
                        <div class="col-lg-8 col-md-8" style="width: auto;">



                            <!-- POST -->
                            <div class="post">
                              <?= form_open_multipart('report/submiting', 'class="form newtopic" id="report"') ?>
                                    <div class="topwrap">
                                        <div class="posttext" style="margin:auto;">

                                            <div>
                                                <input type="text" id="title" name="title" placeholder="Enter Report Title" class="form-control" />
                                                <input type="text" id="link" name="link" placeholder="Enter Link (optional)" class="form-control" />
                                            </div>
                                            <div>
                                                <textarea name="web" id="web" style="display: none; resize: none; height: 265px;" placeholder="Please Copy Paste The Article From The Website, so the bot can calculate which the Article is Hoax or not"  class="form-control" ></textarea>
                                                <textarea name="desc" id="desc" style="resize: vertical; height: 365px;" placeholder="Explanation"  class="form-control" ></textarea>
                                            </div>
                                            <div class="row newtopcheckbox">
                                                <div class="col-lg-6 col-md-6">
                                                    <div><p>Have any picture? Upload it!</p>
                                                      <?= form_upload('photos[]','','multiple class="btn btn-primary" style="width: 100%; height: auto;"') ?>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-lg-6 col-md-6">
                                                    <div>
                                                        <p>Share on Social Networks</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-4">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="fb" name="share_facebook"/> <i class="fa fa-facebook-square"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-4">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="tw" name="share_twitter"/> <i class="fa fa-twitter"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-4">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="gp" name="share_google" /> <i class="fa fa-google-plus-square"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>


                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="postinfobot">

                                        <div class="notechbox pull-left">
                                            <input type="checkbox" name="note" id="note" class="form-control" />
                                        </div>

                                        <div class="pull-left">
                                            <label for="note" style="color: black;"> I've read forum guide</label>
                                        </div>

                                        <div class="pull-right postreply">
                                            <div class="pull-left"><button class="btn btn-primary" name="btnSubmit" onclick="return checkGuide()" style="width: 175px;" type='submit'>Submit Report</button></div>
                                            <div class="clearfix"></div>
                                        </div>


                                        <div class="clearfix"></div>
                                    </div>
                                <?= form_close() ?>
                            </div><!-- POST -->



                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-xs-12">
                            <!-- <div class="pull-left"><a href="#" class="prevnext"><i class="fa fa-angle-left"></i></a></div> -->
                            <!-- <div class="pull-left">
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
                            </div> -->
                            <!-- <div class="pull-left"><a href="#" class="prevnext last"><i class="fa fa-angle-right"></i></a></div> -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>


            </section>
