<div class="form-group">
    <label for="title">Title</label>
    <input id="title" type="text" name="title" class="form-control" value="{{ old('title', optional($post ?? null)->title) }}">
</div>
@error('title')
    <div class="alert alert-danger mb-3">{{ $message }}</div>
@enderror
<div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" name="content">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>
@error('content')
    <div class="alert alert-danger mb-3">{{ $message }}</div>
@enderror     