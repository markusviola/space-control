<template>
    <div>
        <div class="form-group">
            <label class="text-muted font-weight-bold" for="name">名前</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label class="text-muted font-weight-bold" for="furigana">ふりがな</label>
            <input type="text" class="form-control" name="furigana" id="furigana" required>
        </div>

        <div class="form-group">
            <label class="text-muted font-weight-bold" for="email">メールアドレス</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label class="text-muted font-weight-bold" for="phone">電話番号</label>
            <input type="text" class="form-control" name="phone" id="phone" required>
        </div>

        <div class="form-group">
            <label class="text-muted font-weight-bold" for="gender">性別</label>
            <select class="form-control" name="gender" id="gender">
                <option disabled>選択肢</option>
                <option value="0">男</option>
                <option value="1">女</option>
            </select>
        </div>

        <div class="form-group">
            <label class="text-muted font-weight-bold" for="birthday">生年月日</label>
            <dd-date-picker id="birthday"></dd-date-picker>
        </div>

        <div class="form-group">
            <label class="text-muted font-weight-bold" for="address">住所</label>
            <input type="text" class="form-control" name="address" id="address" required>
        </div>
        <hr>
    </div>
</template>
