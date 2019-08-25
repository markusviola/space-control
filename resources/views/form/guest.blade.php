<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" required>
</div>

<div class="form-group">
    <label for="furigana">Furigana</label>
    <input type="text" class="form-control" name="furigana" id="furigana" required>
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" required>
</div>

<div class="form-group">
    <label for="phone">Phone No.</label>
    <input type="text" class="form-control" name="phone" id="phone" required>
</div>

<div class="form-group">
    <label for="gender">Gender</label>
    <select id="gender" class="form-control" name="gender" id="gender">
        <option disabled>選択肢</option>
        @foreach ($user->genderOptions() as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ $user->gender == $optionValue ? 'selected' : '' }}>{{ $optionValue }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="birthday">Birthday</label>
    <dd-date-picker id="birthday"></dd-date-picker>
</div>

<div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" name="address" id="address" required>
</div>

<hr>
