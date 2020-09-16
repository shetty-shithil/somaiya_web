@if(count($errors)>0)   
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger sticky" style="color: rgb(141, 7, 7)">
            {{$error}}
        </div>
    @endforeach
@endif  

@if(session('errort'))
        <div class="alert alert-danger sticky" style="background-color :rgb(141, 7, 7); color: white">
            {{session('errort')}}
        </div>
@endif

@if(session('success'))
        <div class="alert alert-success sticky" style="background-color: rgb(77, 240, 140); color: white">
            {{session('success')}}
        </div>
@endif           

  
@if(session('error'))
        <div class="alert alert-danger sticky" style="background-color :rgb(141, 7, 7); color: white">
                {{session('error')}}
        </div>
@endif           
