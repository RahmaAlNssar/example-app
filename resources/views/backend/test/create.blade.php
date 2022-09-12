<div class="form-group">
    <label for="recipient-title" class="col-form-label">الاسم:</label>
    <input type="text" class="form-control" name="title"
        value="{{ $row->title ?? old('title') }}" id="title">
    <span class="error text-danger d-none"></span>
</div>
<div class="form-group">
    <label for="recipient-desc" class="col-form-label">البريد الالكتروني:</label>
    <input type="text" class="form-control" name="desc"
        value="{{ $row->desc ?? old('desc') }}" id="desc">
    <span class="error text-danger d-none"></span>
</div>

