@extends('Dashboard.layout.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post</h1>
</div>

<div class="col-lg-8">
  <form action="/dashboard/categories/{{ $post->slug }}" method="post" class="mb-5" enctype="multipart/form-data">
    @method('put')   
    @csrf
      
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="slug" class="form-control @error ('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old ('slug', $post->slug) }}">
          @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select class="form-select" name="category_id">
            @foreach ($categories as $category)
              @if (old('category_id', $post->category_id) == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>             
              @else
                 <option value="{{ $category->id }}">{{ $category->name }}
                </option>
              @endif
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
      </form>
</div>

<script>
const title = document.querySelector('#title');
const title = document.querySelector('#slug');

title.addEventListener('change', function(){
    fetch ('/dashboard/posts/checkSlug?title=' + title.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
});


document.addEventListener('trix-file-accept', function (e){
  e.preventDefault()
})

function previewImage() {
  const image = document.querySelector ('#image');
  const imgPreview = document.querySelector('.img-preview');

  imgPreview.style.display ='block';
  
  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result;
  }
 }

</script>
    
@endsection