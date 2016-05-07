<div class="info-box">
  <span class="info-box-icon bg-{{$bg or "aqua"}}">
    <i class="fa @if(isset($icon)) {{"fa-".$icon}} @endif"></i>
  </span>
  <div class="info-box-content">
    <span class="info-box-text">{{$label}}</span>
    <span class="info-box-number">{{$text or ""}}</span>
  </div>
</div>