<div class="form-group">
    <label for="code">Kode Skema</label>
    <input type="text" name="code" id="code" value="{{ old('code', $certificationScheme?->code) }}" required
        maxlength="50">
    @error('code')
        <div class="error">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="name">Nama Skema</label>
    <input type="text" name="name" id="name" value="{{ old('name', $certificationScheme?->name) }}" required
        maxlength="255">
    @error('name')
        <div class="error">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="description">Deskripsi</label>
    <textarea name="description" id="description" rows="4" maxlength="2000">{{ old('description', $certificationScheme?->description) }}</textarea>
    @error('description')
        <div class="error">{{ $message }}</div>
    @enderror
</div>
