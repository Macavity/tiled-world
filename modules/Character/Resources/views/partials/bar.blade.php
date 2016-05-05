<div class="progress">
  <div class="progress-bar @if(!empty($type))progress-bar-{{$type}}@endif" role="progressbar"
       aria-valuenow="{{$value or "0"}}"
       aria-valuemin="{{ $min or 0 }}"
       aria-valuemax="{{ $max or 100 }}"
       style="width:{{$percent or 100}}%;">
    {{ $percent or 100 }}%
  </div>
</div>