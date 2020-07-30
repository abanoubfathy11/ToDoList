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
                <li>
                    <a href="{{route('home')}}" class="btn btn-outline-primary">Home</a>
                </li>
            </ul>
            <h1>{{__('messages.ToDoList')}}</h1>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif

            <form action="{{route('update',$task->id)}}" method="POST" class="form-group text-left" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                    <label>{{__('messages.taskName')}}</label>  <input type="text" class="form-control" name="taskName" value="{{$task->name}}">
                      @error('taskName')
                        <div class="alert alert-danger  my-2">{{$message}}</div>
                      @enderror
                    <label>{{__('messages.taskCategory')}}</label>  <input type="text" class="form-control" name="taskCategory" value="{{$task ->category}}">
                      @error('taskCategory')
                      <div class="alert alert-danger my-2">{{$message}}</div>
                      @enderror
                    <label>{{__('messages.taskImage')}}</label><br>  <input type="file"  name="taskImage" value="{{$task->image}}">
                    @if ($task->image!='')
                        <img  src="{{asset('images/'.$task->image)}}">
                    @endif
                    <br><br>
                      @error('taskImage')
                      <div class="alert alert-danger  my-2">{{$message}}</div>
                      @enderror
                    <label>{{__('messages.taskDesc')}}</label> <textarea class="form-control" rows="5" id="summary-ckeditor" name="taskDesc">{{$task->description}}</textarea>
                      @error('taskDesc')
                      <div class="alert alert-danger  my-2">{{$message}}</div>
                      @enderror
                      <button class="btn btn-success my-2" type="submit">{{__('messages.taskSave')}}</button>
                    </div>
                </div>
            </form>



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
