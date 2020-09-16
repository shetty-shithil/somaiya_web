{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('inc.navbar')
@include('inc.messages')
{{-- @extends('layouts.app') --}}
@section('content')

    <div class="row">
                <div id="my_container">        
                    {{-- <form method="POST" action="{{ route('register') }}"> --}}
                    {!! Form::open(['action'=>'UsersController@register', 'method'=>'POST','class'=>'event-details col s12 m12 l12 p-0', 'id'=>'form', 'enctype'=>'multipart/form-data'])!!}
                        @csrf
                        <div class="row m-0">
                            {{-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Names') }}</label> --}}
                            <div class="name">
                                <div class="input-field col s12">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    {{-- {{Form::text('name', '',['class'=>'form-control ','id'=>'name'])}}         --}}
                                    <label for="name">Enter Name</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="row m-0">
                                {{-- <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus> --}}
                                {{-- @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            {{-- </div>  --}}
                        </div>

                        <div class="row m-0">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}
                            <div class="email">
                                <div class="input-field col s12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <label for="email">Enter email</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="col-md-6"> --}}
                                {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"> --}}
 
                                {{-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                            </div> --}}
                        </div>

                        <div class="row m-0">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-6">
                                {{-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> --}}
                                <div class="password">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        <label for="password">Enter Password</label>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                    </div>
                                </div>
                                {{-- @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="row m-0">
                            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div> --}}
                            <div class="password-confirm">
                                <div class="input-field col s12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <label for="password-confirm">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="designation">
                                <div class="input-field col s12 p-0">
                                    {{-- <select id="designation_id">
                                        <option value="" disabled selected>Select</option>
                                        <option value="1">Principal</option>
                                        <option value="2">Vice Principal</option>
                                        <option value="3">Dean of Academics</option>
                                        <option value="3">HOD</option>
                                    </select> --}}
                                    {{Form::select('designation',$designation,'null',['class'=>'browser-default','placeholder' => 'Select'])}}
                                    {{Form::label('designation','Designation')}}
                                </div>
                            </div>
                            <div class="row m-0">
                                <div class="designation">
                                    <div class="input-field col s12 p-0">
                                        {{-- <select id="department">
                                            <option value="" disabled selected>Select</option>
                                            <option value="1">Computer</option>
                                            <option value="2">IT</option>
                                            <option value="3">EXTC</option>
                                            <option value="3">ETRX</option>
                                        </select> --}}
                                        {{Form::select('department',$department,'null',['class'=>'browser-default','placeholder' => 'Select'])}}
                                        {{Form::label('department','Department')}}
                                    </div>
                                </div>
                            <div class="admin">
                                <div class="input-field col s12 p-0">
                                    {{-- <select id="admin">
                                        <option value="" disabled selected>Select</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select> --}}
                                    {{Form::select('admin',$admin,'null',['class'=>'browser-default','placeholder' => 'Select'])}}
                                    {{Form::label('admin','Admin')}}
                                </div>
                            </div>
                         </div>   
                        {{-- <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div> --}}
                            {{-- @if($errors->any())
                            <div class="row collapse">
                                <ul class="alert-box warning radius">
                                    @foreach($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif --}}
                        {{-- <div>    
                            <button type="submit" class="btn col m4 s5 offset-s4 mar-15 btn-modify offset-m4">Send</button>
                        </div> --}}
                        {{-- {{Form::submit(['class'=>"btn col m4 s5 offset-s4 mar-15 btn-modify offset-m4",'placeholder'=>'Click Me!'])}}  --}}
                        {{-- </form> --}}
                        {{ Form::button('Click Me!', ['type' => 'submit','class' => 'btn col m4 s5 offset-s4 mar-15 btn-modify offset-m4'] )  }}
                    {!!Form::close()!!} 
                </div>
       
            </div>
@endsection
