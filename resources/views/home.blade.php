<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <title>{{__("messages.title")}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    </head>
    <body>

       <div class="container text-center">

            <ul>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a class="btn btn-outline-primary" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <h1>{{__('messages.ToDoList')}}</h1>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif
             @if (Session::has('fail'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('fail')}}
                </div>
            @endif

            <form action="{{route('create')}}" method="post" class="form-group text-left" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                      <label>{{__('messages.taskName')}}</label>  <input type="text" class="form-control" name="taskName">
                      @error('taskName')
                        <div class="alert alert-danger  my-2">{{$message}}</div>
                      @enderror
                      <label>{{__('messages.taskCategory')}}</label>  <input type="text" class="form-control" name="taskCategory">
                      @error('taskCategory')
                      <div class="alert alert-danger my-2">{{$message}}</div>
                      @enderror
                      <label>{{__('messages.taskImage')}}</label><br>  <input type="file"  name="taskImage"> <br><br>
                      @error('taskImage')
                      <div class="alert alert-danger  my-2">{{$message}}</div>
                      @enderror
                      <label>{{__('messages.taskDesc')}}</label> <textarea class="form-control" rows="5" id="summary-ckeditor" name="taskDesc"></textarea>
                      @error('taskDesc')
                      <div class="alert alert-danger  my-2">{{$message}}</div>
                      @enderror
                      <button class="btn btn-primary my-2" type="submit">{{__('messages.addNewTask')}}</button>
                    </div>
                </div>
            </form>

            <div>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>

                      </tr>
                    </thead>
                    <tbody>

                        <button hidden>{{$i=0}}</button>
                        @foreach ($data as $item)
                          <button hidden>{{$i++}}</button>
                          <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->category}}</td>
                            <td> <img src="{{asset('images/'.$item->image)}}" alt=""></td>
                            <td >{!! $item->description !!}</td>
                            <td><a href="{{route('edit',$item->id)}}" class="btn btn-primary" style="color: white;cursor: pointer;">{{__('messages.taskEdit')}}</a></td>
                            <td><a href="{{route('delete',$item->id)}}" class="btn btn-danger" style="color: white;cursor: pointer;">{{__('messages.taskDelete')}}</a></td>
                          </tr>
                        @endforeach

                    </tbody>
                  </table>

            </div>
       </div>
       <script src="{{asset('js/jquery-3.4.1.slim.min.js')}}"></script>
       <script src="{{asset('js/js/popper.min.js')}}"></script>
       <script src="{{asset('js/bootstrap.min.js')}}"></script>
       <script src="{{asset('js/javascript.js')}}"></script>
       <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script>
            CKEDITOR.replace( 'summary-ckeditor' );
        </script>

    </body>
</html>
