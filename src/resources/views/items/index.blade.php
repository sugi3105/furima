@foreach($items as $item)
  <a href="/item/{{ $item->id }}">
    <div>
      <img src="{{ $item->img_url }}">
      <p>{{ $item->name }}</p>
      <p>{{ $item->price }}円</p>
    </div>
@endforeach

