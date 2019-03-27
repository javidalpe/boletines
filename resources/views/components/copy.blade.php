{!! Form::text('link', $url, array('class' => 'form-control', 'id' => $id)) !!}
<br>
<button onclick="copyLink('{{$id}}')" class="btn btn-primary">{{$label}}</button>

<script>
  function copyLink(id) {
    var copyText = document.getElementById(id);
    copyText.select();
    document.execCommand("copy");
  }
</script>
