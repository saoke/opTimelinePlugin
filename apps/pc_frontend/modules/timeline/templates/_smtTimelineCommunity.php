<?php use_helper('opUtil', 'Javascript', 'opAsset') ?>
<script type="text/javascript">
//<![CDATA[
var gorgon = {
      'target': 'community',
      'target_id': <?php echo $id; ?>,
      'count': '20',
      'post': {
        'foreign': 'community',
        'foreignId': '<?php echo $id; ?>'
      }
    };
var viewPhoto = '<?php echo $viewPhoto ?>';
var MAXLENGTH = 140;

var fileMaxSizeInfo = {
  'format': '<?php echo $fileMaxSize['format'] ?>',
  'size'  : '<?php echo $fileMaxSize['size'] ?>'
}

//]]>
</script>
<?php op_smt_use_stylesheet('/opTimelinePlugin/css/jquery.colorbox.css') ?>
<?php op_smt_use_stylesheet('/opTimelinePlugin/css/timeline-smartphone.css', 'last') ?>
<?php op_smt_use_javascript('/opTimelinePlugin/js/jquery.colorbox.js', 'last') ?>
<?php op_smt_use_javascript('/opTimelinePlugin/js/jquery.timeline.js', 'last') ?>
<?php op_smt_use_javascript('/opTimelinePlugin/js/jquery.timeago.js', 'last') ?>
<?php op_smt_use_javascript('/opTimelinePlugin/js/timeline-loader-smartphone.js', 'last') ?>

<script id="timelineTemplate" type="text/x-jquery-tmpl">
        <div class="timeline-post">
          {{if public_status != 'sns' }}
          <div class="only-border-top"></div>
          {{/if}}
          <a name="timeline-${id}"></a>
          <div class="timeline-post-member-image">
            <a href="${member.profile_url}"><img src="${member.profile_image}" alt="member-image" width="23" class="rad6" /></a>
          </div>
          <div class="timeline-post-content">
            <div class="timeline-member-name">
              <a href="${member.profile_url}">{{if member.screen_name}} ${member.screen_name} {{else}} ${member.name} {{/if}}</a>
              <div class="timestamp timeago" title="${created_at}"></div>
            </div>
            <div class="timeline-post-body" id="timeline-body-context-${id}">
              {{html body_html}}
            </div>
            <!-- Like Plugin -->
              <div class="row like-wrapper" data-like-id="${id}" data-like-target="A" member-id="${member.id}" style="display: none;">
              <span class="span5" style="text-align: center;">
              <a class="like-post">いいね！</a>
              <a class="like-cancel">いいね！を取り消す</a>
              </span>
              <span class="span3" style="text-align: center;">
              <a class="like-list"></a>
              </span>
              </div>
          </div>


          <div class="timeline-post-control">
            <a href="#timeline-${id}" class="timeline-comment-link">コメントする</a>
            <span class="timeline-post-control-show">
              {{if public_status == 'friend' }}
              <span class="icon-lock"></span>
              <span class="public-flag"><?php echo $op_term['my_friend'] ?>まで</span>
              {{else public_status == 'private' }}
              <span class="icon-lock"></span>
              <span class="public-flag">公開しない</span>
              {{/if}}
            </span>
          </div>

          <a>
            <div id="timeline-comment-loadmore-${id}" data-timeline-id="${id}" class="timeline-comment-loadmore">
              <i class="icon-comment"></i>&nbsp;以前のコメントを見る
              <span id="timeline-comment-loader-${id}" class="timeline-comment-loader">
                <?php echo op_image_tag('ajax-loader.gif', array()) ?>
              </span>
            </div>
          </a>

          <div class="timeline-post-comments" id="commentlist-${id}">

            <div id="timeline-post-comment-form-${id}" class="timeline-post-comment-form">
            <input class="timeline-post-comment-form-input" type="text" data-timeline-id="${id}" id="comment-textarea-${id}" /><button data-timeline-id="${id}" class="btn btn-primary btn-mini timeline-comment-button" disabled="disabled">投稿</button>
            </div>
            <div id="timeline-post-comment-form-loader-${id}" class="timeline-post-comment-form-loader">
              <?php echo op_image_tag('ajax-loader.gif', array()) ?>
            </div>
          </div>


          {{if public_status != 'sns' }}
          <div class="only-border-bottom"></div>
          {{/if}}
        </div>
</script>

<script id="timelineCommentTemplate" type="text/x-jquery-tmpl">
            <div class="timeline-post-comment">

              <div class="timeline-post-comment-member-image">
                <a href="${member.profile_url}"><img src="${member.profile_image}" alt="" width="23" class="rad6" /></a>
              </div>
              <div class="timeline-post-comment-content">
                <div class="timeline-post-comment-name-and-body">
                <a href="${member.profile_url}">{{if member.screen_name}} ${member.screen_name} {{else}} ${member.name} {{/if}}</a>
                </div>
              </div>
              <div class="timeline-post-comment-control timestamp timeago" title="${created_at}"></div>
              <div class="timeline-post-comment-body">
              {{html body_html}}
              </div>
              <div class="row like-wrapper" data-like-id="${id}" data-like-target="A" member-id="${member.id}" style="display: none; margin-left: 28px;">
              <span class="span5" style="text-align: center;">
              <a class="like-post">いいね！</a>
              <a class="like-cancel">いいね！を取り消す</a>
              </span>
              <span class="span4" style="text-align: center;">
              <a class="like-list"></a>
              </span>
              </div>
            </div>
</script>

<div class="row">
<div class="gadget_header span12"><?php echo $community->getName() ?><?php echo $op_term['activity'] ?></div>
</div>

<div id="timeline-list" class="span12" data-post-baseurl="<?php echo url_for('@homepage', array('absolute' => true)); ?>" data-last-id="" data-loadmore-id="" style="margin-left: 0px;">
</div>
<div id="timeline-list-loader" class="row span12 center show" style="margin-top: 20px; margin-bottom: 20px;">
<?php echo op_image_tag('ajax-loader.gif', array('alt' => 'Now Loading...')) ?>
</div>
<div class="row">
  <button class="span12 btn small" id="gorgon-loadmore">もっと読む</button>
</div>
