@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Купленные авто</h3>
            @foreach ($userTaxis as $userTaxi)
                <div class="col-md-4 mb-3">
                    <x-my-taxi-card :taxi="$userTaxi"/>
                </div>
            @endforeach
        </div>
    </div>
    <div class="fade" style="width: 15%; margin: auto; background-color: #718096" id="change_color_confirm_window" role="dialog">
        <form method="post" id="myForm">
            @csrf
            <input type="radio" id="red" name="color" value="red">
            <label for="red">Red</label><br>

            <input type="radio" id="yellow" name="color" value="yellow">
            <label for="yellow">Yellow</label><br>

            <input type="radio" id="blue" name="color" value="blue">
            <label for="blue">Blue</label><br>

            <input id="delete_button_click" type="submit" value="Submit">
        </form>
    </div>
    <script>
        $(document).on('click','#btn_change_color',function(e) {
            var tid = this.getAttribute('data-tid');
            var color = this.getAttribute('data-color');
            var element = document.getElementById('change_color_confirm_window');
            var redRadio = document.getElementById(color);
            redRadio.disabled = true;
            element.classList.remove('fade');
            document.getElementById("myForm").setAttribute("action", "update_color/" + tid);
        });
    </script>
@endsection

