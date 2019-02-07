@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="{{route('regex.store')}}" class="form-horizontal" method="post">
                @csrf
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" name="link" class="form-control input-lg"/>
                </div>
                <input type="submit" class="btn btn-primary btn-lg">

                @isset($regex)
                    <input id="myInput" type="text" value="{{$regex}}" class="form-control
                    input-lg"/>
                    <button onclick="myFunction()" class="btn btn-default">Copy text</button>

                    @push('scripts')
                        <script>
                          function myFunction() {
                            /* Get the text field */
                            var copyText = document.getElementById("myInput");

                            /* Select the text field */
                            copyText.select();

                            /* Copy the text inside the text field */
                            document.execCommand("copy");

                            /* Alert the copied text */
                            //alert("Copied the text: " + copyText.value);
                          }
                        </script>
                    @endpush
                @endif
            </form>
        </div>
    </div>
@endsection