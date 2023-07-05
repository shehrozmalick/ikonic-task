@foreach ($commonConnectionUsers as $item)
 <div class="p-2 shadow rounded mt-2  text-white bg-dark">{{ $item->name }} - {{ $item->email }} </div>   
@endforeach