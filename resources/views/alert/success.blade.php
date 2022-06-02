@if (session('status'))
<div class="alert alert-success alert=dismissible">
    <button class="close" type="submit" data-dismiss="alert" aria-hidden="true">x</button>
    {{session('status')}}
</div>

@endif
