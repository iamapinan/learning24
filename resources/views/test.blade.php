@extends('layouts.app')

@section('content')

<div id="app1">
  <ul>
    <li v-for="(i, index) in text">
      <h3>@{{ i.title + i.id }}</h3>
      <p>@{{ i.data }}</p>
      <button @click="test(i.id, i.title)" class="btn btn-success">
        Add to cart!
      </button>
    </li>
  </ul>
  
</div>
@endsection

@section('scripts')
<script>
new Vue({
  el: '#app1',
  data: {
    text: [
    	{id: 1, title: 'items ', data: 'items 1 data description'},
        {id: 2, title: 'items ', data: 'items 2 data description'},
        {id: 3, title: 'items ', data: 'items 3 data description'},
        ]
    },
    methods: {
        test: function(id, name) {
        alert(name + id + ' was added to cart!')
        }
    }
    });

</script>
@endsection