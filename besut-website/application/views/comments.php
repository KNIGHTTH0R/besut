<div id='comments'>
<?php
  for ($i = 0; $i < count($comments); $i++):
 ?>
 <!-- POST -->
 <div class="post" id='<?=$comments[$i]->idcomment?>'>
     <div class="topwrap">
         <div class="userinfo pull-left">
             <div class="avatar">
                 <img src="<?=$baseurl?>data/pictures/profile/<?=$comments[$i]->profile?>" alt="" />
             </div>
             <?php if ($comments[$i]->prior == true) : ?>
             <div class="icons">
                 <img src="<?=$baseurl?>assets/images/icon6.jpg" alt="" />
             </div>
             <?php endif; ?>
         </div>
         <div class="posttext pull-left">
             <p class='p_comments' id='p_<?=$comments[$i]->idcomment?>'><?=$comments[$i]->ccontent?></p>
         </div>
         <div class="clearfix"></div>
     </div>
     <div class="postinfobot">
         <div class="likeblock pull-left">
             <a href="#" onclick="return voteComment(<?=$comments[$i]->idcomment?>, true)" class="up"><i class="fa fa-thumbs-o-up"></i><span id='up_<?=$comments[$i]->idcomment?>'><?=$comments[$i]->vup?></span></a>
             <a href="#" onclick="return voteComment(<?=$comments[$i]->idcomment?>, false)" class="down"><i class="fa fa-thumbs-o-down"></i><span id='down_<?=$comments[$i]->idcomment?>'><?=$comments[$i]->vdown?></span></a>
         </div>
         <div class='infoarea'>
           <div class="prev pull-left">
               <a href="#" onclick="return false"><i class="fa fa-reply"></i></a>
           </div>

           <div class="posted pull-left"><i class="fa fa-clock-o"></i> Posted on : <?= date("H:i:s d F Y", strtotime($comments[$i]->dtm)) ?></div>

           <div class="clearfix"></div>
           <div class='commentarea'><p hidden><?=$comments[$i]->idcomment?></p></div>
         </div>
         <div id='child_<?=$comments[$i]->idcomment?>'></div>

     </div>
 </div><!-- POST -->

 <?php
 if ($comments[$i]->cparent != 0)
 echo "<script>document.getElementById('child_" . $comments[$i]->cparent . "').innerHTML += document.getElementById('" . $comments[$i]->idcomment . "').innerHTML;
 document.getElementById('" . $comments[$i]->idcomment . "').remove();</script>";

 endfor;?>

<div id='commenttemp' hidden>
  <form action="return false" class="form" method="post">
      <div class="topwrap">
          <div class="posttext pull-right">
              <div class="textwraper">
                  <div class="postreply">Post a Reply</div>
                  <textarea style="resize: vertical; color: black;" name="reply" placeholder="Type your message here"></textarea>
              </div>
          </div>
          <div class="clearfix"></div>
      </div>
      <div class="postinfobot">

          <div class="pull-right postreply">
              <div class="pull-left"><button type="submit" onclick="return false;" class="btn btn-primary">Post Reply</button></div>
              <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
      </div>
  </form>
</div>

<!-- POST -->
<div class="post">
    <form action="return false" class="form" method="post" id='child_parent'>
        <div class="topwrap">
            <div class="userinfo pull-left" style="width: 10%;">
                <div class="avatar">
                    <img src="<?=$baseurl?>data/pictures/profile/<?=$photo?>" alt="" />
                </div>
            </div>
            <div class="posttext pull-left" style="width: 90%;">
                <div class="textwraper">
                    <div class="postreply">Post a Reply</div>
                    <textarea style="resize: vertical; color: black;" name="reply" id="reply" placeholder="Type your message here"></textarea>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="postinfobot">

            <div class="pull-right postreply">
                <div class="pull-left"><button type="submit" class="btn btn-primary">Post Reply</button></div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </form>
</div><!-- POST -->
</div>
<script src="<?=$baseurl?>assets/scripts/APIs/comments.js"></script>
