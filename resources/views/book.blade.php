@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                 <!-- Default panel contents -->
                <div class="panel-heading" id="app">รายการหนังสือที่อัพโหลด</div>
                <div class="panel-body">
                    <div id="books" class="infinite-scroll">
                        <div class="form-inline">
                            <input type="text" v-model="search" class="form-control search-input" placeholder="Search in list"/> 
                            <a href="{{ route('upload') }}" role="button" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> อัพโหลด flipbook</a> 
                        </div>
                    @foreach($books as $b)
                
                        
                        <div class="media">

                            <div class="media-left media-middle">
                                <img src="{{url('storage/book/'.str_replace('large','thumb', $b->cover_file) ) }}" alt="{{$b->title}}" class="media-object">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{$b->title}}</h4>
                                <p class="media-description">{{$b->description}}</p>
                                <div class="media-icon">
                                    <ul>
                                        <li><i class="fa fa-graduation-cap"></i> @{{$b->gradetitle}} </li>
                                        <li><i class="fa fa-folder"></i> @{{$b->subject}} </li>
                                        <li><i class="fa fa-bar-chart"></i> {{$b->view}} </li>
                                    </ul>
                                </div>
                                <p>
                                    <a href="#" class="media-option"><i class="fa fa-pencil"></i> Edit</a> 
                                    @if(!Auth::guest() && Auth::user()->admin == 1)
                                    <a href="#" @click="rmb({{ $b->id }})"  class="media-option"><i class="fa fa-trash"></i> ลบรายการนี้</a>
                                    @endif
                                    <a href="{{url('storage/book/'.$b->fileUrl)}}" target="_blank"  class="media-option"><i class="fa fa-external-link"></i> Open</a>
                                </p>
                            </div>
                          
                        </div>
                        
                    @endforeach
                    
                  </div>
                  {{ $books->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
       const books ={!! json_encode($books) !!}
       vm = new Vue({
            el: '#books',
            @verbatim
            template: `<div>
                        <div class="form-inline">
                            <input type="text" v-model="search" class="form-control search-input" placeholder="Search in list"/> 
                            <button @click="searchbook" class="btn btn-danger"><i class="fa fa-search"></i> ค้นหา</button>
                            <a href="/upload" role="button" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> อัพโหลด flipbook</a> 
                        </div>
                        
                        <div class="media"  v-for="(b, index) in booklist">
                            
                            <div class="media-left media-middle">
                            <a :href="'/storage/book/'+b.fileUrl" target="_blank" class="media-option">
                                <img :src="'/storage/book/'+b.cover_file" class="media-object"/>
                            </a>
                            </div>

                            <div class="media-body">
                                
                                <h4 class="media-heading">{{ b.title }}</h4>
                                <p class="media-description">{{ b.description }}</p>
                                <div class="media-icon">
                                    <ul>
                                        <li><i class="fa fa-graduation-cap"></i> {{ b.gradetitle }} </li>
                                        <li><i class="fa fa-folder"></i> {{ b.subject }} </li>
                                        <li><i class="fa fa-bar-chart"></i> {{ b.view }} </li>
                                    </ul>
                                </div>
                                <a href="#" class="media-option"><i class="fa fa-pencil"></i> Edit </a> 
                                
                                 <a href="#" @click="rmb(b, index)" class="media-option"><i class="fa fa-trash"></i> Remove</a>
                                
                                <a :href="'/storage/book/'+b.fileUrl" target="_blank" class="media-option"><i class="fa fa-external-link"></i> Open</a>
                                
                                <template v-if="b.sub_cat === null">
                                    <a href="#" class="media-option text-danger"><i class="fa fa-exclamation-triangle"></i> กรุณาอัพเดทข้อมูล</a>
                                </template>
                            </div>

                        </div>
                    </div>`,
            @endverbatim
            data: function () {
                return {
                    search: '',
                    booklist: books.data
                }
            },
            methods: {
                rmb: function(row, index) {
                   
                    swal({
                        title: 'Are you sure?',
                        text: 'ต้องการลบหนังสือ ใช่หรือไม่?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    })
                    .then(function () {
                        axios.get('/api/remove/book?id=' + row.id)
                        .then( res => {

                            vm.booklist.splice(index, 1)
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        });                        
                    }.bind(this))
                },
                searchbook: function()
                {
                    axios.get('/api/search-book?q=' + this.search )
                    .then( res => {
                        this.booklist = res.data.book
                    })
                },
            }
        })
    </script>
@endsection