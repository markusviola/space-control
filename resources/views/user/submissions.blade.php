<div class="side-wrapper mb-2">
    <div class="card shadow-sm side-card neutral-round">
        <div class="text-center mt-3">
            <h5 class="alt-neutral">提出リスト</h5>
            <div class="text-muted">管理者に問い合わせよう！</div>
            <hr>
        </div>
        <div class="container mb-0 side-list">
            @if (sizeof($forms) > 0)
                @foreach ($forms as $form)
                    @if ($form->user_id == auth()->user()->id)
                        <a class="anti-neutral" href="{{ route('messenger', $form->id)}}">
                            <h6>
                            <strong>{{ $form->type->name }}</strong>
                            </h6>
                        </a>
                        <div class="text-muted">
                            提出日 {{ $form->created_at }}
                        </div>
                        <hr>
                    @endif
                @endforeach
            @else
                <div class="text-muted text-center mt-4 mb-4">
                    何も予約フォームは提出されていません。
                </div>
            @endif
        </div>
        <hr class="mt-0">
    </div>
</div>
