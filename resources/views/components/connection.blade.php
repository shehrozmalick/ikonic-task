@foreach ($connections as $item)
    @php
        $user = Auth::user()->id == $item->user_id ? $item->ConnectedUser : $item->User;
        $connection = new \App\Http\Controllers\ConnectionController();
    @endphp
  <div class="my-2 shadow text-white bg-dark p-1 user-{{ $item->id }}" id="">
    <div class="d-flex justify-content-between">
      <table class="ms-1">
        <td class="align-middle">{{ $user->name }}</td>
        <td class="align-middle"> - </td>
        <td class="align-middle">{{ $user->email }}</td>
        <td class="align-middle">
      </table>
      <div>
        <button style="width: 220px" id="get_connections_in_common_" onclick="getConnectionsInCommon({{ $user->id }})" class="btn btn-primary" type="button"
          data-bs-toggle="collapse" data-bs-target="#collapse_{{ $item->id }}" aria-expanded="false" aria-controls="collapseExample">
          
          Connections in common ({{  count($connection->getCommon($user->id)) }})
        </button>
        <button id="create_request_btn_" onclick="removeConnection({{ $item->id }})" class="btn btn-danger me-1">Remove Connection</button>
      </div>

    </div>
    <div class="collapse" id="collapse_{{ $item->id }}">

      <div id="content_{{ $user->id }}" class="p-2">
        
              {{-- Display data here --}}
           {{-- <x-connection_in_common :item="$item" /> --}}
      
      </div>
      <div id="connections_in_common_skeletons_">
        {{-- Paste the loading skeletons here via Jquery before the ajax to get the connections in common --}}
      </div>
      <div class="d-flex justify-content-center w-100 py-2">
        <button class="btn btn-sm btn-primary" id="load_more_connections_in_common_">Load
          more</button>
      </div>
    </div>
  </div>
@endforeach
