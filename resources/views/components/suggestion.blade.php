
@foreach ($user as $item)
<div class="my-2 shadow  text-white bg-dark p-1 user-{{ $item->id }}" id="">
  <div class="d-flex justify-content-between">
    <table class="ms-1">
      <td class="align-middle">{{ $item->name }}</td>
      <td class="align-middle"> - </td>
      <td class="align-middle">{{ $item->email }}</td>
      <td class="align-middle"> 
    </table>
    <div>
      <button id="create_request_btn_" onclick="sendRequest({{ $item->id }})" class="btn btn-primary me-1">Connect</button>
    </div>
  </div>
</div>
@endforeach

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
{{-- @if (count() > 0) --}}
<div class="d-flex justify-content-center mt-2 py-3" id="load_more_btn_parent">
  <button class="btn btn-primary" onclick="getMoreRequests()" data-type="" data-limit="" id="load_more_btn">Load more</button>
</div>
    
{{-- @endif --}}

