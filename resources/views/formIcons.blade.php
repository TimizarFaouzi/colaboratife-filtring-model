<!DOCTYPE html>
<html>
<head>
  <title>Laravel 8 Uploading Image</title>
 
  <meta name="csrf-token" content="{{ csrf_token() }}">
 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
</head>
<body>
 
<div class="container mt-5">
 
  @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
 
  <div class="card">
 
    <div class="card-header text-center font-weight-bold">
      <h2>Les Icon Poi</h2>
    </div>
 
    <div class="card-body">
        {{--<form action="/stor-image" method="get" enctype="multipart/form-data" id="upload-image"  >
                   
            <div class="row">
 
              <div class="col-md-12">
                     
                     <label for="name"> Name Icons</label>
                     <div class="form-group col">
                         <input type="text" name="name" class="col"placeholder="Choose name" id="name">
                     @error('image')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                     </div>
                 </div><div class="col-md-12">
                     <div class="form-group">
                         <input type="file" name="file"class="col" placeholder="Choose image" id="image">
                     @error('image')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                     </div>
                 </div>
                   
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
            </div>     
        </form>
      --}}
          @if (isset($list))
              @foreach ($list as $item)
                  <img  src="{{$item->name}}"  alt="" srcset="" style="width: 2cm;height: 2cm; margin:0.5cm">
              @endforeach
          @endif
    </div>
 
  </div>
 
</div>  
</body>
</html>