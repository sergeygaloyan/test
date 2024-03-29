<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $taxi->original->name }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $taxi->price }} руб.</h6>
        <h7 class="color" style="color: {{$taxi->color}}"> {{strtoupper( $taxi->color )}}</h7>
        <input type="submit" data-tid="{{$taxi->id}}" data-color="{{$taxi->color}}" id="btn_change_color" value="Перекрасить">
    </div>
</div>

