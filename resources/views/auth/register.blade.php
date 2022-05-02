@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}  
                     @if (Route::has('login'))
                    <a  class="text-success float-right"href="{{ route('login') }}">{{ __('Login') }}</a>
                 
                  @endif</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}"enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12">
                                <label for="name" >{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                               
                            </div>
    
                            <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12">
                                <label for="email" >{{ __('E-Mail Address') }}</label>
    
                                
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                            </div>
                        </div>
                        <div class="row">
                            
                        <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12">
                            <label for="password" class="">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-6 col-12">
                            <label for="password-confirm" {{--class="col-md-4 col-form-label text-md-right"--}}>{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                            
                        </div>

                        
                        <div class="form-group">
                            <label for="phone">Photo</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                   <input id="image" type="file" name="image" class=" form-control custom-file-input @error('image') is-invalid @enderror" id="last_image"onchange ="getimg(this)">
                                   <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                                   
                                </div>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                   
                        </div>
                        <div class="col-12 ml-10">
                            
                            <img id="imgpho"alt="photo " style="max-height: 100px;max-width: 150px">
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
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

<script src="{{asset('js/storeimage.js')}}"></script>
@endsection
