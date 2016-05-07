<div class="info-box bg-{{$bg or "aqua"}}">
  <span class="info-box-icon"><i class="fa @if(isset($icon)) {{"fa-".$icon}} @endif"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">{{$label}}</span>
    <span class="info-box-number">{{$text or ""}}</span>
    @if(!empty($progress))
      <div class="progress">
        <div class="progress-bar" style="width: {{$progress}}}%"></div>
      </div>
    @endif
    @if(!empty($progressDescription))
      <span class="progress-description">
        70% Increase in 30 Days
      </span>
    @endif
  </div>
</div>