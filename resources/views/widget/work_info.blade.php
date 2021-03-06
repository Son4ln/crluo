<div class="alert alert-info alert-dismissable">
  <i class="fa fa-info"></i>
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  @lang('messages.rooms.crluo_alert_1')<br>
  @lang('messages.rooms.crluo_alert_2')
</div>
<div class='panel panel-default'>
  <div class='panel-heading'>
      <h4>
        @lang('creative_rooms.show.crluo_message_title')
        <span class="pull-right hidden loading-text">
          <i class="fa fa-refresh fa-spin fa-fw"></i><span class="sr-only">Loading...</span>
        </span>
      </h4>
  </div>
  <div class="panel-body message-dialog" id="crluo-messages">
      @include('widget.messages.crluo_messages', ['messages' => $infos])
  </div>
  <div class="panel-heading">
    <form id='sendinfoform' class='form-virtical' method='post' action='/messages/send'>
      <div class="form-group">
          <textarea id="crluo_message" class='form-control' style='margin: 1rem 0;' rows='3'></textarea>
      </div>
      <div class="form-group">
          <button id='admin-user-search-btn' class='btn btn-warning ui-submit' data-loading-text="送信中">@lang('admin.rooms.show.message_submit')</button>
          <span class="sending hidden" style="font-size: 0.8em">@lang('admin.rooms.show.sending')</span>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  $('.message-dialog').scrollTop(1000)
</script>
