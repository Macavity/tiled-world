<div class="progress">
  <div class="progress-bar @if($type == "health")progress-bar-success@elseif("special")progress-bar-info@endif" role="progressbar"
       aria-valuenow="{{$value}}"
       aria-valuemin="{{$min || 0}}"
       aria-valuemax="{{ $max || 100 }}"
       style="width: {{ $percent || 100 }}}%;">
    {{ $percent || 100 }}%
  </div>
</div>