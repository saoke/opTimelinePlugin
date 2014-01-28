<?php if (!isset($gadget)): ?>
<div id="profileTimeline_<?php echo $memberId ?>" class="dparts profileTimeline"><div class="parts">
<?php else: ?>
<div id="profileTimeline_<?php echo $gadget->id ?>" class="dparts profileTimeline"><div class="parts">
<?php endif; ?>

<script type="text/javascript">
//<![CDATA[
var gorgon = {
      'member_id': '<?php echo $memberId; ?>',
      'count': '20',
      'post': {

      },
      'timerCount': '120000'
    };
var viewPhoto = '<?php echo $viewPhoto ?>';
var MAXLENGTH = 140;
//]]>
</script>


<?php use_javascript('/opTimelinePlugin/js/timeline-loader.api.js', 'last') ?>
<?php use_javascript('/opTimelinePlugin/js/jquery.timeago.js', 'last') ?>
<?php use_javascript('/opTimelinePlugin/js/lightbox.js', 'last') ?>
<?php use_stylesheet('/opTimelinePlugin/css/lightbox.css', 'last') ?>
<?php use_stylesheet('/opTimelinePlugin/css/timeline.css', 'last') ?>

<?php include_partial('timeline/timelineTemplate') ?>

<div class="partsHeading"><h3>メンバーの<?php echo $op_term['activity'] ?></h3></div>

<div class="timeline">
  <div style="display: none" id="timeline-submit-button" class="btn btn-primary timeline-submit" disabled="disabled"></div>
  <div id="timeline-loading" style="text-align: center;"><?php echo op_image_tag('ajax-loader.gif', array()) ?></div>

  <div id="timeline-list" data-last-id=""data-loadmore-id="">
  </div>

  <button class="btn btn-small" id="timeline-loadmore">もっと読む</button>
  <div id="timeline-loadmore-loading"><?php echo op_image_tag('ajax-loader.gif', array()) ?></div>
</div>

</div></div>
<script id="LikelistTemplate" type="text/x-jquery-tmpl">
<table>
<tr style="padding: 2px;">
<td style="width: 48px; padding: 2px;"><a href="${profile_url}"><img src="${profile_image}" width="48"></a></td>
<td style="padding: 2px;"><a href="${profile_url}">${name}</a></td>
</tr>
</table>
</script>

<div id="likeModal" class="modal hide">
  <div class="modal-header">
    <h1>「いいね！」と言っている人</h1>
  </div>
  <div class="like-modal-body">
  </div>
  <div class="modal-footer">
    <a href="#" class="btn close" data-dismiss="modal" aria-hidden="true">閉じる</a>
  </div>
</div>